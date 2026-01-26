@extends('layouts.main')
@section('contents')

<div class="container">
    <div class="row justify-content-center my-4">
        <div class="card shadow p-3 col-lg-6">
            <h4 class="text-center">Findings</h4>
            <form action="{{route('findings.store', ['id' => $id])}}" method="post">
                @csrf
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Tell us what are the findings..."></textarea>
                <div class="form-group mt-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection