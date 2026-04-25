<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('admins.services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|unique:services,name',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $fileName = '';
        if($request->has('image')) {
            $fileName = Str::random(10) .".". $request->image->getClientOriginalExtension();
            Storage::putFileAs('public/services/',$request->image, $fileName);
            $fileName = 'services/' . $fileName;
        }

        Service::create([
            'image' => $request->has('image') ? $fileName : '',
            'name' => $request->service_name,
            'description' => $request->description,
        ]);

        return redirect(route('services.index'))->with('success', 'New Service has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $service = Service::findOrFail($id);
        return view('admins.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        $validatedData = $request->validate([
            'image'         =>  'required|string',
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
        ]);

        $id = Crypt::decrypt($request->id);
        $service = Service::findOrFail($id);

        $service->update($validatedData);

        $service->save();

        return redirect()->route('admins.services.index', ['' => $service->service_id])
                        ->with('success', 'service record updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if($service->image) {
            Storage::delete('public/'.$service->image);
        }

        $service->delete();
        return back()->with('success', 'Successfully delete service');
    }
}
