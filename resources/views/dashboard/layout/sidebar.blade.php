<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                {{-- Dashboard --}}
                {{-- @can('view dashboard') --}}
                <li class="sidebar-item {{ request()->routeIs('cfadmin.dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.dashboard') }}">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                {{-- @endcan --}}

                <li class="nav-small-cap mt-4"><span class="hide-menu">Applications</span></li>

                {{-- Orders --}}
                @php
                    $orderRoutes = ['cfadmin.admin.orders.index', 'cfadmin.admin.orders.show'];
                @endphp
                @can('view order')
                <li class="sidebar-item {{ request()->routeIs($orderRoutes) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.admin.orders.index') }}">
                        <i data-feather="shopping-bag" class="feather-icon"></i>
                        <span class="hide-menu">Orders</span>
                    </a>
                </li>
                @endcan

                {{-- Products --}}
                @php
                    $productRoutes = ['cfadmin.products.index', 'cfadmin.products.create', 'cfadmin.products.edit'];
                @endphp
                @canany(['view product', 'create product'])
                <li class="sidebar-item {{ request()->routeIs($productRoutes) ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->routeIs($productRoutes) ? '' : 'collapsed' }}"
                        href="javascript:void(0)">
                        <i data-feather="box" class="feather-icon"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                    <ul aria-expanded="{{ request()->routeIs($productRoutes) ? 'true' : 'false' }}"
                        class="collapse first-level base-level-line {{ request()->routeIs($productRoutes) ? 'show' : '' }}">
                        @can('view product')
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.products.index') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.products.index') ? 'active' : '' }}">
                                <span class="hide-menu">All Products</span>
                            </a>
                        </li>
                        @endcan
                        @can('create product')
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.products.create') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.products.create') ? 'active' : '' }}">
                                <span class="hide-menu">Add Product</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- Permissions --}}
                {{-- @can('view permission')
                <li class="sidebar-item {{ request()->is('cfadmin/permissions*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.permissions.index') }}">
                        <i data-feather="key" class="feather-icon"></i>
                        <span class="hide-menu">Permissions</span>
                    </a>
                </li>
                @endcan --}}

                {{-- Roles --}}
                @can('view role')
                <li class="sidebar-item {{ request()->is('cfadmin/roles*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.roles.index') }}">
                        <i data-feather="shield" class="feather-icon"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                </li>
                @endcan

                {{-- Users --}}
                @php
                    $userRoutes = [
                        'cfadmin.admin.index',
                        'cfadmin.admin.edit',
                        'cfadmin.admin.update',
                        'cfadmin.admin.delete',
                    ];
                    $userSectionActive = request()->routeIs($userRoutes);
                @endphp
                @can('view user')
                <li class="sidebar-item {{ $userSectionActive ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ $userSectionActive ? '' : 'collapsed' }}"
                        href="javascript:void(0)">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="{{ $userSectionActive ? 'true' : 'false' }}"
                        class="collapse first-level base-level-line {{ $userSectionActive ? 'show' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.admin.index') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.admin.index') ? 'active' : '' }}">
                                <span class="hide-menu">All Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- Pricing --}}
                @php
                    $commercialRoutes = [
                        'cfadmin.commercial.index',
                        'cfadmin.commercial.edit',
                        'cfadmin.commercial.update',
                    ];
                    $commercialSectionActive = request()->routeIs($commercialRoutes);

                    $additionalCostRoutes = [
                        'additionalcost.index',
                        'additionalcost.edit',
                        'additionalcost.update',
                        'additionalcost.destroy',
                    ];
                    $additionalCostSectionActive = request()->routeIs($additionalCostRoutes);

                    $roomTypeRoutes = [
                        'roomtype.index',
                        'roomtype.edit',
                        'roomtype.update',
                        'roomtype.destroy',
                    ];
                    $roomTypeSectionActive = request()->routeIs($roomTypeRoutes);
                @endphp

                @canany(['view commercial', 'view additional-cost', 'view roomtype'])
                <li class="sidebar-item {{ $commercialSectionActive || $additionalCostSectionActive || $roomTypeSectionActive ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ $commercialSectionActive || $additionalCostSectionActive || $roomTypeSectionActive ? '' : 'collapsed' }}"
                        href="javascript:void(0)">
                        <i data-feather="dollar-sign" class="feather-icon"></i>
                        <span class="hide-menu">Pricing</span>
                    </a>
                    <ul aria-expanded="{{ $commercialSectionActive || $additionalCostSectionActive || $roomTypeSectionActive ? 'true' : 'false' }}"
                        class="collapse first-level base-level-line {{ $commercialSectionActive || $additionalCostSectionActive || $roomTypeSectionActive ? 'show' : '' }}">
                        @can('view commercial')
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.commercial.index') }}"
                                class="sidebar-link {{ request()->routeIs('cfadmin.commercial.index') ? 'active' : '' }}">
                                <i data-feather="dollar-sign" class="feather-icon"></i>
                                <span class="hide-menu">Commercial Pricing</span>
                            </a>
                        </li>
                        @endcan
                        @can('view additional-cost')
                        <li class="sidebar-item">
                            <a href="{{ route('cfadmin.additional-cost.index') }}"
                                class="sidebar-link {{ request()->routeIs('additionalcost.index') ? 'active' : '' }}">
                                <i data-feather="plus-circle" class="feather-icon"></i>
                                <span class="hide-menu">Additional Costs</span>
                            </a>
                        </li>
                        @endcan
                        @can('view roomtype')
                        <li class="sidebar-item {{ $roomTypeSectionActive ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('cfadmin.roomtype.index') }}">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">Room Types</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- Marquee --}}
                @can('view marquee')
                <li class="sidebar-item {{ request()->is('cfadmin/marquees*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.marquees.index') }}">
                        <i data-feather="type" class="feather-icon"></i>
                        <span class="hide-menu">Announcements</span>
                    </a>
                </li>
                @endcan

                {{-- Sliders --}}
                @can('view slider')
                <li class="sidebar-item {{ request()->is('cfadmin/sliders*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.sliders.index') }}">
                        <i data-feather="image" class="feather-icon"></i>
                        <span class="hide-menu">Sliders</span>
                    </a>
                </li>
                @endcan
           @can('view faq')
<li class="sidebar-item {{ request()->is('cfadmin/faqs*') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('cfadmin.faqs.index') }}">
        <i class="fas fa-question-circle"></i>
        <span class="hide-menu">FAQs</span>
    </a>
</li>
@endcan

                {{-- Partners --}}
                @can('view partner')
                <li class="sidebar-item {{ request()->is('cfadmin/partners*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cfadmin.partners.index') }}">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Partners</span>
                    </a>
                </li>
                @endcan

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>


      <!-- Register -->
                @can('create register')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/userregister') ? 'active' : '' }}" 
                       href="{{ route('cfadmin.newuser.register') }}" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>
                @endcan

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
                        <a class="sidebar-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i data-feather="log-out" class="feather-icon"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>