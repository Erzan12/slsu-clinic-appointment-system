<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Finding;
use Illuminate\Http\Request;

class FindingController extends Controller
{
    public function store(Request $request, Appointment $appointment)
    {
        $user = $request->user();

        if ($user->account_type != 2 || $appointment->schedule->specialist_id != $user->user_id) {
            abort(403, 'Not authorized to add findings for this appointment.');
        }

        if ($appointment->status == 4) {
            return response()->json(['status' => false, 'message' => 'Cannot add findings to a rejected appointment.'], 422);
        }

        $request->validate(['description' => 'required|string']);

        $finding = Finding::updateOrCreate(
            ['appointment_id' => $appointment->id],
            ['description' => $request->description]
        );

        $appointment->update(['status' => 2]); // To be rated

        return response()->json(['status' => true, 'finding' => $finding]);
    }

    public function show(Request $request, Appointment $appointment)
    {
        $user = $request->user();
        $isOwner = $user->account_type == 3 && $appointment->patient_id == $user->user_id;
        $isSpecialist = $user->account_type == 2 && $appointment->schedule->specialist_id == $user->user_id;
    
        if (! $isOwner && ! $isSpecialist && $user->account_type != 1) {
            abort(403);
        }

        return response()->json($appointment->finding);
    }
}
