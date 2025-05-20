@extends('frontend.layout.layout')
@section('content')
    <div class="container py-5" style="margin-top: 100px;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-breadcrumb">
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Heading -->
        <h1 class="text-center mb-0">{{ $product->name }}</h1>

        <!-- Device Image -->
        <div class="device-circle text-center">
            <div class="temperature-display mt-1">{{ $product->sku }}</div>
            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid"
                style="max-width: 100%;" data-aos="fade-up" />
        </div>

        <!-- Stock Status -->
        <div class="stock-status {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }} text-center mt-3">
            @if ($product->quantity > 0)
                <i class="bi bi-check-circle-fill"></i> In Stock ({{ $product->quantity }} available)
            @else
                <i class="bi bi-x-circle-fill"></i> Out of Stock
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center mt-5">
            @if ($product->quantity > 0)
                <button class="add-to-cart" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                    data-price="{{ $product->price }}" data-image="{{ asset('storage/' . $product->image) }}"
                    data-stock="{{ $product->quantity }}">
                    <span class="box">Add to Cart</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Additional Images -->
    <div class="container my-5">
        {{-- <div class="row">
        <div class="col-md-6  ">
            <img src="{{ asset('uploads/products/' . $product->image1) }}" alt="First image" 
                 class="img-fluid rounded shadow hover-zoom">
        </div>
        <div class="col-md-6">
            <img src="{{ asset('uploads/products/' . $product->image2) }}" alt="Second image" 
                 class="img-fluid rounded shadow hover-zoom">
        </div>
    </div> --}}
       <div class="row g-3">
 
        <div class="col-md-4">
            <img src="{{ asset('uploads/products/' . $product->image1) }}" alt="Product image 1"
                class="img-fluid rounded shadow w-100" style="height: 250px; object-fit: cover;">
        </div>

   
        <div class="col-md-4">
            <img src="{{ asset('uploads/products/' . $product->image2) }}" alt="Product image 2"
                class="img-fluid rounded shadow w-100" style="height: 250px; object-fit: cover;">
        </div>
  

        <div class="col-md-4">
            <img src="{{ asset('uploads/products/' . $product->image1) }}" alt="Product image 3"
                class="img-fluid rounded shadow w-100" style="height: 250px; object-fit: cover;">
        </div>

 
        <div class="col-md-6">
            <img src="{{ asset('uploads/products/' . $product->image2) }}" alt="Product image 4"
                class="img-fluid rounded shadow w-100" style="height: 300px; object-fit: cover;">
        </div>

        <div class="col-md-6">
            <img src="{{ asset('uploads/products/' . $product->image1) }}" alt="Product image 5"
                class="img-fluid rounded shadow w-100" style="height: 300px; object-fit: cover;">
        </div>

</div>

    </div>
    <!-- Product Details Section -->
    <div class="container mt-5">
        <div class="mb-4">
            <h5 class="text-primary mb-3 fw-semibold">
                <i class="bi bi-file-text me-2"></i> Product Details
            </h5>
            {!! $product->text !!}
            {{-- <div class="bg-light p-4 rounded-3" style="background-color: #f8f9fa!important;">
            <textarea id="productText" 
                      class="form-control bg-transparent p-3 border-0 shadow-none summernote-editor" 
                      rows="8" 
                      style="resize: none; font-size: 1rem; line-height: 1.6; min-height: 200px;">
            </textarea>
        </div> --}}
        </div>
    </div>
@endsection
