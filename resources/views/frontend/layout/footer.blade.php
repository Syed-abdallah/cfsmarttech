<footer class="footer-section position-relative overflow-hidden">
    <!-- Floating Elements -->
    <div class="footer-floating-circle position-absolute"></div>
    <div class="footer-floating-square position-absolute"></div>

    <!-- Main Footer Content -->
    <div class="container py-5 position-relative">
        <div class="row g-4">
            <!-- Company Info with Animated Logo -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand d-flex align-items-center mb-4">
                    <div class="footer-logo-icon me-3">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h4 class="text-white mb-0">CF<span class="text-gradient">Smart Technologies</span></h4>
                </div>
                <p class="footer-description">Creating intelligent living spaces that adapt to your lifestyle
                    through innovative technology and thoughtful design.</p>

                <!-- Animated Social Icons -->
                {{-- <div class="footer-social mt-4">
                    <h6 class="text-uppercase fw-bold mb-3">Connect With Us</h6>
                    <div class="d-flex">
                        <a href="#" class="social-icon me-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon me-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" class="social-icon me-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-icon me-3" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="social-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div> --}}

                <div class="footer-social mt-4">
    <h6 class="text-uppercase fw-bold mb-3">Connect With Us</h6>
    <div class="d-flex">
        @if($settings->facebook_url)
        <a href="{{ $settings->facebook_url }}" class="social-icon me-3" target="_blank" rel="noopener noreferrer"
           data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
            <i class="bi bi-facebook"></i>
        </a>
        @endif

        @if($settings->twitter_url)
        <a href="{{ $settings->twitter_url }}" class="social-icon me-3" target="_blank" rel="noopener noreferrer"
           data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter">
            <i class="bi bi-twitter-x"></i>
        </a>
        @endif

        @if($settings->instagram_url)
        <a href="{{ $settings->instagram_url }}" class="social-icon me-3" target="_blank" rel="noopener noreferrer"
           data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram">
            <i class="bi bi-instagram"></i>
        </a>
        @endif

        @if($settings->indeed_url)
        <a href="{{ $settings->indeed_url }}" class="social-icon me-3" target="_blank" rel="noopener noreferrer"
           data-bs-toggle="tooltip" data-bs-placement="top" title="Indeed">
            <i class="bi bi-briefcase-fill"></i>
        </a>
        @endif

        @if($settings->youtube_url)
        <a href="{{ $settings->youtube_url }}" class="social-icon" target="_blank" rel="noopener noreferrer"
           data-bs-toggle="tooltip" data-bs-placement="top" title="YouTube">
            <i class="bi bi-youtube"></i>
        </a>
        @endif
    </div>
</div>
            </div>

            <!-- Quick Links with Hover Effect -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-heading text-uppercase fw-bold mb-4">Explore</h6>
                <ul class="footer-links list-unstyled">
                    <li class="mb-3">
                        <a href="{{url('/')}}" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Home Solutions</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{url('/products')}}" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Smart Devices</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{url('/message-from-management')}}" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Our Message</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{url('/cfcustomer/login')}}" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Login</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                
                </ul>
            </div>

            <!-- Support Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-heading text-uppercase fw-bold mb-4">Support</h6>
                <ul class="footer-links list-unstyled">
                 
                    <li class="mb-3">
                        <a href="{{url('/faqs')}}" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">FAQs</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                    {{-- <li class="mb-3">
                        <a href="https://wa.me/923000000000" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Live Chat</span>
                            <span class="link-hover"></span>
                        </a>
                    </li> --}}
                    @if($settings->phone_number)
<li class="mb-3">
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->phone_number) }}" 
       class="footer-link text-white text-decoration-none position-relative"
       target="_blank" 
       rel="noopener noreferrer"
       data-bs-toggle="tooltip" 
       data-bs-placement="top"
       title="Chat with us on WhatsApp">
        <span class="link-text">Live Chat</span>
        <span class="link-hover"></span>
        <i class="bi bi-whatsapp ms-2"></i> <!-- WhatsApp icon -->
    </a>
</li>
@endif
                    <li class="mb-3">
                        <a href="/login" class="footer-link text-white text-decoration-none position-relative">
                            <span class="link-text">Admin Login</span>
                            <span class="link-hover"></span>
                        </a>
                    </li>
                 
                </ul>
            </div>

            <!-- Newsletter with Floating Label -->
            <div class="col-lg-4 col-md-6 mb-4">
        

                <!-- App Download Buttons -->
                {{-- <div class="footer-apps mt-4">
                    <h6 class="text-uppercase fw-bold mb-3">Get Our App</h6>
                    <div class="d-flex flex-wrap">
                        <a href="#" class="app-btn me-2 mb-2">
                            <i class="bi bi-apple"></i> App Store
                        </a>
                        <a href="#" class="app-btn  me-2 mb-2">
                            <i class="bi bi-google-play"></i> Play Store
                        </a>
                    </div>
                </div> --}}
                @if($settings->app_store_url || $settings->play_store_url)
<div class="footer-apps mt-4">
    <h6 class="text-uppercase fw-bold mb-3">Get Our App</h6>
    <div class="d-flex flex-wrap">
        @if($settings->app_store_url)
        <a href="{{ $settings->app_store_url }}" class="app-btn me-2 mb-2" target="_blank" rel="noopener noreferrer">
            <i class="bi bi-apple"></i> App Store
        </a>
        @endif
        
        @if($settings->play_store_url)
        <a href="{{ $settings->play_store_url }}" class="app-btn me-2 mb-2" target="_blank" rel="noopener noreferrer">
            <i class="bi bi-google-play"></i> Play Store
        </a>
        @endif
    </div>
</div>
@endif
            </div>
        </div>

        <!-- Divider with Animated Border -->
        <div class="footer-divider my-4 position-relative">
            <div class="divider-line"></div>
        </div>

        <!-- Copyright with Floating Back to Top Button -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0 text-white-50">&copy; 2025 CF Smart Technologies. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                {{-- <div class="footer-legal-links d-inline-block">
                    <a href="#" class="text-white-50 me-3 text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-white-50 me-3 text-decoration-none">Terms of Service</a>
                    <a href="#" class="text-white-50 text-decoration-none">Cookies</a>
                </div> --}}
                <a href="#" class="back-to-top btn btn-sm btn-outline-light ms-md-3 mt-2 mt-md-0">
                    <i class="bi bi-arrow-up"></i> Back to Top
                </a>
            </div>
        </div>
    </div>
    {{-- <a href="https://wa.me/923000000000" target="_blank" class="position-fixed bottom-0 end-1 m-4 whatsapp-float"
        style="width:100px; height:100px;">
        <img src="{{ asset('frontend/images/whatsapp.png') }}" alt="WhatsApp" class="img-fluid">
        <div class="whatsapp-popup">Chat with us!</div>
    </a> --}}


    @if($settings->phone_number)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->phone_number) }}" 
   target="_blank" 
   class="position-fixed bottom-0 end-1 m-4 whatsapp-float"
   style="width: 100px; height: 100px; z-index: 100;">
    <img src="{{ asset('frontend/images/whatsapp.png') }}" alt="WhatsApp" class="img-fluid">
    <div class="whatsapp-popup">
        Chat with us!<br>
        <small>{{ $settings->phone_number }}</small>
    </div>
</a>
@endif
    <!-- delayed small card -->
    {{-- <div id="small-card" class="small-card position-fixed bottom-0 start-1 m-4 card-float">
        <div class="card p-3 position-relative">
            <!-- close button -->
            <button type="button" class="btn-close small-card-close position-absolute top-0 end-0 m-4 text-dark"
                aria-label="Close"></button>

            <p class="card-text mb-0 mt-5">
                If you want to calculate how much your cost will be, click the button below.
            </p>


            <a href="/calculator" class="button"
                style="display: inline-flex; align-items: center; text-decoration: none;">
                Calculate it
                <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                        clip-rule="evenodd" />
                </svg>
            </a>


            <style>
                .button {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5rem;
                    padding: 0.75rem 1.5rem;
                    font-size: 1rem;
                    font-weight: 600;
                    color: white;
                    background: linear-gradient(135deg, #3b82f6, #6366f1);
                    border: none;
                    border-radius: 0.5rem;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    position: relative;
                    overflow: hidden;
                    margin-top: 20px;
                }

                .button:hover {
                    background: linear-gradient(135deg, #2563eb, #4f46e5);
                    transform: translateY(-1px);
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }

                .button:active {
                    transform: translateY(0);
                    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
                }

                .button::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                    transition: 0.5s;
                }

                .button:hover::before {
                    left: 100%;
                }

                .icon {
                    width: 1.25rem;
                    height: 1.25rem;
                    transition: transform 0.3s ease;
                }

                .button:hover .icon {
                    transform: translateX(3px);
                }
            </style>


        </div>
    </div> --}}
  

 
</footer>
