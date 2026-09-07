<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private function generateSlots(Schedule $schedule): array
    {
        $slots = [];
        $datePart = Carbon::parse($schedule->date)->format('Y-m-d');
        $current = Carbon::parse($datePart.' '.$schedule->time_start);
        $end = Carbon::parse($datePart.' '.$schedule->time_end);

        while ($current->lessThan($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($schedule->slot_duration_minutes);
        }

        return $slots;
    }

    // For patients: list open days for a given service (used on the booking screen)
    public function index(Request $request)
    {
        $query = Schedule::with('service')
            ->where('is_active', true)
            ->where('data', '>=', now()->format('Y-m-d'));

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        return response()->json($query->orderBy('date')->get());
    }

    // Availability breakdown for one specific schedule (day + service + specialist)
    public function availability(Schedule $schedule)
    {
        $slots = $this->generateSlots($schedule);
        $slotCapacity = $schedule->slot_capacity ?? (int) ceil($schedule->quota / count($slots));

        $bookedCounts = Appointment::where('schedule_id', $schedule->id)
            ->whereNotIn('status', [4]) // exclude rejected
            ->selectRaw('preferred_time, count(*) as total')
            ->groupBy('preferred_time')
            ->pluck('total', 'preferred_time');

        $totalBooked = $bookedCounts->sum();

        return response()->json([
            'schedule_id' => $schedule->id,
            'service' => $schedule->service,
            'date' => $schedule->date,
            'quota' => $schedule->quota,
            'total_booked' => $totalBooked,
            'day_full' => $totalBooked >= $schedule->quota,
            'slots' => collect($slots)->map(fn ($time) => [
                'time' => $time,
                'booked' => $bookedCounts->get($time, 0),
                'capacity' => $slotCapacity,
                'is_full' => $bookedCounts->get($time, 0) >= $slotCapacity,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'quota' => 'required|integer|min:1',
            'slot_duration_minutes' => 'nullable|integer|min:5',
            'slot_capacity' => 'nullable|integer|min:1',
        ]);

        $schedule = Schedule::create([
            'specialist_id' => $request->user()->user_id,
            'service_id' => $request->service_id,
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'quota' => $request->quota,
            'slot_duration_minutes' => $request->slot_duration_minutes ?? 30,
            'slot_capacity' => $request->slot_capacity, // null = auto-complete, as desgined,
            'is_active' => true,
        ]);

        return response()->json([
            'status' => true, 
            'message' => $schedule
        ]);
    }
}
