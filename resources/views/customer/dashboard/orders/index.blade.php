@extends('customer.dashboard.layout.layout')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">
            You haven't placed any orders yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>{{ $order->items_count }}</td>
                        <td>Rs. {{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                       <td>
    <!-- View Button -->
    <a href="{{ route('cfcustomer.customer.orders.show', $order->order_number) }}" class="btn btn-sm btn-primary">
        View
    </a>

    <!-- Tracking Button -->
    <a href="{{ route('cfcustomer.customer.orders.track', $order->order_number) }}" class="btn btn-sm btn-info">
        Track
    </a>

    <!-- Cancel Button (Conditional) -->
    @if(in_array($order->status, ['pending', 'processing']))
        <form action="{{ route('cfcustomer.customer.orders.cancel', $order->order_number) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
        </form>
    @endif
</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
    @endif
</div>
@endsection