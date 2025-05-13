@extends('customer.dashboard.layout.layout')
@section('content')
    <!-- Dashboard Cards -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $activeOrders }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Active Orders</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="shopping-bag"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $completedOrders }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Completed Orders</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="check-circle"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-end">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $pendingRequests }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pending Requests</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="clock"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">${{ number_format($totalSpent, 2) }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Spent</h6>
                        </div>
                        <div class="ms-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Section -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Recent Orders</h4>
                        <div class="ms-auto">
                            <a href="{{ route('cfcustomer.customer.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Order ID</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Date</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Items</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted text-center">Status</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="border-top-0 px-2 py-4">
                                        <a href="{{ route('cfcustomer.customer.orders.show', $order->id) }}" class="text-dark">#{{ $order->order_number }}</a>
                                    </td>
                                    <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="border-top-0 px-2 py-4 font-14">{{ $order->items->count() }} Items</td>
                                    <td class="border-top-0 text-center px-2 py-4">
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="border-top-0 text-end font-weight-medium text-dark px-2 py-4">${{ number_format($order->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Activities</h4>
            <div class="mt-4 activity">
                @forelse($recentActivities as $activity)
                <div class="d-flex align-items-start border-left-line pb-3">
                    <div>
                        {{-- <a href="javascript:void(0)" class="btn btn-{{ $this->getActivityColor($activity['title']) }} btn-circle mb-2 btn-item">
                            <i data-feather="{{ $activity['icon'] }}"></i>
                        </a> --}}
                    </div>
                    <div class="ms-3 mt-2">
                        <h5 class="text-dark font-weight-medium mb-2">{{ $activity['title'] }}</h5>
                        <p class="font-14 mb-2 text-muted">{{ $activity['description'] }}</p>
                        <span class="font-weight-light font-14 text-muted">{{ $activity['time'] }}</span>
                        <a href="{{ route('cfcustomer.customer.orders.show', $activity['order_number']) }}" class="d-block font-14 mt-1">View Order</a>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i data-feather="shopping-bag" class="text-muted" width="48" height="48"></i>
                    <p class="text-muted mt-2">No recent order activities</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Helper function to get color based on activity type
    function getActivityColor(title) {
        const colors = {
            'Order Placed': 'info',
            'Order Processing': 'primary',
            'Order Shipped': 'warning',
            'Order Delivered': 'success',
            'Order Cancelled': 'danger'
        };
        return colors[title] || 'secondary';
    }
</script>
@endpush
    </div>

    <!-- Recommended Products Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Recommended For You</h4>
                        {{-- <div class="ms-auto">
                            <a href="{{ route('cfcustomer.customer.products.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        @foreach($recommendedProducts as $product)
                        <div class="col-md-3">
                            <div class="card product-card">
                                <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="font-weight-medium text-dark">${{ number_format($product->price, 2) }}</span>
                                         <a href="{{ route('cfcustomer.customer.cart.add', $product->id) }}" class="btn btn-sm btn-primary">Add to Cart</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection