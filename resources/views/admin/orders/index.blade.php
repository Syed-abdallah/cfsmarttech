@extends('dashboard.layout.layout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">All Orders</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
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
                            <td>{{ $order->customer->name ?? 'Guest' }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>{{ $order->items->count() }}</td>
                            <td>Rs. {{ number_format($order->total, 2) }}</td>
                            {{-- <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td> --}}
                            @can('update order status')
                             <td>
                                <select class="form-select form-select-sm status-dropdown" data-order-id="{{ $order->id }}" style="width: auto; display: inline-block;">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }} d-none status-badge">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            @endcan
                            <td>
                                @can('show order')
                                <a href="{{ route('cfadmin.admin.orders.show', $order->order_number) }}" class="btn btn-sm btn-primary">
                                View
                                </a>
                                @endcan
                                @can('view order invoice')
                                <a href="{{ route('cfadmin.admin.orders.invoice', $order->order_number) }}" class="btn btn-sm btn-secondary">
                                    Track
                                </a>
                                 @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $orders->links() }}
        </div>
    </div>
</div>


@endsection