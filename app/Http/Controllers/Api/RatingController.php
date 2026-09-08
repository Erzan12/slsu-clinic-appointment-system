<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Appointment $appointment)
    {
        $user = $request->user();

        if ($user->account_type != 3 || $appointment->patient_id != $user->user_id) {
            abort(403, 'Not authorized to rate for this appointment.');
        }

        if ($appointment->status != 2) {
            return response()->json(['status' => true, 'message' => 'This appointment has already been rated.'], 422);
        }

        $request->validate([
            'responsiveness' => 'required|integer|min:1|max:5',
            'reliability' => 'required|integer|min:1|max:5',
            'access_and_facility' => 'required|integer|min:1|max:5',
            'costs' => 'required|integer|min:1|max:5',
            'integrity' => 'required|integer|min:1|max:5',
            'communication' => 'required|integer|min:1|max:5',
            'assurance' => 'required|integer|min:1|max:5',
            'outcome' => 'required|integer|min:1|max:5',
            'suggestion' => 'nullable|string'
        ]);

        $rating = Rating::create([
            'appointment_id' => $appointment->id,
            ...$request->only([
                'responsiveness', 'reliability', 'access_and_facility', 'costs',
                'integrity', 'communication', 'assurance', 'outcome', 'suggestion',
            ]),
        ]);

        $appointment->update(['status' => 3]); // Done

        return response()->json(['status' => true, 'rating' => $rating]);
    }
}
