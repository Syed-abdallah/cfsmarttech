@extends('customer.dashboard.layout.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Addresses</h2>
        <a href="{{ route('customer.addresses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Address
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($addresses as $address)
            <div class="col-md-6 mb-4">
                <div class="card h-100 {{ $address->is_default ? 'border-primary' : '' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">
                                @if($address->is_default)
                                    <span class="badge bg-primary">Default</span>
                                @endif
                            </h5>
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.addresses.edit', $address) }}">
                                            <i class="fas fa-edit me-2"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('customer.addresses.destroy', $address) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" 
                                                onclick="return confirm('Are you sure you want to delete this address?')">
                                                <i class="fas fa-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                    @if(!$address->is_default)
                                    <li>
                                        <form action="{{ route('customer.addresses.set-default', $address) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-check-circle me-2"></i> Set as Default
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <p class="card-text">
                            {{ $address->address_line_1 }}<br>
                            @if($address->address_line_2)
                                {{ $address->address_line_2 }}<br>
                            @endif
                            {{ $address->city }}, {{ $address->state }}<br>
                            {{ $address->postal_code }}, {{ $address->country }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    You haven't added any addresses yet.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection