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
    <style>
        .product-text img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 1rem;
}

.product-text table {
    width: 100%;
    overflow-x: auto;
    display: block;
}

.product-text {
    word-wrap: break-word;
}

    </style>
  <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="mb-4">
                <h5 class="text-primary mb-3 fw-semibold d-flex align-items-center">
                    <i class="bi bi-file-text me-2"></i> Product Details
                </h5>
                <div class="product-text">
                    {!! $product->text !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
