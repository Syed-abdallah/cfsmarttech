@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Product</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('cfadmin.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="text">Detailed Content</label>
                <textarea class="form-control" id="text" name="text" rows="5">{{ old('text', $product->text) }}</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="image">Main Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($product->image)
                    <div class="mt-2">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Current Image" style="max-height: 100px;">
                     
                    </div>
                @endif
            </div>
            
            <div class="form-group mb-3">
                <label for="image1">Additional Image 1</label>
                <input type="file" class="form-control" id="image1" name="image1">
                @if($product->image1)
                    <div class="mt-2">
                        <img src="{{ asset('uploads/products/' . $product->image1) }}" alt="Current Image 1" style="max-height: 100px;">
                     
                    </div>
                @endif
            </div>
            
            <div class="form-group mb-3">
                <label for="image2">Additional Image 2</label>
                <input type="file" class="form-control" id="image2" name="image2">
                @if($product->image2)
                    <div class="mt-2">
                        <img src="{{ asset('uploads/products/' . $product->image2) }}" alt="Current Image 2" style="max-height: 100px;">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_image2" id="remove_image2" value="1">
                            <label class="form-check-label" for="remove_image2">Remove current image</label>
                        </div>
                    </div>
                @endif
            </div>
            
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('cfadmin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection