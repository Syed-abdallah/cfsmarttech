{{-- @extends('dashboard.layout.layout')

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
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer->name ?? 'Guest' }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>{{ $order->items->count() }}</td>
                            <td>Rs. {{ number_format($order->total, 2) }}</td> --}}
{{-- <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td> --}}
{{-- @can('update order status')
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
                            <td> --}}
{{-- @can('show order')
                                <a href="{{ route('cfadmin.orders.show', $order->order_number) }}" class="btn btn-sm btn-primary">
                                View
                                </a>
                                @endcan --}}
{{--                           
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


@endsection --}}




@extends('dashboard.layout.layout')

@section('content')
{{-- <div class="d-flex justify-content-end">
    <a href="/cfadmin/orders/create">
        <button type="button" class="btn btn-primary mb-3">
            <i class="mdi mdi-plus"></i> Add Order
        </button>
    </a>
</div> --}}
    <div class="card">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Orders</h4>


         <form method="GET" action="{{ route('cfadmin.orders.index') }}" class="d-flex">
    <div class="me-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control form-control-sm" id="start_date" name="start_date"
            value="{{ request('start_date', now()->subDays(30)->format('Y-m-d')) }}">
    </div>
    <div class="me-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control form-control-sm" id="end_date" name="end_date"
            value="{{ request('end_date', now()->format('Y-m-d')) }}">
    </div>
    <div class="align-self-end">
        <button type="submit" class="btn btn-sm btn-primary" id="filter_btn">Filter</button>
        @if (request('start_date') || request('end_date'))
            <a href="{{ route('cfadmin.orders.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
        @endif
    </div>
</form>

                
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Number</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer->name ?? 'Guest' }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>Rs. {{ number_format($order->total, 2) }}</td>

                                @can('update order status')
                                    <td>
                                        <select class="form-select form-select-sm status-dropdown"
                                            data-order-id="{{ $order->id }}" style="width: auto; display: inline-block;">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                Processing</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                            </option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                        <span
                                            class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }} d-none status-badge">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                @endcan

                                <td>
                                    <a href="{{ route('cfadmin.admin.orders.show', $order->order_number) }}"
                                        class="btn btn-sm btn-outline-primary" title="View Details">
                                        <i data-feather="eye" class="feather-sm"></i>
                                    </a>
                                    {{-- <a href="{{ route('cfadmin.orders.edit', $order->id) }}">
                                <button type="button" class="btn btn-sm btn-info">
                                    <i class="icon-pencil"></i>
                                </button>
                            </a> --}}

                                    {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrderModal{{ $order->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteOrderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this order: <strong>{{ $order->order_number }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('cfadmin.orders.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
