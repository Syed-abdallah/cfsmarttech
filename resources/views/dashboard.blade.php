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
                            <h3 class="mb-1">${{ number_format($totalRevenue, 2) }}</h3>
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
                            <h6 class="text-muted mb-0">New Orders</h6>
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
                            <h3 class="mb-1">${{ number_format($monthlyRevenue, 2) }}</h3>
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

    <!-- Analytics Section -->
    <div class="row">
        <!-- Sales Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales Analytics</h4>
                    <div class="dropdown ms-auto">
                        <a href="#" class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            Last 30 Days <i class="fa fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Last Week</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                            <a class="dropdown-item" href="#">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-primary btn-sm">Apply</button>
                        </div>
                    </div>
                    <div id="sales-chart" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- Revenue Sources -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Revenue Sources</h4>
                </div>
                <div class="card-body">
                    <div id="revenue-sources" style="min-height: 250px;"></div>
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">&nbsp;</span>
                                <span>Online Payments</span>
                            </div>
                            <span class="fw-bold">${{ number_format($onlinePayments, 2) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger me-2">&nbsp;</span>
                                <span>Bank Transfers</span>
                            </div>
                            <span class="fw-bold">${{ number_format($bankTransfers, 2) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success me-2">&nbsp;</span>
                                <span>Cash on Delivery</span>
                            </div>
                            <span class="fw-bold">${{ number_format($codPayments, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Orders</h4>
                    <div class="dropdown ms-auto">
                        <a href="#" class="btn btn-outline-light btn-sm" data-bs-toggle="dropdown">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">View All</a>
                            <a class="dropdown-item" href="#">Export</a>
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
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ json_decode($order->shipping_address)->full_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row">
        <!-- Top Products -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top Selling Products</h4>
                </div>
                <div class="card-body">
                    @foreach($topProducts as $product)
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" 
                                 class="rounded" width="60">
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $product->product_name }}</h6>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: {{ ($product->total_sold / $maxProductSales) * 100 }}%"></div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 ms-3 text-end">
                            <h6 class="mb-1">{{ $product->total_sold }}</h6>
                            <small class="text-muted">Sold</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Status</h4>
                </div>
                <div class="card-body">
                    <div id="order-status-chart" style="min-height: 250px;"></div>
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

        <!-- Recent Activity -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Activity</h4>
                </div>
                <div class="card-body activity-scroll" style="max-height: 400px; overflow-y: auto;">
                    @foreach($recentActivities as $activity)
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-xs">
                                <span class="avatar-title rounded-circle bg-{{ 
                                    $activity->type == 'order' ? 'info' : 
                                    ($activity->type == 'payment' ? 'success' : 
                                    ($activity->type == 'shipment' ? 'primary' : 'warning')) 
                                }}-subtle text-{{ 
                                    $activity->type == 'order' ? 'info' : 
                                    ($activity->type == 'payment' ? 'success' : 
                                    ($activity->type == 'shipment' ? 'primary' : 'warning')) 
                                }} font-size-16">
                                    <i class="{{ 
                                        $activity->type == 'order' ? 'fas fa-shopping-cart' : 
                                        ($activity->type == 'payment' ? 'fas fa-dollar-sign' : 
                                        ($activity->type == 'shipment' ? 'fas fa-truck' : 'fas fa-exclamation-circle')) 
                                    }}"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $activity->title }}</h6>
                            <p class="text-muted mb-1">{{ $activity->description }}</p>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Sales Chart
        var salesChart = new ApexCharts(document.querySelector("#sales-chart"), {
            series: [{
                name: 'Sales',
                data: @json(array_values($dailySales))
            }],
            chart: {
                type: 'area',
                height: 300,
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            colors: ['#5D87FF'],
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                }
            },
            xaxis: {
                categories: @json(array_keys($dailySales)),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: { show: false },
            grid: { borderColor: '#f1f1f1' },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$" + val
                    }
                }
            }
        });
        salesChart.render();

        // Revenue Sources Chart
        var revenueChart = new ApexCharts(document.querySelector("#revenue-sources"), {
            series: @json(array_values($paymentMethodData)),
            chart: {
                type: 'donut',
                height: 250,
            },
            labels: @json(array_keys($paymentMethodData)),
            colors: ['#5D87FF', '#FA896B', '#6FD943'],
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function (w) {
                                    return '$' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toFixed(2)
                                }
                            }
                        }
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: { chart: { width: 200 } }
            }]
        });
        revenueChart.render();

        // Order Status Chart
        var statusChart = new ApexCharts(document.querySelector("#order-status-chart"), {
            series: @json(array_values($orderStatusData)),
            chart: {
                type: 'radialBar',
                height: 250,
            },
            plotOptions: {
                radialBar: {
                    hollow: { size: '50%' },
                    dataLabels: {
                        name: { fontSize: '14px' },
                        value: { fontSize: '16px' },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return {{ array_sum(array_values($orderStatusData)) }}
                            }
                        }
                    }
                }
            },
            labels: @json(array_keys($orderStatusData)),
            colors: ['#5D87FF', '#49BEFF', '#6FD943', '#FF5E5E'],
        });
        statusChart.render();
    });
</script>
@endpush

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
    .progress-sm {
        height: 6px;
    }
    .activity-scroll::-webkit-scrollbar {
        width: 5px;
    }
    .activity-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .activity-scroll::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    .avatar-xs {
        height: 36px;
        width: 36px;
    }
</style>
@endpush