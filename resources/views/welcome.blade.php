@extends('frontend.layout.layout')
@section('content')
    <style>
        /* PRODUCT CAROUSEL */
        .product-carousel {
            display: flex;
            overflow: hidden;
            height: 160px;
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
            margin: 0 0;
            /* Add a small gap between the cards */
            opacity: 23px;
            /* Default opacity for desktop */
            display: block;
            /* Ensure all cards are visible on larger screens */

                /* Add blur + transparency */
    background-color: rgba(255, 255, 255, 0.2); /* Light translucent background */
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px); /* For Safari */
        }

        .product-card:not(.active):hover {
            background-color: #f8f9fa;
            
        }

      .product-card.active {
    flex: 3;
    background-color: rgba(255, 235, 59, 0.1);
    backdrop-filter: blur(7px); /* <-- NEW line for blur effect */
    -webkit-backdrop-filter: blur(7px); /* Safari support */
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
            transition: opacity 2s ease 0.3s;
            margin-top: 1rem;
        }

        .product-card.active .extra,
        .product-card.active .extrahide {
            opacity: 4;
        }

        .product-card .indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #eeff06;
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
 

    <div id="carouselExampleRide" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500"
        data-bs-wrap="true">
        <!-- Dots -->
        <div class="carousel-indicators">
            @foreach ($slides as $key => $slide)
                <button type="button" data-bs-target="#carouselExampleRide" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $key + 1 }}"></button>
            @endforeach
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            @foreach ($slides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('Uploads/sliders/' . $slide->image) }}" class="d-block w-100"
                        alt="{{ $slide->heading }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>{{ $slide->heading }}</h1>
                        <p>{{ $slide->paragraph }}</p>
                    </div>
                </div>
            @endforeach
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





<h5 style="
    text-transform: uppercase;
    font-weight: 1000;
    margin: 3rem 0 10px 40px;
    position: relative;
    z-index: 2;
    font-size: 1.5em;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
">
  One Stop Solution
</h5>

<img src="{{ asset('frontend/images/cir.png') }}"
     alt="decoration"
     
     style="position: relative; z-index: 1; ">

             <img src="{{ asset('frontend/images/picture34.png') }}" alt="audit"
            style="
            position: absolute;
            right: 0;
            top: 670px;
            height: 150px;
            /* opacity: 0.1; */
            z-index: 1;
            pointer-events: none;
         ">

<div style="padding: 2rem; border-radius: 0.5rem;">
  <blockquote style="margin: 0; text-align: center;">
    <p style="margin: 0; font-size: 5.5rem; font-style: italic; color: #031e47; display: inline-block; position: relative;">
     
      "THE COMPLETE<br>
      SOLUTION"
     
    </p>
  </blockquote>
</div>





<section
  id="smart-living-transform"
  class="position-relative overflow-hidden py-6 py-lg-8"
  style="
    background: url('frontend/images/picture33.png') no-repeat center center;
    background-size: cover;
  "
>

</section>

   <div class="video-section ">
        <video autoplay muted loop playsinline>
            <source src="frontend/images/video3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="video-container container-fluid">

        </div>
    </div>



    <section
        style="background-color: #f9fbfd; height: 65vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">

        <!-- Static title -->
        <h1 class="display-4 text-dark mb-1 mt-3">WHAT WE ARE OFFERING</h1>

        <!-- Carousel for only the sub-headings -->
        <div id="heroCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <h4 class="display-4 text-dark">METERING</h4>
                </div>
                <div class="carousel-item">
                    <h4 class="display-4 text-dark">MEASUREMENT</h4>
                </div>
                <div class="carousel-item">
                    <h4 class="display-4 text-dark">SIGNALLING</h4>
                </div>
                <div class="carousel-item">
                    <h4 class="display-4 text-dark">CONTROL</h4>
                </div>
                <div class="carousel-item">
                    <h4 class="display-4 text-dark">SUPERVISION</h4>
                </div>
            </div>

            <!-- Optional controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>



    {{-- <img src="{{ asset('frontend/images/cir.png') }}"
     alt="decoration"
     
     style="position: relative; z-index: 1;  opacity: 0.1; "> --}}

             <img src="{{ asset('frontend/images/gear.png') }}" alt="audit"
            style="
            position: absolute;
            right: 0;
            top: 2550px;
            height: 450px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         ">


<section style="padding: 50px 0; background: #ffffff;">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Left Side (FAQ List) -->
      <div class="col-md-6">
        <div style="display: flex; align-items: center; margin-bottom: 15px;">
          <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" alt="FAQ" style="width: 50px; margin-right: 10px;">
          <h5 style="margin: 0; font-weight: bold;">FAQ</h5>
        </div>

        <div style="margin-bottom: 15px; display: flex;">
    <span style="
  color: #ff2e8a;
  font-weight: bold;
  font-size: 35px;
  margin-right: 12px;
  display: inline-block;
  transform: rotate(-15deg);
  text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
">→</span>

     <p class="zoom-scroll" style="margin: 0; font-size: 17px; text-transform: uppercase; letter-spacing: 0.5px;">
  Are you concerned about high energy bills even after solar deployment. we come after it.
</p>

        </div>

        <div style="margin-bottom: 15px; display: flex;">
<span style="
  color: #ff2e8a;
  font-weight: bold;
  font-size: 35px;
  margin-right: 12px;
  display: inline-block;
  transform: rotate(-15deg);
  text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
">→</span>
          <p  class="zoom-scroll" style="margin: 0; font-size: 17px; text-transform: uppercase; letter-spacing: 0.5px;">
            Have you perform in energy audit and give you the complete health scorecard of the load with artificial intelligence tool.
          </p>
        </div>

        <div style="margin-bottom: 15px; display: flex;">
<span style="
  color: #ff2e8a;
  font-weight: bold;
  font-size: 35px;
  margin-right: 12px;
  display: inline-block;
  transform: rotate(-15deg);
  text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
">→</span>
          <p class="zoom-scroll" style="margin: 0; font-size: 17px; text-transform: uppercase; letter-spacing: 0.5px;">
            Do you want to be notified if the current month bill has exceeded the previous month.
          </p>
        </div>

        <div style="display: flex;">
<span style="
  color: #ff2e8a;
  font-weight: bold;
  font-size: 35px;
  margin-right: 12px;
  display: inline-block;
  transform: rotate(-15deg);
  text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
">→</span>
          <p  class="zoom-scroll" style="margin: 0; font-size: 17px; text-transform: uppercase; letter-spacing: 0.5px;">
            Do you want to be notified if your load has gone faulty and consuming much energy
          </p>
        </div>
      </div>

      <!-- Right Side (Text with Animation) -->
      <div class="col-md-6 text-center">
        <div style="
          background: linear-gradient(to right, #ffffff, #e0e0e0);
          padding: 40px 20px;
          border-radius: 10px;
          animation: floatUpDown 3s ease-in-out infinite alternate;
        ">
          <h2 class="zoom-scroll" style="margin: 0; font-weight: 600; font-style: italic; font-size: 28px; color: #2c3e50; line-height: 1.5;">
            DON'T WORRY<br>
            WE GOT YOU<br>
            COVERED
          </h2>
        </div>
      </div>

    </div>
  </div>

  <!-- Inline Animation Keyframes -->
  <style>
    @keyframes floatUpDown {
      0%   { transform: translateY(0px); }
      100% { transform: translateY(-10px); }
    }
  </style>
</section>








    <section id="products" style="margin-bottom: 10px; position: relative;">
    <div class="container-fluid" style="position: relative;">
        <!-- PRODUCT CAROUSEL (MOVED ABOVE HERO IMAGE) -->
        <div class="product-carousel" style="position: absolute; top: 450px; left: 0; right: 0; z-index: 10;">
            @foreach ($products as $index => $product)
                <div class="product-card {{ $index === 0 ? 'active' : '' }}" 
                     data-index="{{ $index }}"
                     data-hero-img="{{ asset('uploads/products/' . $product->image) }}" 
                    >

                   <a href="{{ route('product.show', $product->id) }}" class="title-link" style="text-decoration: none; color: inherit;">
    <div class="title">
        {{ $product->name }} <i class="bi bi-arrow-right-circle fs-3 extrahide"></i>
    </div>
</a>

<style>
.title-link:hover .title {
    text-decoration: underline; /* Optional hover effect */
}
</style>
                    <div class="extra">
                        <p class="mb-2">{{ $product->description }}</p>
                    </div>
                    <div class="indicator"></div>
                </div>
            @endforeach

            {{-- <!-- View All Card -->
            <a href="/products" >
                <div class="product-card" 
                    <div class="icon" style="margin-top: 84px;">
                
                    </div>
                    <div class="title">View All Products</div>
                    <div class="indicator"></div>
                </div>
            </a> --}}
        </div>

        <!-- HERO PANEL (MOVED BELOW CAROUSEL) -->
        <div id="hero" class="hero-image" style="position: relative; z-index: 1;">
            <img id="hero-img" src="{{ count($products) > 0 ? asset('uploads/products/' . $products[0]->image) : 'https://via.placeholder.com/800x300?text=No+Products' }}" 
                 alt="Featured product" width="100%" height="600px" style="filter: blur(0px); transition: filter 0.3s ease;">
            <h1 id="hero-text" style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                {{ count($products) > 0 ? $products[0]->name : 'No Products' }}
            </h1>
        </div>
    </div>
</section>

<style>
    /* Add blur effect when hovering over carousel */
    .product-carousel:hover ~ #hero img {
        filter: blur(5px);
    }
    
    /* Individual card hover effects */
    .product-card:hover {
        transform: scale(1.05);
        z-index: 20;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .product-carousel {
        transition: all 0.3s ease;
    }
</style>








    <div class="container-fluid py-5 position-relative">
        <div class="row">
            <div class="col-lg-2 d-flex align-items-center justify-content-center">
                <h5 class="text-center mb-4">Trusted by<br>renowned brands</h5>
            </div>
            <div class="col-lg-10">
                <div class="logo-carousel">
                    <div class="logo-track">
                        @foreach ($partners as $partner)
                            {{-- <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"> --}}
                            <img src="{{ asset('uploads/partners/' . $partner->image) }}" alt="Current Image">
                        @endforeach
                        <!-- Duplicates for seamless loop -->
                        @foreach ($partners as $partner)
                            <img src="{{ asset('uploads/partners/' . $partner->image) }}" alt="{{ $partner->image }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>



 















    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="row g-4 align-items-stretch">

                <div class="col-12 col-md-6 h-100">
                    <div class="  p-4 h-100">
                        <div class="position-relative" style="z-index:1">
                            <div class="d-flex align-items-center mb-3">
                                <div class=" p-3 me-3">
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
                    <div class=" p-4 h-100 position-relative overflow-hidden">
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
                                <div class=" p-3 me-3">
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




{{-- 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
             
                <div class="hub-wrapper">
                    <div class="hub-container">
                        <div class="hub-content">

                            <!-- center circle now uses CSS background for the icon -->
                            <div class="hub-center">
                                <!-- img is no longer needed -->
                            </div>

                            <!-- eight icons around -->
                            <div class="hub-icon icon-top">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132693.png"
                                        alt="Cost Reduction">
                                </div>
                                <div>Cost Reduction</div>
                            </div>
                            <div class="hub-icon icon-top-right">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132733.png"
                                        alt="Projections">
                                </div>
                                <div>Projections</div>
                            </div>
                            <div class="hub-icon icon-right">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132699.png" alt="Control">
                                </div>
                                <div>Control</div>
                            </div>
                            <div class="hub-icon icon-bot-right">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132703.png" alt="Inspection">
                                </div>
                                <div>Inspection</div>
                            </div>
                            <div class="hub-icon icon-bot">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132697.png" alt="Analysis">
                                </div>
                                <div>Analysis</div>
                            </div>
                            <div class="hub-icon icon-bot-left">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132709.png"
                                        alt="Calibration">
                                </div>
                                <div>Calibration</div>
                            </div>
                            <div class="hub-icon icon-left">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132695.png" alt="Metering">
                                </div>
                                <div>Metering</div>
                            </div>
                            <div class="hub-icon icon-top-left">
                                <div class="icon-circle">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132707.png" alt="Automation">
                                </div>
                                <div>Automation</div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary btn-lg px-4">Get Started</button>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- empty or your other content -->
            </div>
        </div>
    </div> --}}























        <section id="services">
            <div class="container  mt-5">
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
            <!-- Smart Security Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 p-0 rounded-4 text-center transition hover-shadow"
                    style="overflow: hidden;">
                    <div class="card-glass-bg bg-info bg-opacity-10"></div>
                    <div class="card-content p-4 position-relative">
                        <div class="icon-wrapper bg-info bg-opacity-10 mb-4 mx-auto">
                            {{-- <i class="bi bi-shield-lock-fill fs-1 text-info animated-icon"></i> --}}
                            <img src="/frontend/images/green-shield.png" alt="" srcset="" width="60px"
                                height="60px" class="animated-icon">

                        </div>
                        <h4 class="fw-bold mb-3">Smart Security</h4>
                        <p class="text-muted">24/7 intelligent monitoring with real-time alerts and automated security
                            responses while you're away.</p>
                        <a href="#"
                            class="btn btn-info text-white rounded-pill px-4 py-2 mt-3 shadow-sm transition">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Voice Control Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 p-0 rounded-4 text-center transition hover-shadow"
                    style="overflow: hidden;">
                    <div class="card-glass-bg bg-primary bg-opacity-10"></div>
                    <div class="card-content p-4 position-relative">
                        <div class="icon-wrapper bg-primary bg-opacity-10 mb-4 mx-auto">
                            {{-- <i class="bi bi-mic-fill fs-1 text-primary animated-icon"></i> --}}
                            <img src="/frontend/images/microphone.gif" alt="" srcset="" width="60px"
                                height="60px" class="animated-icon">
                        </div>
                        <h4 class="fw-bold mb-3">Voice Control</h4>
                        <p class="text-muted">Hands-free control with seamless Alexa, Google Assistant, and Siri
                            integration for a smarter home.</p>
                        <a href="#"
                            class="btn btn-primary text-white rounded-pill px-4 py-2 mt-3 shadow-sm transition">See
                            Compatibility</a>
                    </div>
                </div>
            </div>

            <!-- Remote Access Card -->
            <div class="col-md-4">
                <div class="card h-100 border-0 p-0 rounded-4 text-center transition hover-shadow"
                    style="overflow: hidden;">
                    <div class="card-glass-bg bg-danger bg-opacity-10"></div>
                    <div class="card-content p-4 position-relative">
                        <div class="icon-wrapper bg-danger bg-opacity-10 mb-4 mx-auto">
                            {{-- <i class="bi bi-phone-fill fs-1 text-danger animated-icon"></i> --}}
                            <img src="/frontend/images/mo.png" alt="" srcset="" width="60px"
                                height="60px" class="animated-icon">

                        </div>
                        <h4 class="fw-bold mb-3">Remote Access</h4>
                        <p class="text-muted">Stay connected from anywhere with our secure mobile app and take full control
                            of your home's security.</p>
                        <a href="#"
                            class="btn btn-danger text-white rounded-pill px-4 py-2 mt-3 shadow-sm transition">Download
                            App</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CSS for Animations and Styles -->
        <style>
            .card-glass-bg {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                opacity: 0.7;
                z-index: 0;
            }

            .card-content {
                z-index: 1;
                background-color: rgba(255, 255, 255, 0.8);
                height: 100%;
            }

            .hover-shadow:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
                transition: all 0.4s ease;
            }

            .transition {
                transition: all 0.4s ease;
            }

            .icon-wrapper {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            /* Icon Animation */
            .animated-icon {
                animation: pulsing 2s infinite;
            }

            @keyframes pulsing {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.2);
                }

                100% {
                    transform: scale(1);
                }
            }

            /* Additional Hover Effect on Icon */
            .icon-wrapper:hover .animated-icon {
                animation: bounce 0.6s;
            }

            @keyframes bounce {
                0% {
                    transform: translateY(0);
                }

                30% {
                    transform: translateY(-15px);
                }

                50% {
                    transform: translateY(0);
                }

                70% {
                    transform: translateY(-7px);
                }

                100% {
                    transform: translateY(0);
                }
            }
        </style>
    </div>


    {{-- <section id="asi">



        <div class="container-fluid">


            <div class="parallax-section" style="background-image: url('frontend/images/p14.jpg');">
                <div class="parallax-overlay"></div>
                <div class="parallax-content">
                    <h2 class="display-4 fw-bold mb-4 ">Transform Your Living Space</h2>
                    <p class="lead mb-5">Experience the perfect blend of technology and comfort with our smart home
                        solutions</p>
                    <a href="#" class="btn btn-primary btn-lg px-4 py-2">Get Started Today</a>
                </div>
            </div>
        </div>


    </section> --}}





    <section id="smart-living-transform" class="position-relative overflow-hidden py-6 py-lg-8">
        <!-- Glass Morphism Overlay -->
        <div class="glass-overlay position-absolute w-100 h-100 top-0 start-0"></div>

        <!-- Diagonal Background Split -->
        <div class="diagonal-background position-absolute w-100 h-100 top-0 start-0">
            <div class="image-half" style="background-image: url('frontend/images/p16.jpg');"></div>
            <div class="color-half bg-dark"></div>
        </div>

        <!-- Content Container -->
        <div class="container position-relative" style="z-index: 10;">
            <div class="row min-vh-80 align-items-center g-5">
                <!-- Text Content -->
                <div class="col-lg-6 pe-lg-5" data-aos="fade-right">
                    <div class="text-white">
                        <span
                            class="d-inline-block bg-primary bg-opacity-10 px-3 py-2 rounded-pill mb-3 text-uppercase small fw-bold">
                            Future Living
                        </span>
                        <h1 class="display-3 fw-bold mb-4 text-gradient">Reimagine<br>Your Living Space</h1>
                        <p class="lead mb-4 text-light opacity-75" style="font-size: 1.25rem;">
                            Where cutting-edge technology meets effortless living in perfect harmony.
                        </p>
                        <div class="d-flex flex-wrap gap-3 mt-5">
                            <a href="#" class="btn btn-primary btn-lg px-4 py-3 rounded-pill glow-on-hover">
                                <i class="bi bi-lightning-charge-fill me-2"></i> Smart Upgrade
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                                <i class="bi bi-collection-play me-2"></i> View Showcase
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Working Device Mockup -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="position-relative" style="max-width: 300px; margin: 0 auto;">
                        <div class="iphone-mockup">
                            <div class="screen">
                                <div class="screen-content" style="background-image: url('frontend/images/mobile.jpg');">
                                </div>
                            </div>
                            <div class="home-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Smart Devices -->
        <div class="floating-devices">
            <div class="device bulb" style="--delay: 0s;"></div>
            <div class="device thermostat" style="--delay: 1s;"></div>
            <div class="device camera" style="--delay: 2s;"></div>
        </div>
    </section>

    <style>
        /* Section Base Styling */
        #smart-living-transform {
            min-height: 90vh;
            background-color: #0f172a;
        }

        /* Diagonal Split Background */
        .diagonal-background {
            clip-path: polygon(0 0, 60% 0, 40% 100%, 0% 100%);
        }

        .diagonal-background .image-half {
            position: absolute;
            width: 60%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .diagonal-background .color-half {
            position: absolute;
            width: 40%;
            height: 100%;
            left: 60%;
        }

        /* Glass Morphism Effect */
        .glass-overlay {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(90deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* iPhone Mockup */
        .iphone-mockup {
            position: relative;
            width: 100%;
            padding-bottom: 200%;
            background: #f1f1f1;
            border-radius: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 10px solid #1e293b;
        }

        .iphone-mockup .screen {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 50px;
            border-radius: 30px;
            overflow: hidden;
            background: #000;
        }

        .iphone-mockup .screen-content {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .iphone-mockup .home-button {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: #1e293b;
            border-radius: 5px;
        }

        /* Floating Devices Animation */
        .floating-devices {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 5;
        }

        .device {
            position: absolute;
            width: 60px;
            height: 60px;
            background-size: contain;
            background-repeat: no-repeat;
            animation: float 8s infinite ease-in-out;
            animation-delay: var(--delay);
            opacity: 0.8;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.3));
        }

        /* .bulb {
            background-image: url('https://cdn-icons-png.flaticon.com/512/3659/3659898.png');
            top: 20%;
            left: 10%;
        }
        .thermostat {
            background-image: url('https://cdn-icons-png.flaticon.com/512/3659/3659899.png');
            top: 60%;
            left: 15%;
        }
        .camera {
            background-image: url('https://cdn-icons-png.flaticon.com/512/3659/3659904.png');
            top: 30%;
            right: 10%;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
         */
        /* Button Glow Effect */
        .glow-on-hover {
            transition: all 0.3s ease;
        }

        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(13, 110, 253, 0.7);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .diagonal-background {
                clip-path: polygon(0 0, 100% 0, 100% 60%, 0% 100%);
            }

            .diagonal-background .image-half {
                width: 100%;
                height: 60%;
            }

            .diagonal-background .color-half {
                width: 100%;
                height: 40%;
                top: 60%;
                left: 0;
            }

            .iphone-mockup {
                max-width: 250px;
                margin-top: 3rem;
            }
        }
    </style>






    <section class="py-6 py-lg-7 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Video Column with Accent Decoration -->
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative pe-lg-4">
                    <!-- Decorative Accent Box -->
                    <div class="position-absolute top-0 start-0 bg-warning opacity-10"
                        style="width: 93%; height: 98%; z-index: 1; transform: translate(-14px, 30px); border-radius: 12px;">
                    </div>
                    <!-- Video Container with Shadow and Border -->
                    <div class="position-relative rounded-3 overflow-hidden shadow-lg"
                        style="z-index: 1; border: 8px solid white;">
                        <video id="promoVideo" class="w-100"
                            poster="https://placehold.co/600x400?text=CF+Smart+Technology" style="display: block;">
                            <source src="your-video.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Play Button with Pulse Animation -->
                        <button
                            class="btn btn-warning rounded-circle position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center shadow"
                            style="width: 80px; height: 80px; z-index: 3; border: none;"
                            onclick="document.getElementById('promoVideo').play(); this.style.display='none';">
                            <i class="bi bi-play-fill fs-3 text-white" style="margin-left: 4px;"></i>
                            <span
                                class="position-absolute top-0 start-0 w-100 h-100 rounded-circle bg-warning opacity-75 animate-pulse"
                                style="z-index: -1;"></span>
                        </button>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-lg-6 ps-lg-5 mt-5 mb-5">
                    <h3 class="fw-bold  mb-3">Leading the Renewable Energy Revolution</h3>
                    <div class="pe-lg-5">
                        <p class="text-muted mb-4 fs-lg">
                            As a top-tier solar energy provider, we deliver cutting-edge renewable solutions tailored to
                            your needs.
                            Our certified team combines industry expertise with sustainable innovation to maximize your
                            energy efficiency
                            and reduce environmental impact.
                        </p>
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-4">
                                <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-award-fill text-warning fs-4"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Certified Excellence</h6>
                                <p class="text-muted mb-0 fs-sm">NABCEP certified professionals with 10+ years experience
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="me-4">
                                <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-lightning-charge-fill text-warning fs-4"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Sustainable Results</h6>
                                <p class="text-muted mb-0 fs-sm">5,000+ successful installations with 98% customer
                                    satisfaction</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-warning px-4 py-3 fw-semibold rounded-pill">Explore Our
                            Solutions</a>
                        <a href="#" class="btn btn-outline-secondary px-4 py-3 fw-semibold rounded-pill">
                            <i class="bi bi-telephone me-2"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Icons -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet"> --}}

    <!-- Custom CSS for animation -->
    <style>
        .animate-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.75;
            }

            70% {
                transform: scale(1.3);
                opacity: 0;
            }

            100% {
                transform: scale(0.95);
                opacity: 0;
            }
        }
    </style>






    {{-- <section id="as">

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

    </section> --}}

    <section id="smart-home" class="py-6 py-lg-8 mt-5 mt-lg-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #dbe2e0 100%);">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column - Text Content -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="pe-lg-4">
                        <h1 class="display-4 fw-bold mb-4 mt-5" data-aos="fade-up" data-aos-delay="100">
                            Intelligent Living <br>
                            <span class="text-primary position-relative">
                                <span class="position-relative z-index-2">Designed for</span>
                                {{-- <span class="position-absolute bottom-0 start-0 z-index-1 bg-primary" style="height: 12px; width: 100%; opacity: 0.15;"></span> --}}
                            </span>
                            <span class="text-primary">Modern Lifestyles</span>
                        </h1>

                        <p class="lead text-muted mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="250">
                            Experience seamless automation that adapts to your routine, <br class="d-none d-lg-block">
                            putting your comfort at the forefront of every innovation.
                        </p>

                        <div class="mt-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                            <a href="#contact" class="btn btn-primary btn-lg px-4 me-3 mb-3 mb-sm-0">Get Started</a>
                            <a href="#features" class="btn btn-outline-primary btn-lg px-4">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image -->
                <div class="col-lg-6">
                    <div class="position-relative ps-lg-5 mt-4 mt-lg-0" data-aos="fade-right" data-aos-delay="500">
                        <div class="position-absolute top-0 start-0 bg-success rounded-circle"
                            style="width: 120px; height: 120px; transform: translate(-10%, -40%); opacity: 0.1;"></div>
                        <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle"
                            style="width: 80px; height: 80px; transform: translate(30%, 30%); opacity: 0.1;"></div>
                        <div class="position-relative rounded-4 overflow-hidden shadow-lg"
                            style="border: 10px solid white;">
                            <img src="{{ asset('frontend/images/automation.gif') }}" alt="Smart Home Automation"
                                class="img-fluid" style="object-fit: cover; width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- <section id="plans">

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

    </section> --}}



    <script>
          /* Scroll observer */
  window.addEventListener('scroll', function () {
    document.querySelectorAll('.zoom-scroll').forEach(function (el) {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight - 100) {
        el.classList.add('visible');
      }
    });
  });
    </script>
@endsection
