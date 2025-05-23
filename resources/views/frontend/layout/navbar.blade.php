
<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            @if($settings->logo_path)
            <img src="{{ $settings->logo_path }}" alt="" srcset="" width="60px"
            height="60px">
            @endif
        </a>
            
            <a class="navbar-brand d-none d-sm-inline-block" href="#">
            <span style="color: {{ $settings->name_color }};">
          {{ $settings->website_name }}</span>
          </a>
  
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link " href="/">Home</a>
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
                            <li><a href="/offering" class="dropdown-item-adv"><i class="bi bi-handshake me-2"></i>Offering</a></li>
                            <li><a href="/case-study" class="dropdown-item-adv"><i class="bi bi-mortarboard me-2"></i>Case Study</a></li>
                            <li><a href="#" class="dropdown-item-adv"><i class="bi bi-life-preserver me-2"></i>Support</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3 -->
                <div class="col-lg-4">
                    <div class="bg-soft-danger rounded-4 p-3 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold text-danger mb-3 border-bottom pb-2"><i class="bi bi-star-fill me-2"></i>Special Offer</h6>
                            <p class="small text-dark mb-2">🎉 Save 20% on your first project.</p>
                        </div>
                        <a href="/promo" class="btn btn-gradient btn-sm mt-auto w-100 text-center">Claim Now</a>
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
            <div class="d-none d-lg-block ms-3">
                <a href="/calculator" class="btn btn-dark rounded-pill px-4">
                    Calculator
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Enhanced Cart Dropdown -->
            <div id="cart-dropdown" class="dropdown ms-3">
                <a href="#" class="text-decoration-none cart-icon-wrapper" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-cart3 fs-3  action-cart" style="color: #6a11cb;"></i>
                    <span id="cart-count"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">0</span>
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
</nav> 
<style>
/* Mega dropdown - show on hover */
.mega-dropdown:hover > .dropdown-menu {
    display: block;
    animation: megaFadeIn 0.4s ease forwards;
}

@keyframes megaFadeIn {
    0% {
        opacity: 0;
        transform: translateY(15px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animate columns in mega menu (staggered fade) */
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
.mega-menu .col-lg-4:nth-child(3) {
    animation-delay: 0.3s;
}

@keyframes fadeInStagger {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mega menu styling */
.dropdown-menu.mega-menu {
    left: 0;
    right: 0;
    top:70%;
    background: #fff;
    border-top: 4px solid #6a11cb;
    border-radius: 0 0 16px 16px;
    z-index: 999;
}

/* Link hover effect - underline slide in */
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

/* Gradient CTA button */
.btn-gradient {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: white !important;
    font-weight: 600;
    border-radius: 25px;
    padding: 8px 16px;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(to right, #2575fc, #6a11cb);
}

/* Section colors */
.bg-soft-primary { background-color: #f3f6ff; }
.bg-soft-success { background-color: #e7f9f1; }
.bg-soft-danger  { background-color: #fff0f0; }

/* Responsive fix */
@media (max-width: 991.98px) {
    .mega-dropdown > .dropdown-menu {
        position: static !important;
    }
    .mega-menu .col-lg-4 {
        opacity: 1 !important;
        transform: none !important;
        animation: none !important;
    }
}


</style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const megaLink = document.querySelector('.mega-dropdown > a');
        megaLink.addEventListener('click', function (e) {
            if (window.innerWidth >= 992) e.preventDefault();
        });
    });
</script>
