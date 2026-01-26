<div>
    <div class="container">
        <div class="service-wrapper">
            <h2>Services</h2>
            <p>What we can offer</p>
            <div class="service-item-wrapper">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    @foreach ($services as $service)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ Storage::url($service->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title text-center">{{ $service->name }}</h5>
                                <p class="card-text service-description">{{ $service->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>