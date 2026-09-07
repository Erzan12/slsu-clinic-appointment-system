<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Appointment::with(['schedule.service'])
            ->when($user->account_type == 3, fn ($q) => $q->where('patient_id', $user->user_id))
            ->when($user->account_type == 2, fn ($q) => $q->whereHas('schedule', fn ($s) => $s->where('specialist_id', $user->user_id)));

        return response()->json($query->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'preferred_time' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'gender' => 'required|integer|in:1,2,3',
            'contact_number' => 'required',
            'address' => 'required',
        ]);

        return DB::transaction(function () use ($request) {
            $schedule = Schedule::lockForUpdate()->findOrFail($request->schedule_id);

            $totalBooked = Appointment::where('schedule_id', $schedule->id)->whereNotIn('status', [4])->count();
            if ($totalBooked >= $schedule->quota) {
                return response()->json(['status' => false, 'message' => 'This day is fully booked.'], 422);
            }

            $slots = (new \App\Http\Controllers\Api\ScheduleController)->availability($schedule)->getData()->slots;
            $slotInfo = collect($slots)->firstWhere('time', $request->preferred_time);

            if (! $slotInfo) {
                return response()->json(['status' => false, 'message' => 'Invalid time slot for for this schedule.'], 422);
            }

            if ($slotInfo->is_full) {
                return response()->json(['status' => false, 'message' => 'This time is fully booked. Please choose another time.'], 422);
            }

            $status = $schedule->service->requires_approval ? 0 : 1; // 0 = Pending, 1 = Approved

            $appointment = Appointment::create([
                'patient_id' => auth()->user()->user_id,
                'schedule_id' => $schedule->id,
                'preferred_time' => $request->preferred_time,
                'status' => $status,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
            ]);

            return response()->json(['status' => true, 'appointment' => $appointment]);
        });
    }

    public function destroy(Request $request, Appointment $appointment)
    {
        if ($appointment->patient_id != $request->user()->user_id) {
            abort(403);
        }

        $appointment->delete();

        return response()->json(['status' => true, 'message' => 'Appointment cancelled.']);
    }

    public function approve(Request $request, Appointment $appointment) 
    {
        $this->authorizeSpecialist($request, $appointment);

        $appointment->update(['status' => 1]); // Approved

        return response()->json(['status' => true, 'message' => 'Appointment approved.']);
    }

    public function reject(Request $request, Appointment $appointment)
    {
        $this->authorizeSpecialist($request, $appointment);

        $appointment->update(['status' => 4]); // Rejected

        return response()->json(['status' => true, 'message' => 'Appointment rejected.']);
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        $this->authorizeSpecialist($request, $appointment);

        if ($appointment->status == 4) {
            return response()->json(['status' => false, 'message' => 'Appointment is already rejected.'], 422);
        }

        $appointment->update(['status' => 4]); // reuse Rejected as the "no longer holding a slot" status

        return response()->json(['status' => true, 'message' => 'Appointment cancelled - slot released.']);
    }

    private function authorizedSpecialist(Request $request, Appointment $appointment)
    {
        $user = $request->user();
        $specialistId = $appointment->schedule->specialist_id;

        if ($user->account_type != 2 || $specialistId != $user->user_id) {
            abort(403, 'Not authorized to manage this appointment.');
        }
    }
}
