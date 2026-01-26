
@extends('layouts.main')
@section('contents')

    <div class="row justify-content-center my-3">
        <div class="col-md-6 col-lg-6 p-8">
            <div class="d-flex justify-content-center">
                
            </div>
            <h3 class="text-left mt-3">Add Service</h3>
            <div class="card form-wrapper p-2">
                <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h6 class="text mt-3">Basic Information</h6>
                    <div class="my-2 form-group">
                        <label for="image">Service Picture:</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{old('image')}}">
                    </div>
                    <div class="form-group">
                        <label for="service_name">Service Name</label><span class="text-danger">*
                        <input class="form-control" type="text" name="service_name" id="service_name"  value="{{old('service_name')}}">
                        @error('service_name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" type="text" name="description" id="description"  value="{{old('description')}}">
                    </div>
                    
                    <div class="d-grid my-2">
                        <button class="submit btn btn-primary">Add Specialist</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection