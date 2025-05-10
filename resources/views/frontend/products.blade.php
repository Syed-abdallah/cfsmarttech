@extends('frontend.layout.layout')
@section('content')
<section style="background-color: rgb(249, 251, 253); height: 65vh; display: flex; align-items: center; justify-content: center;">
    <div
      id="heroCarousel"
      class="carousel slide w-100 "
      data-bs-ride="carousel"
      data-bs-interval="2000"
    >
      <div class="carousel-inner text-center">
        <div class="carousel-item active">
          <h1 class="display-4 text-dark " >CF Smart Products</h1>
          <p class="lead text-dark">Control your lights, locks, and thermostat from anywhere.</p>
        </div>
        <div class="carousel-item">
          <h1 class="display-3 text-dark">Automated Security</h1>
          <p class="lead text-dark">2-way cameras, motion sensors, and instant alerts.</p>
        </div>
        <div class="carousel-item">
          <h1 class="display-3 text-dark">Energy Management</h1>
          <p class="lead text-dark">Optimize your power usage with smart monitoring.</p>
        </div>
      </div>
  
     
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>
  


  <div class="container py-5">
    <div class="row g-4">

     
      @foreach($products as $product)
      <div class="col-md-4 d-flex">
          <div class="card card-hover flex-fill text-center">
              @if(now()->diffInDays($product->created_at) <= 30)
                  <span class="position-absolute top-0 start-0 m-2 badge badge-animated text-white">
                      <i class="bi bi-star-fill me-1"></i> New
                  </span>
              @endif
              <div class="card-body">
                  <p class="card-text">{{ $product->description }}</p>
                  <h5 class="card-title">{{ $product->name }}</h5>
              </div>
              <img src="{{ asset('storage/' . $product->image) }}" 
                   class="img-fluid" 
                   alt="{{ $product->name }}" 
                   aos="fade-up" 
                   data-aos-duration="1000">
              <div class="card-footer mt-auto">
                  <a href="{{ url('/product_item/' . $product->id) }}" class="btn btn-learn">
                      Learn More <i class="bi bi-arrow-right ms-2"></i>
                  </a>
              </div>
          </div>
      </div>
  @endforeach


    </div>
</div>

@endsection