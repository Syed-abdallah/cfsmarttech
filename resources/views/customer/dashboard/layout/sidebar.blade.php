<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- Dashboard -->
                <li class="sidebar-item @if(request()->routeIs('cfcustomer.dashboard')) active @endif"> 
                    <a class="sidebar-link" href="{{ route('cfcustomer.dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider"></li>
                
                <!-- Orders Section -->
                <li class="nav-small-cap"><span class="hide-menu">Orders</span></li>
                
                <li class="sidebar-item @if(request()->routeIs('cfcustomer.customer.orders.*')) active @endif">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="shopping-cart" class="feather-icon"></i>
                        <span class="hide-menu">My Orders</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level base-level-line @if(request()->routeIs('cfcustomer.customer.orders.*')) show @endif">
                        <li class="sidebar-item @if(request()->routeIs('cfcustomer.customer.orders.index')) active @endif">
                            <a href="{{ route('cfcustomer.customer.orders.index') }}" class="sidebar-link">
                                <span class="hide-menu">Order List</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item @if(request()->routeIs('cfcustomer.customer.orders.track')) active @endif">
                            <a href="{{ route('cfcustomer.customer.orders.track', ['order_number' => 'sample']) }}" class="sidebar-link">
                                <span class="hide-menu">Track Order</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                
                <!-- Addresses Section -->
                <li class="sidebar-item @if(request()->routeIs('customer.addresses.*')) active @endif">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <i data-feather="map-pin" class="feather-icon"></i>
                        <span class="hide-menu">Addresses</span>
                    </a>
<ul aria-expanded="false" class="collapse first-level base-level-line @if(request()->routeIs('customer.*')) show @endif">
                                   <li class="sidebar-item @if(request()->routeIs('customer.show')) active @endif">
    <a href="{{ route('customer.show') }}" class="sidebar-link">
        <span class="hide-menu">My Addresses</span>
    </a>
</li>


                        <li class="sidebar-item @if(request()->routeIs('customer.addresses.create')) active @endif">
                            <a href="{{ route('customer.addresses.create') }}" class="sidebar-link">
                                <span class="hide-menu">Add New</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Account Section -->
                <li class="nav-small-cap"><span class="hide-menu">Account</span></li>
{{--                 
                <li class="sidebar-item @if(request()->routeIs('profile.edit')) active @endif">
                    <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
                        <i data-feather="user" class="feather-icon"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li> --}}
                
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('cfcustomer.logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('cfcustomer.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>