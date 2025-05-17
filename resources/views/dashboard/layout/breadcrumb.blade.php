<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                @auth
                @php
                    // Set to Pakistan timezone (UTC+5)
                    $pakistanTime = now()->setTimezone('Asia/Karachi');
                    $hour = $pakistanTime->format('H');
                    
                    if ($hour < 12) {
                        $greeting = 'Good Morning';
                    } elseif ($hour < 17) {
                        $greeting = 'Good Afternoon';
                    } elseif ($hour < 20) {
                        $greeting = 'Good Evening';
                    } else {
                        $greeting = 'Good Night';
                    }
                @endphp
                {{ $greeting }}, {{ Auth::user()->name }}!
            @else
                Welcome!
            @endauth
            </h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                   <li class="breadcrumb-item">
    <a href="{{ route('cfadmin.dashboard') }}">Dashboard</a>
</li>

@if(request()->routeIs('cfadmin.products.*'))
    <li class="breadcrumb-item active" aria-current="page">Products</li>
@elseif(request()->routeIs('cfadmin.permissions.*'))
    <li class="breadcrumb-item active" aria-current="page">Permissions</li>
@elseif(request()->routeIs('cfadmin.orders.*'))
    <li class="breadcrumb-item active" aria-current="page">Orders</li>
@elseif(request()->routeIs('cfadmin.roles.*'))  <!-- Fixed from duplicate orders.* to roles.* -->
    <li class="breadcrumb-item active" aria-current="page">Roles</li>
@elseif(request()->routeIs('cfadmin.admin.*'))
    <li class="breadcrumb-item active" aria-current="page">Users</li>
@elseif(request()->routeIs('cfadmin.marquees.*'))
    <li class="breadcrumb-item active" aria-current="page">Announcements</li> <!-- Better label than just "Marquee" -->
@elseif(request()->routeIs('cfadmin.sliders.*'))
    <li class="breadcrumb-item active" aria-current="page">Sliders</li>
@elseif(request()->routeIs('cfadmin.partners.*'))
    <li class="breadcrumb-item active" aria-current="page">Partners</li> <!-- Fixed typo "Partners" -->
@elseif(request()->routeIs('cfadmin.profile.*'))
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
@elseif(request()->routeIs('cfadmin.commercial.*'))
    <li class="breadcrumb-item active" aria-current="page">Commercial</li>
@endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>