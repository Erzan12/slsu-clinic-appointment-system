<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Information;
use App\Models\Patient;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private function getSpecialist()
    {
        return Specialist::where('specialists.id',auth()->user()->user_id)->join('information', 'information.user_id','=','specialists.id')->where('account_type', 2)->first();
    }

    private function getPatient()
    {
        return Patient::where('patients.id',auth()->user()->user_id)->join('information', 'information.user_id','=','patients.id')->where('account_type', 3)->first();
    }

    private function getAdmin()
    {
        return Admin::find(auth()->user()->user_id);
    }

    private function rules()
    {
        if(auth()->user()->account_type == 1) {
            return [
                'display_name' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ];
        } elseif (auth()->user()->account_type == 2) {
            return [
                'position' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric',
                'email' => 'required|email',
                'gender' => 'required|numeric',
                'barangay' => 'required',
                'municipality' => 'required',
                'province' => 'required',
            ];
        }
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric',
            'email' => 'required|email',
            'gender' => 'required|numeric',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
        ];
    }

    public function information()
    {
        $user = [];
        if(auth()->user()->account_type == 1) {
            $user = $this->getAdmin();
        } elseif(auth()->user()->account_type == 2) {
            $user = $this->getSpecialist();
        } else {
            $user = $this->getPatient();
        }
        return view('profile.information', compact('user'));
    }    

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = [];
        if(auth()->user()->account_type == 1) {
            $user = $this->getAdmin();
        } elseif(auth()->user()->account_type == 2) {
            $user = Specialist::find(auth()->user()->user_id);
            $information = Information::where('account_type', 2)->where('user_id', auth()->user()->user_id)->first();
            $information->update($request->all());
        } else {
            $user = Patient::find(auth()->user()->user_id);
            $information = Information::where('account_type', 3)->where('user_id', auth()->user()->user_id)->first();
            $information->update($request->all());
        }
        
        $user->update($request->all());
        return back()->with('success', 'Successfully updated profile information');
    }
}
