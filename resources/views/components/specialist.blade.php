<div>
    <div class="container">
        <div class="service-wrapper">
            <h2>Meet our Specialists</h2>
            <p>SLSU Medical Clinic Personnel </p>
            <div class="service-item-wrapper">
                <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">

                    @foreach ($specialists as $specialist) 
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset($specialist->avatar) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title text-center">{{ $specialist->first_name }} {{ $specialist->last_name }}</h5>
                                <p class="card-text text-center">{{ $specialist->position }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>