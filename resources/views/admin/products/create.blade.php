@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create New Product</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cfadmin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            
            {{-- <div class="form-group mb-3">
                <label for="text">Detailed Content</label>
                <textarea class="form-control" id="text" name="text" rows="5">{{ old('text') }}</textarea>
            </div> --}}

            <div class="form-group mb-3">
    <label for="text">Detailed Content</label>
    <textarea class="form-control" id="text" name="text">{{ old('text') }}</textarea>
</div>
            
            <div class="form-group mb-3">
                <label for="image">Main Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="image1">Additional Image 1</label>
                <input type="file" class="form-control" id="image1" name="image1">
            </div>
            
            <div class="form-group mb-3">
                <label for="image2">Additional Image 2</label>
                <input type="file" class="form-control" id="image2" name="image2">
            </div>
            
            <button type="submit" class="btn btn-primary">Create Product</button>
            <a href="{{ route('cfadmin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection