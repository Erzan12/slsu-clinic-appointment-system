@if(auth()->user()->account_type == 1)
<div>
    <h2 class="text-center my-2">SLSU - CAS Summary</h2>
    <div class="row row-cols-1 row-cols-md-5 g-1 gap-4 justify-content-center">
        <div class="card shadow col">
            <div class="card-body d-flex justify-content-center">
                <h2>{{$patients}}</h2>
            </div>
            <div class="card-footer">
                <small>
                Number of Patients
                </small>
            </div>
            <a href="{{route('patients.list')}}" class="stretched-link"></a>
        </div>

        <div class="card shadow col">
            <div class="card-body d-flex justify-content-center">
                <h2>{{$services}}</h2>
            </div>
            <div class="card-footer text-break">
                <small>
                Number of Specialists
                </small>
            </div>
            <a href="{{route('specialists.index')}}" class="stretched-link"></a>
        </div>

        <div class="card shadow col">
            <div class="card-body d-flex justify-content-center">
                <h2>{{$services}}</h2>
            </div>
            <div class="card-footer">
                <small>
                Numbers of Services
                </small>
            </div>
            <a href="{{route('services.index')}}" class="stretched-link"></a>
        </div>

        <div class="card shadow col">
            <div class="card-body d-flex justify-content-center">
                <h2>{{$appointments}}</h2>
            </div>
            <div class="card-footer">
                <small>
                    Numbers of Appointments
                </small>
            </div>
            <a href="{{route('appointments.index')}}" class="stretched-link"></a>
        </div>
    </div>
</div>
@endif