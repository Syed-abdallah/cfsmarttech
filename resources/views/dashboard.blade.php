@extends('dashboard.layout.layout')
@section('content')
    <!-- Page Title and Breadcrumb -->
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Analytics</a></li>
        </ol>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i data-feather="dollar-sign" class="feather-lg"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ number_format($totalRevenue, 2) }}</h3>
                            <h6 class="text-muted mb-0">Total Revenue</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info text-white rounded p-3 me-3">
                            <i data-feather="shopping-cart" class="feather-lg"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ $newOrdersCount }}</h3>
                            <h6 class="text-muted mb-0">New Orders (7 days)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded p-3 me-3">
                            <i data-feather="calendar" class="feather-lg"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ number_format($monthlyRevenue, 2) }}</h3>
                            <h6 class="text-muted mb-0">Monthly Revenue</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded p-3 me-3">
                            <i data-feather="package" class="feather-lg"></i>
                        </div>
                        <div>
                            <h3 class="mb-1">{{ $productsSold }}</h3>
                            <h6 class="text-muted mb-0">Products Sold</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders with Date Filter -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Recent Orders</h4>
                        <div class="d-flex">
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
                                <button class="btn btn-sm btn-primary" id="filter_btn">Filter</button>
                                @if(request('start_date') || request('end_date'))
                                    <a href="{{ route('cfadmin.dashboard') }}" class="btn btn-sm btn-outline-secondary ms-2">Reset</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>
                                        @if($order->shipping_address && is_string($order->shipping_address))
                                            @php
                                                $shippingAddress = json_decode($order->shipping_address);
                                            @endphp
                                            {{ $shippingAddress->full_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('-', ' ', $order->payment_method)) }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $order->status == 'completed' ? 'success' : 
                                            ($order->status == 'processing' ? 'primary' : 
                                            ($order->status == 'shipped' ? 'info' : 
                                            ($order->status == 'cancelled' ? 'danger' : 'warning'))) 
                                        }} rounded-pill">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('cfadmin.admin.orders.show', $order->order_number) }}" 
                                           class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i data-feather="eye" class="feather-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row">
        <!-- Order Status -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Status</h4>
                </div>
                <div class="card-body">
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">&nbsp;</span>
                                <span>Processing</span>
                            </div>
                            <span class="fw-bold">{{ $processingOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-info me-2">&nbsp;</span>
                                <span>Shipped</span>
                            </div>
                            <span class="fw-bold">{{ $shippedOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">&nbsp;</span>
                                <span>Completed</span>
                            </div>
                            <span class="fw-bold">{{ $completedOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-2">&nbsp;</span>
                                <span>Cancelled</span>
                            </div>
                            <span class="fw-bold">{{ $cancelledOrders }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Revenue Sources -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Revenue Sources</h4>
                </div>
                <div class="card-body">
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">&nbsp;</span>
                                <span>Online Payments</span>
                            </div>
                            <span class="fw-bold">{{ number_format($onlinePayments, 2) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-2">&nbsp;</span>
                                <span>Bank Transfers</span>
                            </div>
                            <span class="fw-bold">{{ number_format($bankTransfers, 2) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">&nbsp;</span>
                                <span>Cash on Delivery</span>
                            </div>
                            <span class="fw-bold">{{ number_format($codPayments, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter button click handler
        document.getElementById('filter_btn').addEventListener('click', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            
            if (startDate && endDate && startDate > endDate) {
                alert('Start date cannot be after end date');
                return;
            }
            
            let url = new URL(window.location.href);
            url.searchParams.set('start_date', startDate);
            url.searchParams.set('end_date', endDate);
            window.location.href = url.toString();
        });
    });
    </script>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-bottom: 24px;
    }
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
    }
    .table th {
        border-top: none;
    }
    .badge {
        padding: 0.35em 0.65em;
    }
</style>
@endpush