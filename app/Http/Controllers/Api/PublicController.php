<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function upcomingAvailability(Request $request)
    {
        $days = min((int) $request->input('days', 5), 5); // hard cap at 5, ignore attempts to request more

        $schedules = Schedule::with(['service', 'specialist'])
            ->where('is_active', true)
            ->whereBetween('date', [now()->format('Y-m-d'), now()->addDays($days)->format('Y-m-d')])
            ->orderBy('date')
            ->get();

        $bookedCounts = Appointment::whereIn('schedule_id', $schedules->pluck('id'))
            ->whereNotIn('status', [4, 5])
            ->selectRaw('schedule_id, count(*) as total')
            ->groupBy('schedule_id')
            ->pluck('total', 'schedule_id');

        $grouped = $schedules->map(function ($schedule) use ($bookedCounts) {
            $booked = $bookedCounts->get($schedule->id, 0);

            return [
                'schedule_id' => $schedule->id,
                'service' => $schedule->service->name,
                'specialist_name' => optional($schedule->specialist->user)->fullName(),
                'date' => $schedule->date,
                'time_start' => $schedule->time_start,
                'time_end' => $schedule->time_end,
                'remaining' => max($schedule->quota - $booked, 0),
                'is_full' => $booked >= $schedule->quota,
            ];
        })->groupBy('date');

        return response()->json($grouped);
    }
}
