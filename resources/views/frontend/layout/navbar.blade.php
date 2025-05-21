
<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            @if($settings->logo_path)
            <img src="{{ $settings->logo_path }}" alt="" srcset="" width="60px"
            height="60px">
            @endif
        </a>
            {{-- <a class="navbar-brand" href="#"><span>CF Smart Technologies</span></a> --}}
            
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
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li> --}}
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
