@extends('customer.dashboard.layout.layout')
@section('content')


<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Address</h2>
    </div>



    <div class="card">
    <div class="card-body">
        {{-- <form method="POST" action="{{  route('customer.addresses.store') }}">
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
                <div class="col-md-6">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" 
                           value="{{ old('address_line_2', $address->address_line_2 ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label for="Phone" class="form-label">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" 
                           value="{{ old('phone', $address->phone ?? '') }}">
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
        </form> --}}
         <form action="{{ route('customer.addresses.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="full-name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full-name"
                                                placeholder="John Doe" value="{{ old('full_name') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" name="phone" id="phone"
                                                placeholder="+1 234 567 8900" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address-line1" class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" name="address_line1" id="address-line1"
                                            placeholder="123 Main Street" value="{{ old('address_line1') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address-line2" class="form-label">Address Line 2 (Optional)</label>
                                        <input type="text" class="form-control" name="address_line2" id="address-line2"
                                            placeholder="Apartment, suite, unit, etc." value="{{ old('address_line2') }}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" id="city"
                                                placeholder="New York" value="{{ old('city') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State/Province</label>
                                            <input type="text" class="form-control" name="state" id="state"
                                                placeholder="NY" value="{{ old('state') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zip" class="form-label">ZIP/Postal Code</label>
                                            <input type="text" class="form-control" name="zip" id="zip"
                                                placeholder="10001" value="{{ old('zip') }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select" name="country" id="country" required>
                                            <option value="">Select Country</option>
                                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United
                                                States</option>
                                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada
                                            </option>
                                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United
                                                Kingdom</option>
                                            <option value="PK" {{ old('country') == 'PK' ? 'selected' : '' }}>Pakistan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" name="is_default"
                                            id="default-address" {{ old('is_default') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="default-address">
                                            Set as default shipping address
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" id="cancel-address-btn"
                                            class="btn btn-outline-secondary rounded-pill px-4">
                                            <i class="bi bi-x-circle me-2"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-check-circle me-2"></i> Save Address
                                        </button>
                                    </div>
                                </form>
    </div>
</div>
</div>
@endsection

