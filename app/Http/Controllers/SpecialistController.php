<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;
use App\Models\Specialist;
use App\Models\User;
use App\Models\Information;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{

    public function index(Request $request)
    {
        $deleted = false;
        $specialists = Specialist::join('information', 'information.user_id','=','specialists.id')->where('account_type', 2)
            ->select([
                'specialists.id',
                'employee_id',
                'avatar',
                'account_type',
                'first_name',
                'middle_name',
                'last_name',
                'position',
                'specialists.created_at',
                'specialists.updated_at',
                'specialists.deleted_at'
            ]);

        if($request->has('deleted') && $request->deleted) {
            $deleted = true;
            $specialists = $specialists->withTrashed();
        }

        /**
         * Buggy code
         */
        // if($request->has('keyword') && $request->keyword) {
        //     $specialists = $specialists->where('first_name', "LIKE", "%$request->keyword%")
        //         ->orWhere('employee_id', "LIKE", "%$request->keyword%")
        //         ->orWhere('last_name', "LIKE", "%$request->keyword%")
        //         ->orWhere('position', "LIKE", "%$request->keyword%");
        // }

        $specialists = $specialists->latest('specialists.created_at')->get();
        return view('admins.specialist-index',['specialists'=> $specialists, 'deleted' => $deleted]);
    }

    public function create()
    {
        return view('admins.add-specialist');
    }
    public function edit($id) 
    {   
        $specialist = Specialist::where('specialists.id',$id)->join('information', 'information.user_id','=','specialists.id')->where('account_type', 2)->first();
        return view('admins.edit-specialist', ['specialist' => $specialist, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'position' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required|numeric',
            'email' => 'required|email',
            'gender' => 'required|numeric',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $specialist = Specialist::find($id);
        $specialist->update($request->only(['position']));
        $information = Information::where('user_id', $id)->where('account_type', 2)->first();
        $information->update($request->except(['position']));
        return redirect(route('specialists.index'))->with('success', 'Successfully updated specialists information');
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'position' => 'required',
            'employee_id' => 'required|unique:specialists',
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

        $specialist=Specialist::create(Arr::only($data,['employee_id', 'position']));

        $filename = "";
        if ($request->hasFile('avatar'))
        {
            $filename = $request->employee_id .".". $request->avatar->getClientOriginalExtension();
            Storage::putFileAs('public/specialists/',$request->avatar, $filename);
            $data['avatar']= '/storage/specialists/' . $request->employee_id .".". $request->avatar->getClientOriginalExtension();
        }

        $data['user_id'] = $specialist->id;
        $data['account_type'] = 2;
        $information=Information::create(Arr::except($data, ['employee_id']));
        
       $user = User::create([
        'username'=> $specialist->employee_id,
        'password' => bcrypt($request->password),
        'user_id' => $specialist->id,
        'account_type'=> 2
        ]);
        
        return redirect(route('specialists.index'))->with('success', 'New Specialist has been added to database');
    }

    public function delete($id)
    {
        $specialist = Specialist::find($id);
        $information = Information::where('user_id', $id)->where('account_type', 2)->first();
        $user = User::where('user_id', $id)->where('account_type', 2)->first();

        $specialist->delete();
        $information->delete();
        $user->delete();
        return back()->with('success', 'Specialist successfully deleted!');
    }

    public function restore($id)
    {
        $specialist = Specialist::withTrashed()->find($id);
        $information = Information::where('user_id', $id)->where('account_type', 2)->withTrashed()->first();
        $user = User::where('user_id', $id)->where('account_type', 2)->withTrashed()->first();

        $specialist->restore();
        $information->restore();
        $user->restore();
        return back()->with('success', 'User successfully restored!');
    }
}


