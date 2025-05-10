


@extends('frontend.layout.layout')
@section('content')

<style>
      /* PRODUCT CAROUSEL */
      .product-carousel {
      display: flex;
      overflow: hidden;
      height: 170px;
      justify-content: space-between;
      /* Space out the cards */
    }

    .product-card {
      flex: 1;
      position: relative;
      text-align: center;
      padding: 1rem;
      transition: flex 0.6s ease, background-color 0.6s ease;
      cursor: pointer;
      min-width: 200px;
      /* Minimum width to handle small screens */
      margin: 0 5px;
      /* Add a small gap between the cards */
      opacity: 1;
      /* Default opacity for desktop */
      display: block;
      /* Ensure all cards are visible on larger screens */
    }

    .product-card:not(.active):hover {
      background-color: #f8f9fa;
    }

    .product-card.active {
      flex: 3;
      background-color: rgba(255, 235, 59, 0.1);
    }

    .product-card .icon img {
      width: 40px;
      height: 40px;
      object-fit: contain;
    }

    .product-card .title {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      margin-top: 0.5rem;
      font-weight: 500;
    }

    .product-card .title i {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
    }

    .product-card .extra,
    .product-card .extrahide {
      opacity: 0;
      transition: opacity 0.5s ease 0.3s;
      margin-top: 1rem;
    }

    .product-card.active .extra,
    .product-card.active .extrahide {
      opacity: 1;
    }

    .product-card .indicator {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: #eeff00;
      transform-origin: left center;
      opacity: 0;
    }

    .product-card.active .indicator {
      animation: slideAndHide 6s linear infinite;
      animation-delay: 0.6s;
    }

    @keyframes slideAndHide {
      0% {
        transform: scaleX(0);
        opacity: 1;
      }

      80% {
        transform: scaleX(1);
        opacity: 1;
      }

      80.01% {
        transform: scaleX(1);
        opacity: 0;
      }

      100% {
        transform: scaleX(1);
        opacity: 0;
      }
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {

      /* Adjust hero panel for mobile */
      .hero-text {
        font-size: 1.5rem;
      }

      /* Display only the active card on mobile */
      .product-carousel {
        /* display: flex; */
        overflow: hidden;
        /* padding: 0 1rem; */
      }

      .product-card {
        display: none;
        /* Hide all cards by default */
      }

      .product-card.active {
        display: block;
        /* Show only the active card */
      }

      .product-card.active {
        background-color: rgba(255, 235, 59, 0.1);
        flex: none;
        min-width: 100%;
        /* Make the active card full width on mobile */
      }

      .product-card .indicator {
        height: 3px;
        /* Smaller indicator height */
      }

      /* Modify icon size on smaller screens */
      .product-card .icon img {
        width: 35px;
        height: 35px;
      }
    }

    @media (max-width: 480px) {

      /* Further adjustments for very small screens */
      .hero-text {
        font-size: 1.25rem;
      }

      .product-card .title {
        font-size: 0.9rem;
        /* Smaller font for mobile */
      }

      .product-card .extra,
      .product-card .extrahide {
        font-size: 0.9rem;
        /* Smaller text for extra description */
      }
    }
</style>
    <!-- Carousel -->
    <div id="carouselExampleRide" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500"
        data-bs-wrap="true">
        <!-- Dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('frontend/images/smart5.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Welcome to the Future of Living</h1>
                    <p>Control your entire home with just one tap - lights, security, temperature and more</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/images/smart7.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Voice-Activated Comfort</h1>
                    <p>"Hey Google, good morning!" - Start your day with automated routines</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('frontend/images/smart1.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Intelligent Security 24/7</h1>
                    <p>Smart cameras, motion sensors and automated locks keep your home safe</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Content -->
    <div class="container-fluid py-5 position-relative">
        <div class="row">
            <div class="col-lg-2 d-flex align-items-center justify-content-center">
                <h5 class="text-center mb-4">Trusted by<br>renowned brands</h5>
            </div>
            <div class="col-lg-10">
                <div class="logo-carousel">
                    <div class="logo-track">
                        <img src="" alt="Logo 1">
                        <img src="{{ asset('frontend/images/p1.png') }}" alt="Logo 2">
                        <img src="{{ asset('frontend/images/p2.png') }}" alt="Logo 3">
                        <img src="{{ asset('frontend/images/p3.png') }}" alt="Logo 4">
                        <img src="{{ asset('frontend/images/p4.png') }}" alt="Logo 5">
                        <img src="{{ asset('frontend/images/p5.png') }}" alt="Logo 6">
                        <!-- duplicates for seamless loop -->
                        <img src="{{ asset('frontend/images/p6.png') }}" alt="Logo 1">
                        <img src="{{ asset('frontend/images/p7.png') }}" alt="Logo 2">
                        <img src="{{ asset('frontend/images/p2.png') }}" alt="Logo 3">
                        <img src="{{ asset('frontend/images/p6.png') }}" alt="Logo 4">
                        <img src="{{ asset('frontend/images/p2.png') }}" alt="Logo 5">
                        <img src="{{ asset('frontend/images/p4.png') }}" alt="Logo 6">
                    </div>
                </div>
            </div>
        </div>
    </div>






    <section id="products" style="margin-botton: 150px;">
        <div class="container-fluid">
          <!-- HERO PANEL -->
          <div id="hero" class="hero-image">
            <img id="hero-img" src="https://via.placeholder.com/800x300?text=Smart+Dimmer" alt="Featured product" width="100%" height="600px">
            {{-- <div id="hero-text" class="hero-text">Smart Dimmer</div> --}}
          </div>
  
          <!-- PRODUCT CAROUSEL -->
          <div class="product-carousel">
            <!-- Card 1 -->
            <div class="product-card" data-index="0" data-hero-img="{{asset('frontend/images/product1.png')}}" data-hero-text="MHub" >
              {{-- <div class="icon">
                <img src="https://via.placeholder.com/40?text=MH" alt="MHub">
              </div> --}}
              <div class="title">MHub <i class="bi bi-arrow-right-circle fs-3 extrahide"></i></div>
              <div class="extra">
                <p class="mb-2">Central brain of your smart home, connecting all devices seamlessly.</p>
              </div>
              <div class="indicator"></div>
            </div>
  
            <!-- Card 2 -->
            <div class="product-card" data-index="1" data-hero-img="{{asset('frontend/images/product2.jpeg')}}" data-hero-text="Touch Panel">
              {{-- <div class="icon">
                <img src="https://via.placeholder.com/40?text=TP" alt="Touch Panel">
              </div> --}}
              <div class="title">Touch Panel <i class="bi bi-arrow-right-circle fs-3 extrahide"></i></div>
              <div class="extra">
                <p class="mb-2">Sleek in-wall interface for lights, blinds and scenes with haptic feedback.</p>
              </div>
              <div class="indicator"></div>
            </div>
  
            <!-- Card 3 -->
            <div class="product-card" data-index="2" data-hero-img="{{asset('frontend/images/product3.jpeg')}}"
              data-hero-text="Motion & Light Sensor">
              {{-- <div class="icon">
                <img src="https://via.placeholder.com/40?text=ML" alt="Motion & Light Sensor">
              </div> --}}
              <div class="title">Motion & Light Sensor <i class="bi bi-arrow-right-circle fs-3 extrahide"></i></div>
              <div class="extra">
                <p class="mb-2">Automate lighting based on occupancy and ambient daylight level.</p>
              </div>
              <div class="indicator"></div>
            </div>
  
            <!-- Card 4 (active by default) -->
            <div class="product-card active" data-index="3" data-hero-img="{{asset('frontend/images/product4.png')}}"
              data-hero-text="Smart Dimmer">
              {{-- <div class="icon">
                <img src="https://via.placeholder.com/40?text=SD" alt="Smart Dimmer">
              </div> --}}
              <div class="title">Smart Dimmer <i class="bi bi-arrow-right-circle fs-3 extrahide"></i></div>
              <div class="extra">
                <p class="mb-2">Create the perfect ambiance. Adjust lighting or fan speed to match your mood.</p>
              </div>
              <div class="indicator"></div>
            </div>
  
            <!-- Card 5 -->
            <div class="product-card" data-index="4" data-hero-img="{{asset('frontend/images/product5.png')}}" data-hero-text="Power Panel">
              {{-- <div class="icon">
                <img src="https://via.placeholder.com/40?text=PP" alt="Power Panel">
              </div> --}}
              <div class="title">Power Panel <i class="bi bi-arrow-right-circle fs-3 extrahide"></i></div>
              <div class="extra">
                <p class="mb-2">High-capacity power distribution with smart metering and overload protection.</p>
              </div>
              <div class="indicator"></div>
            </div>
  
         <!-- Card 6 -->
<a href="/products" class="product-card-link">
    <div class="product-car" data-index="5" data-hero-img="https://via.placeholder.com/800x300?text=All+Products"
      data-hero-text="All Products">
      <div class="icon" style="margin-top: 40px;">
        <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/icons/arrow-right.svg" alt="View All">
      </div>
      <div class="title">View All Products</div>
      <div class="indicator"></div>
    </div>
  </a>
          </div>
        </div>
      </section>

    

    <div class="video-section mt-2">
        <video autoplay muted loop playsinline>
            <source src="frontend/images/video3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="video-container container-fluid">

        </div>
    </div>











    
    



    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="row g-4 align-items-stretch">

                <div class="col-12 col-md-6 h-100">
                    <div class="card border-0 shadow-lg p-4 h-100">
                        <div class="position-relative" style="z-index:1">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="bi bi-house-heart-fill fs-2 text-warning"></i>


                                </div>
                                <h6 class="mb-0 text-primary fw-bold">LUXURY LIVING</h6>
                            </div>
                            <h3 class="fw-bold mb-4">Aesthetics and functionality – finally in harmony!</h3>
                            <p class="text-muted mb-4">
                                Remove the clutter from your walls and replace those bulky switches
                                with our sleek and modern touch panels.
                            </p>
                            <ul class="list-unstyled mb-4">

                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i> Premium
                                    materials and
                                    finishes</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>
                                    Designer-grade wall
                                    panels</li>
                            </ul>
                            <div class="mt-auto"> <!-- Added mt-auto to push button to bottom -->
                                <a href="#" class="btn btn-outline-primary px-4">Explore Designs</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right panel - Energy Saving -->
                <div class="col-12 col-md-6 h-100">
                    <div class="card border-0 shadow-lg p-4 h-100 position-relative overflow-hidden">
                        <!-- Blurred Background -->
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                            style="
                        background-image: url('frontend/images/circuit.gif');
                        background-size: cover;
                        filter: blur(2px);
                        z-index: 0;
                      ">
                        </div>

                        <!-- Content with relative positioning -->
                        <div class="position-relative z-1 h-100 d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="bi bi-lightning-charge-fill fs-2 text-success"></i>
                                </div>
                                <h6 class="mb-0 text-success fw-bold">ENERGY EFFICIENCY</h6>
                            </div>
                            <h3 class="fw-bold text-success mb-4">
                                Save energy, money and the environment - all at the same time.
                            </h3>
                            <p class="text-muted mb-4">
                                Our smart systems automatically optimize energy usage throughout your home, reducing
                                waste without
                                sacrificing comfort.
                            </p>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success bg-opacity-10 rounded p-2 me-2">
                                            <i class="bi bi-thermometer-sun text-success"></i>
                                        </div>
                                        <span class="small">Up to 30% savings on HVAC</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success bg-opacity-10 rounded p-2 me-2">
                                            <i class="bi bi-lightbulb text-success"></i>
                                        </div>
                                        <span class="small">45% lighting efficiency</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-success px-4">Calculate Your Savings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="parallax-section" style="background-image: url('frontend/images/smart2.webp');">
            <div class="parallax-overlay"></div>
            <div class="parallax-content">
                <h2 class="display-4 fw-bold mb-4">Transform Your Living Space</h2>
                <p class="lead mb-5">Experience the perfect blend of technology and comfort with our smart home
                    solutions</p>
                <a href="#" class="btn btn-primary btn-lg px-4 py-2">Get Started Today</a>
            </div>
        </div>











        <section id="services">
            <div class="container ">
                <div class="row align-items-center text-center text-md-start">
                    <!-- Left Features -->
                    <div class="col-md-4">
                        <div class="feature" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h5>Use On Any Device</h5>
                            <p>Access your tools anytime, anywhere — whether you're on a phone, tablet, or desktop. Our
                                platform is
                                fully responsive, so you can stay connected and productive no matter what device you
                                use.</p>

                        </div>
                        <div class="feature" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-pen"></i>
                            </div>
                            <h5>Feather Icons</h5>
                            <p>Clean, minimal, and beautifully designed — Feather Icons bring a modern touch to your
                                interface, making
                                it sleek and user-friendly without the clutter.</p>

                        </div>
                        <div class="feature" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h5>Retina Ready</h5>
                            <p>Every detail looks sharp and vibrant on high-resolution screens. Our design is optimized
                                for Retina
                                displays, ensuring your visuals are always crisp and crystal clear.</p>

                        </div>
                    </div>

                    <!-- Mobile App Image -->
                    <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0" data-aos="fade-up"
                        data-aos-delay="100">
                        <img src="{{ asset('frontend/images/mobile.jpg') }}" alt="App Mockup"
                            class="img-fluid phone-img">
                    </div>

                    <!-- Right Features -->
                    {{-- <div class="col-md-4">
                        <div class="feature" data-aos="fade-right" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-code-slash"></i>
                            </div>
                            <h5>W3C Valid Code</h5>
                            <p>Built with clean, compliant HTML and CSS that meets W3C standards — ensuring better
                                performance,
                                accessibility, and compatibility across all modern browsers.</p>

                        </div>
                        <div class="feature" data-aos="fade-left" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-phone"></i>
                            </div>
                            <h5>Fully Responsive</h5>
                            <p>Looks great on every screen size — from smartphones to desktops. Our layout adapts
                                seamlessly, giving
                                users a smooth and consistent experience everywhere.</p>

                        </div>
                        <div class="feature" data-aos="fade-left" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-browser-chrome"></i>
                            </div>
                            <h5>Browser Compatibility</h5>
                            <p>Tested across all major browsers to ensure your site runs smoothly and looks perfect—no
                                matter what
                                your visitors are using.</p>

                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="feature" data-aos="fade-down" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h5>Use On Any Device</h5>
                            <p>Access your tools anytime, anywhere — whether you're on a phone, tablet, or desktop. Our
                                platform is
                                fully responsive, so you can stay connected and productive no matter what device you
                                use.</p>

                        </div>
                        <div class="feature" data-aos="fade-down" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-pen"></i>
                            </div>
                            <h5>Feather Icons</h5>
                            <p>Clean, minimal, and beautifully designed — Feather Icons bring a modern touch to your
                                interface, making
                                it sleek and user-friendly without the clutter.</p>

                        </div>
                        <div class="feature" data-aos="fade-down" data-aos-delay="100">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h5>Retina Ready</h5>
                            <p>Every detail looks sharp and vibrant on high-resolution screens. Our design is optimized
                                for Retina
                                displays, ensuring your visuals are always crisp and crystal clear.</p>

                        </div>
                    </div>
                </div>
            </div>


        </section>




        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                        <i class="bi bi-shield-lock-fill fs-2 text-info"></i>
                    </div>
                    <h4 class="fw-bold">Smart Security</h4>
                    <p class="text-muted">24/7 monitoring with intelligent alerts and automated responses when you're
                        away.</p>
                    <a href="#" class="btn btn-link text-info ps-0">Learn more →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <!-- <div class="bg-purple bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                            <i class="bi bi-robot fs-2 text-purple"></i>
                        </div> -->
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                        <i class="bi bi-shield-lock-fill fs-2 text-info"></i>
                    </div>
                    <h4 class="fw-bold">Voice Control</h4>
                    <p class="text-muted">Natural voice commands with Alexa, Google Assistant and Siri integration.</p>
                    <a href="#" class="btn btn-link text-purple ps-0">See compatibility →</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 mb-3" style="width: fit-content;">
                        <i class="bi bi-phone-fill fs-2 text-danger"></i>
                    </div>
                    <h4 class="fw-bold">Remote Access</h4>
                    <p class="text-muted">Control and monitor your home from anywhere with our secure mobile app.</p>
                    <a href="#" class="btn btn-link text-danger ps-0">Download app →</a>
                </div>
            </div>
        </div>
    </div>










    
    <section id="as" >

        <div class="bg-light">
            <div class="container-fluid" style="background-color: #dbe2e0;padding:60px;">


                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold" data-aos="fade-up" data-aos-delay="100">
                                A <span class="text-primary">smart</span> home for a <span
                                    class="text-primary">smart</span> you
                            </h1>
                            <p class="lead text-secondary mt-3" data-aos="fade-up" data-aos-delay="250">
                                where your ease of life is priority number one!
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <img src="{{ asset('frontend/images/automation.gif') }}" alt=""
                                        srcset="" height="290px" data-aos="fade-left" data-aos-delay="500">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>



    <section id="plans">

        <div class="bg-light">
            <div class="container py-5">
                <div class="row text-center mb-5">
                    <div class="col">
                        <h2 class="display-4 fw-bold" data-aos="fade-up" data-aos-delay="100">Choose Your Plan</h2>
                        <p class="text-muted" data-aos="fade-up" data-aos-delay="100">Select the perfect plan for your
                            needs</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Basic Plan -->
                    <div class="col" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 pricing-card shadow-sm">
                            <div class="card-body p-5">
                                <h5 class="card-title text-muted text-uppercase mb-4">Starter</h5>
                                <h1 class="display-5 mb-4">$19<small class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled feature-list">
                                    <li><i class="bi bi-check2 text-primary me-2"></i>5 Projects</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>10GB Storage</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>Basic Support</li>
                                </ul>
                                <button class="btn btn-outline-primary btn-lg w-100 " style="margin-top: 60px;">Get
                                    Started</button>
                            </div>
                        </div>
                    </div>

                    <!-- Pro Plan -->
                    <div class="col" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 pricing-card shadow position-relative">
                            <span class="badge gradient-custom text-white popular-badge px-4 py-2">Popular</span>
                            <div class="card-body p-5">
                                <h5 class="card-title text-primary text-uppercase mb-4">Professional</h5>
                                <h1 class="display-5 mb-4">$49<small class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled feature-list">
                                    <li><i class="bi bi-check2 text-primary me-2"></i>15 Projects</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>50GB Storage</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>Priority Support</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>Advanced Features</li>
                                </ul>
                                <!-- <button class="btn btn-outline-primary btn-lg w-100 mt-4">Get Started</button> -->

                                <button class="btn btn-outline-primary btn-lg w-100 mt-2">Get Started</button>
                            </div>
                        </div>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="col" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 pricing-card shadow-sm">
                            <div class="card-body p-5">
                                <h5 class="card-title text-muted text-uppercase mb-4">Enterprise</h5>
                                <h1 class="display-5 mb-4">$99<small class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled feature-list">
                                    <li><i class="bi bi-check2 text-primary me-2"></i>Unlimited Projects</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>1TB Storage</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>24/7 Support</li>
                                    <li><i class="bi bi-check2 text-primary me-2"></i>Custom Features</li>
                                </ul>
                                <button class="btn btn-outline-primary btn-lg w-100 mt-4">Get Started</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
