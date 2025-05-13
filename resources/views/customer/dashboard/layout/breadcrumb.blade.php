<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                @auth('customer')
                    @php
                        $pakistanTime = now()->setTimezone('Asia/Karachi');
                        $hour = $pakistanTime->format('H');
                        $greeting = match(true) {
                            $hour < 12 => 'Good Morning',
                            $hour < 17 => 'Good Afternoon',
                            $hour < 20 => 'Good Evening',
                            default => 'Good Night',
                        };
                    @endphp
                    {{ $greeting }}, {{ Auth::guard('customer')->user()->name }}!
                @else
                    Welcome!
                @endauth
            </h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('cfcustomer.dashboard') }}">Dashboard</a>
                        </li>

                        @if(request()->routeIs('cfcustomer.customer.orders.index'))
                            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                        @elseif(request()->routeIs('cfcustomer.customer.orders.show'))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cfcustomer.customer.orders.index') }}">My Orders</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                        @elseif(request()->routeIs('cfcustomer.customer.orders.track'))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cfcustomer.customer.orders.index') }}">My Orders</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Track Order</li>
                        @elseif(request()->routeIs('cfcustomer.customer.orders.invoice'))
                            <li class="breadcrumb-item">
                                <a href="{{ route('cfcustomer.customer.orders.index') }}">My Orders</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                        @elseif(request()->routeIs('customer.addresses.*'))
                            <li class="breadcrumb-item active" aria-current="page">My Addresses</li>
                        @elseif(request()->routeIs('profile.*'))
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>