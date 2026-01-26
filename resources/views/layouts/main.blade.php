@extends('layouts.app')
@section('content')
    @include('utils.navbar')
    <div class="d-flex">
        @include('utils.sidebar')
        <div class="child-content p-3 w-100">
            @yield('contents')
        </div>
    </div>
@endsection