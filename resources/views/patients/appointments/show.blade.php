@extends('layouts.main')
@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 card shadow p-2">
            <div class="group-head my-2">
                <h4>Appointment Details</h4>
                <hr>
                <div class="mx-3">
                    <div class="group">
                        <p><b>Service Name</b>:</p>
                        <p>{{$service->name}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Service Description</b>:</p>
                        <p>{{$service->description == '' ? 'No Description' : $service->description}}</p>
                    </div>
                    
                    <div class="group">
                        <p><b>Appointment Date</b>: </p>
                        <p>{{$appointment->schedule->date}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Appointment Time</b>:</p>
                        <p><small class="p-2"><b>Start</b>:  {{Carbon\Carbon::parse($appointment->schedule->time_start)->format('g:i A')}}</small></p>
                        <p><small class="p-2"><b>End</b>:  {{Carbon\Carbon::parse($appointment->schedule->time_end)->format('g:i A')}}</small></p>
                    </div>
                </div>
            </div>
        
            <div class="group-head my-3">
                <h4>Patient Details</h4>
                <hr>
                <div class="mx-3">
                    <div class="group">
                        <p><b>First Name</b>:</p>
                        <p>{{$appointment->first_name}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Last Name</b>:</p>
                        <p>{{$appointment->last_name}}</p>
                    </div>
                    
                    <div class="group">
                        <p><b>Email Address</b>:</p>
                        <p>{{$appointment->email}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Gender</b>:</p>
                        <p>{{ App\Helpers\GenderHelper::prettyGender($appointment->gender)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Contact Number</b>:</p>
                        <p>{{$appointment->contact_number}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Current Address</b>:</p>
                        <p>{{$appointment->address}}</p>
                    </div>
                </div>
            </div>
        
            <div class="group-head my-3">
                <h4>Finding Details</h4>
                <hr>
                <div class="mx-3">
                    <div class="group">
                        <p><b>Description</b>:</p>
                        <p>{{$appointment->finding->description ?? 'No Description'}}</p>
                    </div>
                </div>
            </div>
        
            <div class="group-head my-3">
                <h4>Rating Details</h4>
                <hr>
                <div class="mx-3">
                    <div class="group">
                        <p><b>Responsiveness</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->responsiveness ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Reliability</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->reliability ?? 0)}}</p>
                    </div>
                    
                    <div class="group">
                        <p><b>Access and Facility</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->access_and_facility ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Costs</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->costs ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Integrity</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->integrity ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Communication</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->communication ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Assurance</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->assurance ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Outcome</b>:</p>
                        <p>{{ App\Helpers\RatingHelper::prettyRate($appointment->rating->outcome ?? 0)}}</p>
                    </div>
        
                    <div class="group">
                        <p><b>Suggestions</b>:</p>
                        <p>{{ $appointment->rating->suggestions ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection