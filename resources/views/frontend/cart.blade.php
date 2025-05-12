@extends('frontend.layout.layout')
@section('content')
    <div class="container py-5 checkout-container" style="margin-top: 150px;">
        <div class="row">
            <!-- Left Column - Cart Summary -->
            <div class="col-lg-8">
                <!-- Login Prompt (shown when user is not logged in) -->
                <div id="login-prompt" class="login-prompt mb-4">
                    <i class="bi bi-lock-fill login-icon"></i>
                    <h4 class="mb-3">Login to Complete Your Purchase</h4>
                    <p class="text-muted mb-4">Please login or create an account to proceed with your order and enjoy a
                        seamless shopping experience</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/login" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                        <a href="/cfcustomer/register" class="btn btn-outline-primary px-4 rounded-pill">
                            <i class="bi bi-person-plus me-2"></i> Create Account
                        </a>
                    </div>
                </div>

                <!-- Address Section (shown when user is logged in) -->
                <div id="address-section" class="d-none">
                    <h4 class="mb-4"><i class="bi bi-truck me-2"></i> Shipping Address</h4>

                    <div class="highlight-box mb-4">
                        <i class="bi bi-info-circle-fill me-2"></i> Please verify your shipping address to ensure
                        accurate delivery
                    </div>

                    <!-- Address Cards -->
                    <div id="address-cards" class="row mb-4">
                        <!-- Address cards will be dynamically inserted here -->
                    </div>

                    <!-- Add New Address Button -->
                    <button id="add-address-btn" class="btn btn-outline-primary mb-4">
                        <i class="bi bi-plus-circle me-2"></i> Add New Address
                    </button>

                    <!-- New Address Form (hidden by default) -->
                    {{-- <div id="new-address-form" class="d-none">
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><i class="bi bi-house-add me-2"></i> Add New Address</h5>
                            <form id="address-form">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="full-name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full-name"
                                            placeholder="John Doe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone"
                                            placeholder="+1 234 567 8900" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address-line1" class="form-label">Address Line 1</label>
                                    <input type="text" class="form-control" id="address-line1"
                                        placeholder="123 Main Street" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address-line2" class="form-label">Address Line 2 (Optional)</label>
                                    <input type="text" class="form-control" id="address-line2"
                                        placeholder="Apartment, suite, unit, etc.">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="New York"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="state" class="form-label">State/Province</label>
                                        <input type="text" class="form-control" id="state" placeholder="NY"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zip" class="form-label">ZIP/Postal Code</label>
                                        <input type="text" class="form-control" id="zip" placeholder="10001"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" required>
                                        <option value="">Select Country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="PK">Pakistan</option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="default-address">
                                    <label class="form-check-label" for="default-address">
                                        Set as default shipping address
                                    </label>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" id="cancel-address-btn"
                                        class="btn btn-outline-secondary rounded-pill px-4">
                                        <i class="bi bi-x-circle me-2"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-check-circle me-2"></i> Save Address
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
                    <!-- New Address Form (hidden by default) -->
                    <div id="new-address-form" class="d-none">
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4"><i class="bi bi-house-add me-2"></i> Add New Address</h5>
                                <form action="{{ route('customer.addresses.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="full-name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="full-name"
                                                placeholder="John Doe" value="{{ old('full_name') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" name="phone" id="phone"
                                                placeholder="+1 234 567 8900" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address-line1" class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" name="address_line1" id="address-line1"
                                            placeholder="123 Main Street" value="{{ old('address_line1') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address-line2" class="form-label">Address Line 2 (Optional)</label>
                                        <input type="text" class="form-control" name="address_line2" id="address-line2"
                                            placeholder="Apartment, suite, unit, etc." value="{{ old('address_line2') }}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" id="city"
                                                placeholder="New York" value="{{ old('city') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State/Province</label>
                                            <input type="text" class="form-control" name="state" id="state"
                                                placeholder="NY" value="{{ old('state') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="zip" class="form-label">ZIP/Postal Code</label>
                                            <input type="text" class="form-control" name="zip" id="zip"
                                                placeholder="10001" value="{{ old('zip') }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-select" name="country" id="country" required>
                                            <option value="">Select Country</option>
                                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United
                                                States</option>
                                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada
                                            </option>
                                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United
                                                Kingdom</option>
                                            <option value="PK" {{ old('country') == 'PK' ? 'selected' : '' }}>Pakistan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" name="is_default"
                                            id="default-address" {{ old('is_default') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="default-address">
                                            Set as default shipping address
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" id="cancel-address-btn"
                                            class="btn btn-outline-secondary rounded-pill px-4">
                                            <i class="bi bi-x-circle me-2"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="bi bi-check-circle me-2"></i> Save Address
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>






                    <!-- Payment Method Section -->
                    <div id="payment-section" class="payment-method">
                        <h4 class="mb-4"><i class="bi bi-credit-card me-2"></i> Payment Method</h4>

                        <div class="payment-option selected" id="cod-option">
                            <div class="payment-icon">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Cash on Delivery</h6>
                                <p class="small text-muted mb-0">Pay when you receive your order</p>
                            </div>
                            <div class="ms-auto">
                                <input class="form-check-input" type="radio" name="payment-method" id="cod"
                                    value="cod" checked>
                            </div>
                        </div>

                        <div class="payment-option" id="paypal-option">
                            <div class="payment-icon">
                                <i class="bi bi-paypal"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">PayPal / Credit Card</h6>
                                <p class="small text-muted mb-0">Secure online payment</p>
                            </div>
                            <div class="ms-auto">
                                <input class="form-check-input" type="radio" name="payment-method" id="paypal"
                                    value="paypal">
                            </div>
                        </div>

                        <!-- PayPal Form (hidden by default) -->
                        <div id="paypal-form" class="paypal-form">
                            <div class="mb-3">
                                <label for="paypal-email" class="form-label">PayPal Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="paypal-email"
                                        placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="card-number" class="form-label">Card Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                                    <input type="text" class="form-control" id="card-number"
                                        placeholder="1234 5678 9012 3456">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expiry-date" class="form-label">Expiry Date</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="text" class="form-control" id="expiry-date" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="text" class="form-control" id="cvv" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button id="place-order-btn" class="btn btn-primary w-100 mt-3 py-3 rounded-pill">
                            <i class="bi bi-shield-lock me-2"></i> Place Order Securely
                        </button>

                        <div class="text-center mt-3">
                            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg"
                                alt="PayPal Credit" class="me-2" height="23">
                            <img src="https://www.vectorlogo.zone/logos/visa/visa-icon.svg" alt="Visa" class="me-2"
                                height="20">
                            <img src="https://www.vectorlogo.zone/logos/mastercard/mastercard-icon.svg" alt="Mastercard"
                                class="me-2" height="20">
                            <img src="https://www.vectorlogo.zone/logos/americanexpress/americanexpress-icon.svg"
                                alt="American Express" height="20">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="col-lg-4">
                <div class="cart-summary sticky-top" style="top: 100px;">
                    <h4 class="order-summary-title mb-4"><i class="bi bi-receipt me-2"></i> Order Summary</h4>

                    <!-- Cart Items -->
                    <div id="checkout-items">
                        <!-- Cart items will be dynamically inserted here -->
                    </div>

                    <hr>

                    <!-- Order Totals -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="checkout-subtotal">$0.00</span>
                    </div>
                    {{-- <div class="d-flex justify-content-between mb-2">
                    <span>Shipping:</span>
                  <span id="shipping-cost" class="delivery-charge">Select address</span> 
                </div> --}}
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span id="shipping-cos" class="delivery-charge">
                            @if ($shipping)
                                Rs{{ $shippingCost }}
                            @else
                                No default address selected
                            @endif
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax:</span>
                        <span id="tax-amount">$0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between total-price mb-3">
                        <span>Total:</span>
                        <span id="checkout-total">$0.00</span>
                    </div>

                    <div class="alert alert-success small mt-5">
                        🚚 Fast and reliable delivery on all orders.
                    </div>

                    <div class="alert alert-info small">
                        📞 Need help? Contact our support anytime!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
