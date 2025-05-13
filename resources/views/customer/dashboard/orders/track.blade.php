@extends('customer.dashboard.layout.layout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Order Tracking #{{ $order->order_number }}</h1>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Order Details</h5>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                    <p><strong>Total:</strong> {{ $order->total_amount }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Shipping Details</h5>
                    @if($order->shippingAddress)
                        <p>{{ $order->shippingAddress->address_line_1 }}</p>
                        <p>{{ $order->shippingAddress->city }}, {{ $order->shippingAddress->state }} {{ $order->shippingAddress->postal_code }}</p>
                        <p>{{ $order->shippingAddress->country }}</p>
                    @endif
                </div>
            </div>

            <hr>

            <h5 class="mt-4">Order Items</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->quantity * $item->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection