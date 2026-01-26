<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Finding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FindingController extends Controller
{
    public function create($id)
    {
        return view('specialists.findings.create', compact('id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $appointment = Appointment::find($request->id);
        $appointment->update([
            'status' => 2
        ]);

        Finding::create([
            'appointment_id' => $appointment->id,
            'description' => $request->description
        ]);

        return redirect(route('appointments.index'));
    }
}
