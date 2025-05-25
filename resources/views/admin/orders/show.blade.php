@extends('dashboard.layout.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Order #{{ $order->order_number }}</h2>
        <div>
            <a href="{{ route('cfadmin.orders.index') }}" class="btn btn-outline-secondary me-2">
                Back to Orders
            </a>
            <a href="{{ route('cfadmin.orders.invoice', $order->order_number) }}" class="btn btn-primary">
                Download Invoice
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Order Summary</h5>
                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucwords(str_replace('-', ' ', $order->payment_method)) }}</p>
                </div>
                <div class="col-md-6">
                    <h6>Shipping Address</h6>
                    <address>
                        {{ $shippingAddress['full_name'] ?? 'N/A' }}<br>
                        {{ $shippingAddress['address'] ?? '' }}<br>
                        {{ $shippingAddress['city'] ?? '' }}, {{ $shippingAddress['state'] ?? '' }}<br>
                        Phone: {{ $shippingAddress['phone'] ?? 'N/A' }}
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Order Items</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-end">Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td class="text-end">Rs. {{ number_format($item->price, 2) }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">Rs. {{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal:</th>
                            <td class="text-end">Rs. {{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Tax:</th>
                            <td class="text-end">Rs. {{ number_format($order->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Shipping:</th>
                            <td class="text-end">Rs. {{ number_format($order->shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Total:</th>
                            <td class="text-end">Rs. {{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @if(in_array($order->status, ['pending', 'processing']))
    <div class="text-end">
        <form action="{{ route('cfcustomer.customer.orders.cancel', $order->order_number) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                Cancel Order
            </button>
        </form>
    </div>
    @endif
</div>
@endsection