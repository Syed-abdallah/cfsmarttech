@extends('customer.dashboard.layout.layout')
@section('content')


<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Address</h2>
    </div>



    <div class="card">
    <div class="card-body">
        <form method="POST" action="{{  route('customer.addresses.store') }}">
            @csrf
            @if(isset($address))
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="address_line_1" class="form-label">Address Line 1*</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" 
                           value="{{ old('address_line_1', $address->address_line_1 ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" 
                           value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">City*</label>
                    <input type="text" class="form-control" id="city" name="city" 
                           value="{{ old('city', $address->city ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">State/Province*</label>
                    <input type="text" class="form-control" id="state" name="state" 
                           value="{{ old('state', $address->state ?? '') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="postal_code" class="form-label">Postal Code*</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" 
                           value="{{ old('postal_code', $address->postal_code ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country*</label>
                    <input type="text" class="form-control" id="country" name="country" 
                           value="{{ old('country', $address->country ?? '') }}" required>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_default" name="is_default" 
                       value="1" {{ old('is_default', isset($address) && $address->is_default ? 'checked' : '') }}>
                <label class="form-check-label" for="is_default">Set as default address</label>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('customer.addresses.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Address</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

