@extends('layouts.app')
@include('utils.navbar')
@section('content')

{{-- You can call component by adding x from start followed by dash then name of component --}}
<x-hero/>
<x-service/>
<x-specialist/>
<x-about/>
<x-feedback/>

@endsection