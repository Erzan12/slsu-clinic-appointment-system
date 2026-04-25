@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{$message}}</div>
    @endif
    <h1>Edit Service record: {{ $service->name }}</h1>

    <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" class="form-control" name="id" value="{{Crypt::encrypt($service->id)}}">
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="service" class="form-label">Service</label>
            <input type="text" class="form-control" id="service" name="service" value="{{ old('service', $service->service) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $service->description) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
</div>
@endsection
