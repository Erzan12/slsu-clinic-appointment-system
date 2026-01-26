
@extends('layouts.main')
@section('contents')

    <div class="row justify-content-center my-3">
        <div class="col-md-6 col-lg-10 p-8">
            <div class="d-flex justify-content-center">
                
            </div>
            <h3 class="text-left mt-3">Add Specialst</h3>
            <div class="card form-wrapper p-2">
                <form action="{{route('specialists.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h6 class="text mt-3">Basic Information</h6>
                    <div class="form-group my-2">
                        <label for="position">Position</label><span class="text-danger">*
                        <input class="form-control" type="text" name="position" id="position" value="{{old('position')}}">
                        @error('position')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="my-2 form-group">
                        <label for="address">Profile Picture:</label>
                        <input type="file" name="avatar" id="avatar" class="form-control" value="{{old('avatar')}}">
                    </div>
                    <div class="form-group my-2">
                        <label for="employee_id">Employee ID Number</label><span class="text-danger">*
                        <input class="form-control" type="text" name="employee_id" id="employee_id" value="{{old('employee_id')}}">
                        @error('employee_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="row row-cols-1 row-cols-lg-3">
                    <div class="form-group col">
                        <label for="first_Name">First Name</label><span class="text-danger">*
                        <input class="form-control" type="text" name="first_name" id="firstname"  value="{{old('first_name')}}">
                        @error('first_name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="middle_Name">Middle Name</label>
                        <input class="form-control" type="text" name="middle_name" id="middlename"  value="{{old('middle_name')}}">
                    </div>
                    <div class="form-group col">
                        <label for="last_Name">Last Name</label><span class="text-danger">*
                        <input class="form-control" type="text" name="last_name" id="lastname"  value="{{old('last_name')}}">
                        @error('last_name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    </div>
                    <div class="form-group my-2">
                        <label for="contact_number">Contact Number</label><span class="text-danger">*
                        <input class="form-control" type="number" name="contact_number" id="contact_number"  value="{{old('contact_number')}}">
                        @error('contact_number')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group my-2">
                        <label for="email">Email Address</label><span class="text-danger">*
                        <input class="form-control" type="text" name="email" id="email"  value="{{old('email')}}">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="gender"
                            >Gender <span class="text-danger">*</span></label
                        >
                        <select name="gender" id="gender" class="form-select">
                            <option value="" selected>Select one</option>
                            <option value="1" @selected(old('gender') == 1)>Male</option>
                            <option value="2" @selected(old('gender') == 2)>Female</option>
                            </select>
                        @error('gender')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
            
                    <h6 class="text mt-3">Address</h6>
                    
                    <div class="form-group my-2">
                        <label for="barangay">(Barangay)</label><span class="text-danger">*
                        <input class="form-control" type="text" name="barangay" id="barangay"  value="{{old('barangay')}}">
                        @error('barangay')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="municipality">(Municipality/City)</label><span class="text-danger">*
                        <input class="form-control" type="text" name="municipality" id="municipality"  value="{{old('municipality')}}">
                        @error('municipality')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="province">(Province)</label><span class="text-danger">*
                        <input class="form-control" type="text" name="province" id="province"  value="{{old('province')}}">
                        @error('province')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Password</label><span class="text-danger">*
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="d-grid my-2">
                        <button class="submit btn btn-primary">Add Specialist</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection