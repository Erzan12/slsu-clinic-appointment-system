<div>
    <div class="row justify-content-center">
        <div class="col-md-6 card shadow p-3">
            <form action="" method="post" wire:submit.prevent="setAppointment">
                <h5>Schedule Information</h5>
                <hr>
                <div class="form-group my-1">
                    <label for="service_id">Service Type</label>
                    <select name="service_id" id="service_id" class="form-select" wire:model="service_id">
                        <option value="" selected>Select One</option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group my-2">
                    <label for="">Schedule Date</label>
                    <select name="schedule_id" id="schedule_id" class="form-select" wire:model="schedule_id">
                        <option value="" selected>Select one</option>
                        @foreach($schedules as $schedule)
                            <option value="{{$schedule->id}}">
                                {{$schedule->service->name}} {{$schedule->id}}
                            </option>
                        @endforeach
                    </select>
                    @error('schedule_id')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>

                @if($schedule_id)
                <div class="form-group">
                    <label for="">Schedule Details</label>
                    <div class="d-flex gap-5 justify-content-center">
                        <div class="form-group">
                            <small>Date</small>
                            <h6>{{$schedule_date}}</h6>
                        </div>
                        <div class="form-group">
                            <small>Time</small>
                            <h6>{{$schedule_time_start->format('h:i') }} - {{$schedule_time_end->format('h:i')}}</h6>
                        </div>
                        <div class="form-group">
                            <small>Duration</small>                            
                            <h6 class="text-center">{{$schedule_time_end->diffInHours($schedule_time_start)}} hour(s)</h6>
                        </div>
                        <div class="form-group">
                            <small>Specialist</small>                            
                            <h6 class="text-center">{{$specialist}}</h6>
                        </div>
                    </div>
                </div>
                @endif

                <h5 class="mt-4">Basic Information</h5>
                <hr>
                <div class="form-group my-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model="information">
                    <label class="form-check-label" for="flexCheckDefault">
                        Use my current information
                    </label>
                </div>
                
                @if(!$information)
                    <div class="form-group my-2">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" wire:model="first_name">
                        @error('first_name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" wire:model="middle_name">
                    </div>
                    <div class="form-group my-2">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" wire:model="last_name">
                        @error('last_name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" wire:model="email">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select" wire:model="gender">
                            <option value="" selected>Select one</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" wire:model="contact_number">
                        @error('contact_number')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" wire:model="address">
                        @error('address')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                @endif

                <div class="form-group d-grid">
                    <button type="submit" class="btn btn-primary">Set Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>
