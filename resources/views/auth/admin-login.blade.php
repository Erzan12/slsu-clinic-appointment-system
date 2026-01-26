@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center login-wrapper">
        <div class="col-md-6 col-lg-4 ">
            <div class="position-relative">
                <div class="position-absolute start-50 translate-middle z-1 image-wrapper">
                    <img src="https://user.southernleyte.org.ph/files/slsu-logo.png" alt="">
                </div>
            </div>
            <div class="card shadow form-wrapper">
                <form action="{{route('admin.authenticate')}}" method="post" class="p-3 mt-3">
                    @csrf
                    <h3 class="text-center mt-3">Login Admin / Specialist</h3>
    
                    @error('error')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{$message}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    
                    <div class="form-group my-2">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection