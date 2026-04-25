@extends('layouts.app')
@include('utils.navbar')
@section('content')

{{-- You can call component by adding x from start followed by dash then name of component --}}
<x-hero/>
<section class="section-light">
    <x-service/>
</section>

<section class="section-alt">
    <x-specialist/>
</section>

<section class="cta-section">
    <div class="container text-center text-light">
        <h2>Ready to book an appointment?</h2>
        <a href="{{ route('login') }}" class="btn btn-light mt-3">
            Get Started
        </a>
    </div>
</section>

<section class="section-light">
    <x-feedback/>
</section>

<section class="section-alt">
    <x-about/>
</section>
@endsection