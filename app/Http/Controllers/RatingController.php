<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function create($id)
    {
        return view('patients.ratings.create', compact('id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'responsiveness' => 'required|min:1|max:5',
            'reliability' => 'required|min:1|max:5',
            'access_and_facility' => 'required|min:1|max:5',
            'costs' => 'required|min:1|max:5',
            'integrity' => 'required|min:1|max:5',
            'communication' => 'required|min:1|max:5',
            'assurance' => 'required|min:1|max:5',
            'outcome' => 'required|min:1|max:5',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $appointment = Appointment::find($request->id);
        $appointment->update([
            'status' => 3
        ]);

        Rating::create([
            'appointment_id' => $request->id,
            'responsiveness' => $request->responsiveness,
            'reliability' => $request->reliability,
            'access_and_facility' => $request->access_and_facility,
            'costs' => $request->costs,
            'integrity' => $request->integrity,
            'communication' => $request->communication,
            'assurance' => $request->assurance,
            'outcome' => $request->outcome,
            'suggestion' => $request->suggestion,
        ]);

        return redirect(route('appointments.index'));
    }
}
