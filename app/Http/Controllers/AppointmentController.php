<?php

namespace App\Http\Controllers;

use App\Helpers\StatusHelper;
use App\Models\Information;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\Service;
use App\Services\MailerService;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::join('schedules', 'schedules.id', '=', 'appointments.schedule_id')
            ->join('services', 'services.id', '=', 'schedules.service_id')
            ->select([
                'appointments.id',
                'services.name',
                'services.description',
                'schedules.specialist_id',
                'schedules.time_start',
                'schedules.time_end',
                'schedules.date',
                'appointments.patient_id',
                'appointments.status',
                'appointments.created_at'
            ]);

        $user = auth()->user();

        if($user->account_type == 2) {
            $appointments = $appointments->where('specialist_id', $user->user_id);
        }elseif($user->account_type == 3) {
            $appointments = $appointments->where('patient_id', $user->user_id);
        }

        if($request->has('keyword')) {
            if($request->keyword == "") {
                return redirect(route('appointments.index'));
            }
            $appointments = $appointments
                ->where('services.name', 'LIKE', "%$request->keyword%")
                ->orWhere('schedules.time_start', $request->keyword)
                ->orWhere('schedules.time_end', $request->keyword)
                ->orWhere('schedules.date', $request->keyword)
                ->orWhere('appointments.status', StatusHelper::numericStatus($request->keyword));
        }

        $appointments = $appointments->latest('appointments.created_at')->get();

        return view('patients.appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = Appointment::with(['finding', 'rating', 'schedule'])->find($id);
        $service = Service::find($appointment->schedule->service_id);
        return view('patients.appointments.show', compact('appointment', 'service'));
    }

    public function create()
    {
        return view('patients.appointments.create');
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        
        $schedule = Schedule::find($appointment->schedule_id);
        $schedule->update([
            'flag' => 0
        ]);

        $appointment->delete();
        return back()->with('success', 'Appointment successfully deleted!');
    }

    public function approve($id)
    {
        $appointment = Appointment::find($id);
        $appointment->update([
            'status' => 1
        ]);

        $patient = Information::where('user_id', $appointment->patient_id)->where('account_type', 3)->first();
        MailerService::send($patient->getFullName(), $patient->email, 2);
        return back()->with('success', 'Appointment successfully approved!');
    }

    public function reject($id)
    {
        $appointment = Appointment::find($id);
        $appointment->update([
            'status' => 4
        ]);

        $patient = Information::where('user_id', $appointment->patient_id)->where('account_type', 3)->first();
        MailerService::send($patient->getFullName(), $patient->email, 3);

        $schedule = Schedule::find($appointment->schedule_id);
        $schedule->update([
            'flag' => 0
        ]);

        return back()->with('success', 'Appointment successfully reject!');
    }
}
