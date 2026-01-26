<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use App\Models\User;
use App\Models\Information;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_number' => 'required|unique:patients',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric',
            'email' => 'required|email',
            'gender' => 'required|numeric',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'password' => 'required'

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $request->all();

        $patient=Patient::create(Arr::only($data,['id_number']));
        $filename = $request->id_number .".". $request->avatar->getClientOriginalExtension();
        if ($request->hasFile('avatar'))
        {
            Storage::putFileAs('public/patients/',$request->avatar, $filename);
        }
        $data['avatar']= '/storage/patients/' . $request->id_number .".". $request->avatar->getClientOriginalExtension();
        $data['user_id'] = $patient->id;
        $data['account_type'] = 3;
        $information=Information::create(Arr::except($data, ['id_number']));
        
       $user = User::create([
        'username'=> $patient->id_number,
        'password' => bcrypt($request->password),
        'user_id' => $patient->id,
        'account_type'=> 3
        ]);
        
        Auth::login($user);
        return redirect(route('dashboard'));

    }

    public function delete($id)
    {
        $patient = Patient::find($id);
        $user = User::where('user_id', $patient->id)->where('account_type', 3)->first();
        $information = Information::where('user_id', $patient->id)->where('account_type', 3)->first();

        $patient->delete();
        $user->delete();
        $information->delete();
        return back()->with('success', 'Patient has been successfully deleted');
    }

    public function restore($id)
    {
        $patient = Patient::withTrashed()->find($id);
        $user = User::where('user_id', $patient->id)->where('account_type', 3)->withTrashed()->first();
        $information = Information::where('user_id', $patient->id)->where('account_type', 3)->withTrashed()->first();

        $patient->restore();
        $user->restore();
        $information->restore();
        return back()->with('success', 'Patient has been successfully restore');
    }

    public function list(Request $request)
    {
        $deleted = false;
        $patients = Patient::join('information', 'information.user_id', '=', 'patients.id')->where('information.account_type', 3)
            ->select([
                'patients.id',
                'id_number',
                'avatar',
                'first_name',
                'last_name',
                'patients.deleted_at'
            ]);
        
        if($request->has('deleted') && $request->deleted) {
            $deleted = true;
            $patients = $patients->withTrashed();
        }

        $patients = $patients->get();

        return view('admins.patients.index', compact('patients', 'deleted'));
    }
}
