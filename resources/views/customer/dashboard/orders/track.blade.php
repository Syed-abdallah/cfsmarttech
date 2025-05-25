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
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</p>
                    <p><strong>Total:</strong> {{ config('settings.currency_symbol') }}{{ number_format($order->total, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Shipping Details</h5>
                    @php
                        $shippingAddress = json_decode($order->shipping_address);
                    @endphp
                    @if($shippingAddress)
                        <p><strong>Name:</strong> {{ $shippingAddress->full_name ?? '' }}</p>
                        <p><strong>Phone:</strong> {{ $shippingAddress->phone ?? '' }}</p>
                        <p><strong>Address:</strong> {{ $shippingAddress->address_line1 ?? '' }}, {{ $shippingAddress->address_line2 ?? '' }}</p>
                        <p><strong>City:</strong> {{ $shippingAddress->city ?? '' }}, {{ $shippingAddress->state ?? '' }}</p>
                    @else
                        <p>No shipping address provided</p>
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
                    @if(isset($order->items) && count($order->items) > 0)
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name ?? 'N/A' }}</td>
                            <td>{{ config('settings.currency_symbol') }}{{ number_format($item->price ?? 0, 2) }}</td>
                            <td>{{ $item->quantity ?? 0 }}</td>
                            <td>{{ config('settings.currency_symbol') }}{{ number_format(($item->quantity ?? 0) * ($item->price ?? 0), 2) }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No items found for this order</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection