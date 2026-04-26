@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    @endif
    <h1>Update Service details  {{ $service->name }}</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>

            @if($service->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$service->image) }}" width="120">
                </div>
            @endif

            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="name">Service</label>
            <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $service->description) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Details</button>
    </form>
</div>
@endsection
