<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                {{-- Dashboard --}}
                <li class="sidebar-item {{ request()->routeIs('cfadmin.dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.dashboard') }}">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap mt-4"><span class="hide-menu">Applications</span></li>

   {{-- Orders --}}
                @php
                $orderRoutes = ['cfadmin.admin.orders.index', 'cfadmin.admin.orders.show'];
                @endphp
                <li class="sidebar-item {{ request()->routeIs($orderRoutes) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.admin.orders.index') }}">
                        <i data-feather="shopping-bag" class="feather-icon"></i>
                        <span class="hide-menu">Orders</span>
                    </a>
                </li>



                {{-- Products --}}
                @php
                $productRoutes = ['cfadmin.products.index', 'cfadmin.products.create', 'cfadmin.products.edit'];
                @endphp
                
                <li class="sidebar-item {{ request()->routeIs($productRoutes) ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->routeIs($productRoutes) ? '' : 'collapsed' }}" href="javascript:void(0)">
                        <i data-feather="box" class="feather-icon"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                    <ul aria-expanded="{{ request()->routeIs($productRoutes) ? 'true' : 'false' }}"
                        class="collapse first-level base-level-line {{ request()->routeIs($productRoutes) ? 'show' : '' }}">
                
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.products.index') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.products.index') ? 'active' : '' }}">
                                <span class="hide-menu">All Products</span>
                            </a>
                        </li>
                
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.products.create') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.products.create') ? 'active' : '' }}">
                                <span class="hide-menu">Add Product</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                {{-- Permissions --}}
                <li class="sidebar-item {{ request()->is('cfadmin/permissions*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.permissions.index') }}">
                        <i data-feather="key" class="feather-icon"></i>
                        <span class="hide-menu">Permissions</span>
                    </a>
                </li>

                {{-- Roles --}}
                <li class="sidebar-item {{ request()->is('cfadmin/roles*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.roles.index') }}">
                        <i data-feather="shield" class="feather-icon"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                </li>

                {{-- Users --}}
                @php
                $userRoutes = ['cfadmin.admin.index', 'cfadmin.admin.edit', 'cfadmin.admin.update', 'cfadmin.admin.delete'];
                $userSectionActive = request()->routeIs($userRoutes);
                @endphp
                <li class="sidebar-item {{ $userSectionActive ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ $userSectionActive ? '' : 'collapsed' }}" href="javascript:void(0)">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="{{ $userSectionActive ? 'true' : 'false' }}" class="collapse first-level base-level-line {{ $userSectionActive ? 'show' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.admin.index') }}" class="sidebar-link {{ request()->routeIs('cfadmin.admin.index') ? 'active' : '' }}">
                                <span class="hide-menu">All Users</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Marquee --}}
                <li class="sidebar-item {{ request()->is('cfadmin/marquees*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.marquees.index') }}">
                        <i data-feather="type" class="feather-icon"></i>
                        <span class="hide-menu">Announcements</span>
                    </a>
                </li>

                {{-- Sliders --}}
                <li class="sidebar-item {{ request()->is('cfadmin/sliders*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.sliders.index') }}">
                        <i data-feather="image" class="feather-icon"></i>
                        <span class="hide-menu">Sliders</span>
                    </a>
                </li>

                {{-- Partners --}}
                <li class="sidebar-item {{ request()->is('cfadmin/partners*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.partners.index') }}">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Partners</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>

                {{-- Profile --}}
                @php
                $profileRoutes = ['cfadmin.profile.edit', 'cfadmin.profile.update', 'cfadmin.profile.destroy'];
                @endphp
                <li class="sidebar-item {{ request()->routeIs($profileRoutes) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.profile.edit') }}">
                        <i data-feather="user" class="feather-icon"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i data-feather="log-out" class="feather-icon"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>