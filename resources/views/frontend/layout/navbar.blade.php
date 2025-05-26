<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-custom">
    <div class="container flex-column">
        
        <!-- MOBILE VIEW: Toggler Left, Logo Right -->

<div class="d-flex w-100 align-items-center justify-content-between d-lg-none">
    <!-- Logo on the left -->
    <a class="navbar-brand" href="#">
        @if($settings->logo_path)
        <img src="{{ $settings->logo_path }}" alt="" width="60px" height="60px" style="margin-top: -10px; margin-bottom: -10px;">
        @endif
    </a>

    <!-- Toggler on the right -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>


        <!-- DESKTOP VIEW: Centered Logo and Website Name -->
        <div class="d-none d-lg-flex justify-content-center align-items-center flex-column">
            <a class="navbar-brand" href="#">
                @if($settings->logo_path)
                <img src="{{ $settings->logo_path }}" alt="" width="60px" height="60px" class="mx-auto d-block" style="margin-top: -13px; margin-bottom: -16px;">
                @endif
            </a>
            <a class="navbar-brand text-center" href="#">
                <span style="color: {{ $settings->name_color }};">{{ $settings->website_name }}</span>
            </a>
        </div>

        <!-- Navigation and Cart -->
        <div class="d-flex justify-content-between w-100 align-items-center">
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Products</a>
                    </li>
                    <li class="nav-item dropdown mega-dropdown position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="megaMenu" role="button">
                            Services
                        </a>
                        <div class="dropdown-menu mega-menu shadow-lg border-0 p-0" aria-labelledby="megaMenu">
                            <div class="container py-4">
                                <div class="row g-4">
                                    <!-- Column 1 -->
                                    <div class="col-lg-4">
                                        <div class="bg-soft-primary rounded-4 p-3 h-100">
                                            <h6 class="fw-bold text-primary mb-3 border-bottom pb-2"><i class="bi bi-code-slash me-2"></i>Solutions</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="/history" class="dropdown-item-adv"><i class="bi bi-clock-history me-2"></i>Our History</a></li>
                                                <li><a href="/goal" class="dropdown-item-adv"><i class="bi bi-bullseye me-2"></i>Our Goal</a></li>
                                                <li><a href="/audit" class="dropdown-item-adv"><i class="bi bi-clipboard-check me-2"></i>Audit</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Column 2 -->
                                    <div class="col-lg-4">
                                        <div class="bg-soft-success rounded-4 p-3 h-100">
                                            <h6 class="fw-bold text-success mb-3 border-bottom pb-2"><i class="bi bi-briefcase me-2"></i>Advisory</h6>
                                            <ul class="list-unstyled">
                                                <li><a href="/offering" class="dropdown-item-adv"><i class="bi bi-life-preserver me-2"></i>Offering</a></li>
                                                <li><a href="/case-study" class="dropdown-item-adv"><i class="bi bi-mortarboard me-2"></i>Case Study</a></li>
                                                <li><a href="/faqs" class="dropdown-item-adv"><i class="bi bi-question me-2"></i>Faq's</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('message-from-management')}}">Our Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cfcustomer/login">Portal</a>
                    </li>
                </ul>
            </div>

            <!-- Cart Icon -->
            <div class="d-none d-lg-flex align-items-center">
                <div id="cart-dropdown" class="dropdown">
                    <a href="#" class="text-decoration-none cart-icon-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart3 fs-3 action-cart" style="color: #6a11cb;"></i>
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0" id="cart-dropdown-menu" style="min-width: 350px;">
                        <li class="cart-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><i class="bi bi-cart3 me-2"></i> Your Shopping Cart</h6>
                                <span id="cart-summary" class="badge bg-light text-dark">0 items</span>
                            </div>
                        </li>
                        <li id="cart-empty" class="text-center py-5">
                            <i class="bi bi-cart-x empty-cart-icon"></i>
                            <p class="text-muted mb-2">Your cart feels lonely</p>
                            <a href="/products" class="btn btn-sm btn-outline-primary">Explore Products</a>
                        </li>
                        <div id="cart-items" class="d-none">
                            <div id="cart-items-container"></div>
                            <li class="cart-footer p-3">
                                <div class="d-flex justify-content-between mb-4">
                                    <strong>Subtotal:</strong>
                                    <strong id="cart-total">$0.00</strong>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="/add_to_cart" class="btn btn-primary">
                                        <i class="bi bi-cart-check me-2"></i> View Cart
                                    </a>
                                    <a href="/checkout" class="btn btn-success">
                                        <i class="bi bi-credit-card me-2"></i> Secure Checkout
                                    </a>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* Logo and brand positioning */
.navbar-custom .container.flex-column {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Mega dropdown - show on hover with delay */
.mega-dropdown > .dropdown-menu {
    display: block;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.3s ease 0.2s, visibility 0s linear 0.3s, transform 0.3s ease 0.2s;
    transform: translateY(10px);
}

.mega-dropdown:hover > .dropdown-menu {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0);
    transition-delay: 0s;
}

/* Add invisible padding below the Services link */
.mega-dropdown > a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 10px;
    background: transparent;
}

/* Mega menu styling */
.dropdown-menu.mega-menu {
    left: 0;
    right: 0;
    top: 95%;
    background: #fff;
    border-top: 4px solid #6a11cb;
    border-radius: 0 0 16px 16px;
    z-index: 999;
}

/* Animate columns in mega menu */
.mega-menu .col-lg-4 {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInStagger 0.5s ease forwards;
}

.mega-menu .col-lg-4:nth-child(1) {
    animation-delay: 0.1s;
}
.mega-menu .col-lg-4:nth-child(2) {
    animation-delay: 0.2s;
}

@keyframes fadeInStagger {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Link hover effect */
.dropdown-item-adv {
    position: relative;
    display: inline-block;
    padding: 8px 12px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #333;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    overflow: hidden;
}

.dropdown-item-adv::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 6px;
    width: 0%;
    height: 2px;
    background: #6a11cb;
    transition: width 0.3s ease;
}

.dropdown-item-adv:hover::after {
    width: 100%;
}

.dropdown-item-adv:hover {
    color: #6a11cb;
}

/* Cart dropdown positioning */
#cart-dropdown {
    position: relative;
    z-index: 1000; /* Higher than mega menu */
}

/* Responsive fixes */
@media (max-width: 991.98px) {
    .mega-dropdown > .dropdown-menu {
        position: static !important;
        display: none !important;
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
    }
    
    .mega-dropdown.show > .dropdown-menu {
        display: block !important;
    }
    
    .mega-menu .col-lg-4 {
        animation: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
    
    .navbar-collapse {
        text-align: center;
    }
    
    .navbar-nav {
        margin: 0 auto;
    }
    
    .d-none.d-lg-flex {
        display: none !important;
    }
}

/* Section colors */
.bg-soft-primary { background-color: #f3f6ff; }
.bg-soft-success { background-color: #e7f9f1; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make mega menu work properly on mobile
    const megaDropdown = document.querySelector('.mega-dropdown');
    const megaLink = megaDropdown.querySelector('a');
    
    megaLink.addEventListener('click', function(e) {
        if (window.innerWidth < 992) {
            e.preventDefault();
            megaDropdown.classList.toggle('show');
        }
    });
    
    // Close mega menu when clicking elsewhere
    document.addEventListener('click', function(e) {
        if (!megaDropdown.contains(e.target)) {
            megaDropdown.classList.remove('show');
        }
    });
    
    // Prevent cart from triggering mega menu hover
    const cartIcon = document.querySelector('.cart-icon-wrapper');
    
    cartIcon.addEventListener('mouseenter', function() {
        megaDropdown.classList.add('disable-hover');
    });
    
    cartIcon.addEventListener('mouseleave', function() {
        setTimeout(() => {
            megaDropdown.classList.remove('disable-hover');
        }, 300);
    });
});
</script>