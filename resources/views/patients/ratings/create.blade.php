@extends('layouts.main')
@section('contents')

<div class="container">
    <div class="row justify-content-center my-4">
        <h4 class="text-center">Rate your appointment</h4>
        <div class="card shadow p-3 col-lg-8">
            <form action="{{route('ratings.store', ['id' => $id])}}" method="post">
                @csrf
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Responsiveness</h6>
                        <small>(the ability to act and provide the service quicky)</small>
                    </div>
                    <div class="responsiveness">
                        <input type="radio" id="responsiveness5" name="responsiveness" value="5"/>
                        <label for="responsiveness5" title="5">5 stars</label>
                        <input type="radio" id="responsiveness4" name="responsiveness" value="4" />
                        <label for="responsiveness4" title="responsiveness">4 stars</label>
                        <input type="radio" id="responsiveness3" name="responsiveness" value="3" />
                        <label for="responsiveness3" title="3">3 stars</label>
                        <input type="radio" id="responsiveness3" name="responsiveness" value="2" />
                        <label for="responsiveness2" title="2">2 stars</label>
                        <input type="radio" id="responsiveness1" name="responsiveness" value="1" />
                        <label for="responsiveness1" title="1">1 star</label>
                    </div>
                    @error('responsiveness')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Reliability / Quality</h6>
                        <small>(the services rendered are accurate and of quality)</small>
                    </div>
                    <div class="reliability">
                        <input type="radio" id="reliability5" name="reliability" value="5"/>
                        <label for="reliability5" title="5">5 stars</label>
                        <input type="radio" id="reliability4" name="reliability" value="4" />
                        <label for="reliability4" title="4">4 stars</label>
                        <input type="radio" id="reliability3" name="reliability" value="3" />
                        <label for="reliability3" title="3">3 stars</label>
                        <input type="radio" id="reliability2" name="reliability" value="2" />
                        <label for="reliability2" title="2">2 stars</label>
                        <input type="radio" id="reliability1" name="reliability" value="1" />
                        <label for="reliability1" title="1">1 star</label>
                    </div>
                    @error('reliability')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Access and Facilities</h6>
                        <small>(making the availment of the services convenient to the client)</small>
                    </div>
                    <div class="access_and_facility">
                        <input type="radio" id="access_and_facility5" name="access_and_facility" value="5"/>
                        <label for="access_and_facility5" title="5">5 stars</label>
                        <input type="radio" id="access_and_facility4" name="access_and_facility" value="4" />
                        <label for="access_and_facility4" title="4">4 stars</label>
                        <input type="radio" id="access_and_facility3" name="access_and_facility" value="3" />
                        <label for="access_and_facility3" title="3">3 stars</label>
                        <input type="radio" id="access_and_facility2" name="access_and_facility" value="2" />
                        <label for="access_and_facility2" title="2">2 stars</label>
                        <input type="radio" id="access_and_facility1" name="access_and_facility" value="1" />
                        <label for="access_and_facility1" title="1">1 star</label>
                    </div>
                    @error('access_and_facility')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Costs</h6>
                        <small>(the amount of time, effort spent in obtaining the services)</small>
                    </div>
                    <div class="costs">
                        <input type="radio" id="costs5" name="costs" value="5"/>
                        <label for="costs5" title="5">5 stars</label>
                        <input type="radio" id="costs4" name="costs" value="4" />
                        <label for="costs4" title="4">4 stars</label>
                        <input type="radio" id="costs3" name="costs" value="3" />
                        <label for="costs3" title="3">3 stars</label>
                        <input type="radio" id="costs2" name="costs" value="2" />
                        <label for="costs2" title="2">2 stars</label>
                        <input type="radio" id="costs1" name="costs" value="1" />
                        <label for="costs1" title="1">1 star</label>
                    </div>
                    @error('costs')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Integrity</h6>
                        <small>(the ability to adhere to moral conduct and values in rendering the services)</small>
                    </div>
                    <div class="integrity">
                        <input type="radio" id="integrity5" name="integrity" value="5"/>
                        <label for="integrity5" title="5">5 stars</label>
                        <input type="radio" id="integrity4" name="integrity" value="4" />
                        <label for="integrity4" title="4">4 stars</label>
                        <input type="radio" id="integrity3" name="integrity" value="3" />
                        <label for="integrity3" title="3">3 stars</label>
                        <input type="radio" id="integrity2" name="integrity" value="2" />
                        <label for="integrity2" title="2">2 stars</label>
                        <input type="radio" id="integrity1" name="integrity" value="1" />
                        <label for="integrity1" title="1">1 star</label>
                    </div>
                    @error('integrity')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Communication</h6>
                        <small>(the manner of tone of voice and gesture while rendering the services)</small>
                    </div>
                    <div class="communication">
                        <input type="radio" id="communication5" name="communication" value="5"/>
                        <label for="communication5" title="5">5 stars</label>
                        <input type="radio" id="communication4" name="communication" value="4" />
                        <label for="communication4" title="4">4 stars</label>
                        <input type="radio" id="communication3" name="communication" value="3" />
                        <label for="communication3" title="3">3 stars</label>
                        <input type="radio" id="communication2" name="communication" value="2" />
                        <label for="communication2" title="2">2 stars</label>
                        <input type="radio" id="communication1" name="communication" value="1" />
                        <label for="communication1" title="1">1 star</label>
                    </div>
                    @error('communication')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Assurance</h6>
                        <small>(making sure that the services rendered is of quality)</small>
                    </div>
                    <div class="assurance">
                        <input type="radio" id="assurance5" name="assurance" value="5"/>
                        <label for="assurance5" title="5">5 stars</label>
                        <input type="radio" id="assurance4" name="assurance" value="4" />
                        <label for="assurance4" title="4">4 stars</label>
                        <input type="radio" id="assurance3" name="assurance" value="3" />
                        <label for="assurance3" title="3">3 stars</label>
                        <input type="radio" id="assurance2" name="assurance" value="2" />
                        <label for="assurance2" title="2">2 stars</label>
                        <input type="radio" id="assurance1" name="assurance" value="1" />
                        <label for="assurance1" title="1">1 star</label>
                    </div>
                    @error('assurance')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>
                <hr>
                <div class="form-group d-flex justify-content-center my-2 mb-4">
                    <div class="me-auto d-grid">
                        <h6>Outcome</h6>
                        <small>(the rendered services, meets the clients need/purpose)</small>
                    </div>
                    <div class="outcome">
                        <input type="radio" id="outcome5" name="outcome" value="5"/>
                        <label for="outcome5" title="5">5 stars</label>
                        <input type="radio" id="outcome4" name="outcome" value="4" />
                        <label for="outcome4" title="4">4 stars</label>
                        <input type="radio" id="outcome3" name="outcome" value="3" />
                        <label for="outcome3" title="3">3 stars</label>
                        <input type="radio" id="outcome2" name="outcome" value="2" />
                        <label for="outcome2" title="2">2 stars</label>
                        <input type="radio" id="outcome1" name="outcome" value="1" />
                        <label for="outcome1" title="1">1 star</label>
                    </div>
                    @error('outcome')
                        <small class="text-danger">{{$message}}</small>    
                    @enderror
                </div>

                <textarea name="suggestions" id="suggestions" cols="30" rows="3" class="form-control" placeholder="Suggestion to improve our service"></textarea>
                <div class="form-group mt-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection