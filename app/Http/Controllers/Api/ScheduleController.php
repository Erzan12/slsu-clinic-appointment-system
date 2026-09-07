<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
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
        $slots = $this.generateSlots($schedule);
        $slotCapacity = $schedule->slot_capacity ?? (int) ceil($schedule->quota / max(counts($slots), 1));

        $bookedCounts = Appointment::where('schedule_id', $schedule->id)
            ->whereNotIn('status', [4]) // exclude rejected
            ->selectRaw('preferred_time, count(*) as total')
            ->groupBy('preferred_time')
            ->pluck('total', 'preffered_time');

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

    private function generateSlots(Schedule $schedule): array
    {
        $slots = [];
        $current = Carbon::parse($schedule->date.' '.$schedule->time_start);
        $end = Carbon::parse($schedule->date.' '.$schedule->time_end);

        while ($current->lessThan($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($schedule->slot_duration_minutes);
        }

        return $slots;
    }
}
