@extends('layouts.main')
@section('contents')
<div class="container">
    
    @if(auth()->user()->account_type != 1)
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
        <h3>Welcome to Southern Leyte State University - Clinic Appointment Setter!</h3>
    </div>
    @endif

<x-admin-summary/>
</div>
@endsection