@extends('frontend.layout.layout')
@section('content')
    <style>
        /* PRODUCT CAROUSEL */
        .product-carousel {
            display: flex;
            overflow: hidden;
            height: 160px;
            justify-content: space-between;
        }

        .product-card {
            flex: 1;
            position: relative;
            text-align: center;
            padding: 1rem;
            transition: flex 0.6s ease, background-color 0.6s ease;
            cursor: pointer;
            min-width: 200px;
            margin: 0 0;
            opacity: 23px;
            display: block;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        .product-card:not(.active):hover {
            background-color: #f8f9fa;
        }

        .product-card.active {
            flex: 3;
            background-color: rgba(255, 235, 59, 0.1);
            backdrop-filter: blur(7px);
            -webkit-backdrop-filter: blur(7px);
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
            .hero-text {
                font-size: 1.5rem;
            }

            .product-carousel {
                overflow: hidden;
            }

            .product-card {
                display: none;
            }

            .product-card.active {
                display: block;
                background-color: rgba(255, 235, 59, 0.1);
                flex: none;
                min-width: 100%;
            }

            .product-card .indicator {
                height: 3px;
            }

            .product-card .icon img {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 480px) {
            .hero-text {
                font-size: 1.25rem;
            }

            .product-card .title {
                font-size: 0.9rem;
            }

            .product-card .extra,
            .product-card .extrahide {
                font-size: 0.9rem;
            }
        }

        /* Video Section */
        .video-section {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .video-section video {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Comparison Table */
        .blue {
            background-color: rgb(113, 113, 247);
        }

        .red {
            background-color: rgb(252, 96, 96);
        }

        /* Logo Carousel */
        .logo-carousel {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .logo-track {
            display: flex;
            animation: scroll 20s linear infinite;
        }

        .logo-track img {
            height: 60px;
            margin: 0 20px;
            object-fit: contain;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsive Quote */
        .responsive-quote p {
            margin: 0;
            font-size: clamp(2.5rem, 8vw, 5.5rem);
            font-style: italic;
            color: #031e47;
            display: inline-block;
            position: relative;
            line-height: 1.2;
        }

        /* Section Headings */
        .section-heading {
            text-transform: uppercase;
            font-weight: 800;
            margin: clamp(1rem, 5vw, 3rem) 0 clamp(5px, 1vw, 10px) clamp(0.5rem, 2vw, 1rem);
            position: relative;
            z-index: 2;
            font-size: clamp(1.1rem, 4vw, 1.5rem);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.3;
        }

        /* Smart Living Section */
        #smart-living-transform {
            min-height: 90vh;
            background-color: #0f172a;
        }

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

        .glass-overlay {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .text-gradient {
            background: linear-gradient(90deg, #fff 0%, rgba(255, 255, 255, 0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .iphone-mockup {
            position: relative;
            margin-top: 32px;
            width: 90%;
            padding-bottom: 200%;
        }

        .iphone-mockup .screen {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 10px;
            bottom: 50px;
            border-radius: 30px;
            overflow: hidden;
        }

        .glow-on-hover {
            transition: all 0.3s ease;
        }

        .glow-on-hover:hover {
            box-shadow: 0 0 15px rgba(13, 110, 253, 0.7);
        }

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

        /* Video Modal */
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

        .modal-content {
            background: transparent;
        }

        .btn-close-white {
            filter: invert(1) grayscale(90%) brightness(200%);
        }

        /* Float Animation */
        @keyframes floatUpDown {
            0% {
                transform: translateY(0px);
            }

            100% {
                transform: translateY(-10px);
            }
        }

        /* Zoom Scroll Effect */
        .zoom-scroll {
            transition: transform 0.3s ease;
        }

        .zoom-scroll:hover {
            transform: scale(1.02);
        }
    </style>

    <div id="carouselExampleRide" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500" data-bs-wrap="true">
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
                    <img src="{{ asset('uploads/sliders/' . $slide->image) }}" class="d-block w-100"
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

 <div class="responsive-quote" style="padding: 1.5rem; border-radius: 0.5rem;">
        <blockquote style="margin: 0; text-align: center;">
            <p style="margin: 0; font-size: clamp(2.5rem, 8vw, 5.5rem); font-style: italic; color: #031e47; display: inline-block; position: relative; line-height: 1.2;">
                "THE COMPLETE<br>
                SOLUTION"
            </p>
        </blockquote>
    </div>

 <section id="smart-living-transform" 
         class="position-relative overflow-hidden py-6 py-lg-8 d-flex align-items-center justify-content-center text-center"
         style="background: url('{{ asset('frontend/images/picture33.png') }}') no-repeat center center / cover;">
    
    <!-- Optional content container inside -->
    {{-- <div class="container text-white">
        <h2 class="display-5 fw-bold">Smart Living Transformation</h2>
        <p class="lead">Enhancing life through intelligent design and technology</p>
    </div> --}}

</section>


    <div class="video-section">
        <video autoplay muted loop playsinline>
            <source src="frontend/images/video3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="video-container container-fluid"></div>
    </div>

<section class="bg-light d-flex flex-column align-items-center justify-content-center text-center py-5 px-3">
    <h1 class="display-5 text-dark mb-4">WHAT WE ARE OFFERING</h1>

    <div id="heroCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h4 class="display-6 text-dark">METERING</h4>
            </div>
            <div class="carousel-item">
                <h4 class="display-6 text-dark">MEASUREMENT</h4>
            </div>
            <div class="carousel-item">
                <h4 class="display-6 text-dark">SIGNALLING</h4>
            </div>
            <div class="carousel-item">
                <h4 class="display-6 text-dark">CONTROL</h4>
            </div>
            <div class="carousel-item">
                <h4 class="display-6 text-dark">SUPERVISION</h4>
            </div>
        </div>

        <!-- Controls -->
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
<style>
    @media (max-width: 768px) {
    #heroCarousel h4 {
        font-size: 1.5rem;
    }

    section h1 {
        font-size: 2rem;
    }
}

</style>

    <img src="{{ asset('frontend/images/gear.png') }}" alt="audit" style="position: absolute; right: 0; top: 2550px; height: 500px; opacity: 0.1; z-index: 1; pointer-events: none;">

 <section class="py-5" style="background-color: #ffffff;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column -->
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('frontend/images/faq.png') }}" alt="FAQ" class="img-fluid" style="max-width: 150px; margin-right: 10px;">
                </div>

                @php
                    $questions = [
                        "Are you concerned about high energy bills even after solar deployment. we come after it.",
                        "Have you perform in energy audit and give you the complete health scorecard of the load with artificial intelligence tool.",
                        "Do you want to be notified if the current month bill has exceeded the previous month.",
                        "Do you want to be notified if your load has gone faulty and consuming much energy"
                    ];
                @endphp

                @foreach ($questions as $question)
                    <div class="d-flex mb-3">
                        <span style="color: #ff2e8a; font-weight: bold; font-size: 35px; margin-right: 12px; display: inline-block; transform: rotate(-15deg); text-shadow: 1px 1px 2px rgba(0,0,0,0.15);">→</span>
                        <p style="margin: 0; font-size: 17px; text-transform: uppercase; letter-spacing: 0.5px;">{{ $question }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Right Column -->
            <div class="col-12 col-md-6 text-center">
                <div style="background: linear-gradient(to right, #ffffff, #e0e0e0); padding: 40px 20px; border-radius: 10px; animation: floatUpDown 3s ease-in-out infinite alternate;">
                    <h2 style="margin: 0; font-weight: 600; font-style: italic; font-size: 28px; color: #2c3e50; line-height: 1.5;">
                        DON'T WORRY<br>WE GOT YOU<br>COVERED
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add this in your <style> or CSS file -->
<style>
@keyframes floatUpDown {
    0% { transform: translateY(0); }
    100% { transform: translateY(-10px); }
}
</style>

    
    <div style="position: relative;">
        <h5 class="section-heading">OUR PRODUCTS</h5>
        <img src="{{ asset('frontend/images/cir.png') }}" alt="decoration" style="position: relative; z-index: 1; width: 100%; max-width: 500px; height: auto; margin-bottom: clamp(1.5rem, 5vw, 3.125rem); display: block;">
    </div>

    <section id="products" style="margin-bottom: 10px; position: relative;">
        <div class="container-fluid" style="position: relative;">
            <div class="product-carousel" style="position: absolute; top: 450px; left: 0; right: 0; z-index: 10;">
                @foreach ($products as $index => $product)
                    <div class="product-card {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" data-hero-img="{{ asset('uploads/products/' . $product->image) }}">
                        <a href="{{ route('product.show', $product->id) }}" class="title-link" style="text-decoration: none; color: inherit;">
                            <div class="title">
                                {{ $product->name }} <i class="bi bi-arrow-right-circle fs-3 extrahide"></i>
                            </div>
                        </a>
                        <div class="extra">
                            <p class="mb-2">{{ $product->description }}</p>
                        </div>
                        <div class="indicator"></div>
                    </div>
                @endforeach
            </div>

            <div id="hero" class="hero-image" style="position: relative; z-index: 1;">
                <img id="hero-img" src="{{ count($products) > 0 ? asset('uploads/products/' . $products[0]->image) : 'https://via.placeholder.com/800x300?text=No+Products' }}" alt="Featured product" width="100%" height="600px" style="filter: blur(0px); transition: filter 0.3s ease;">
                <h1 id="hero-text" style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    {{ count($products) > 0 ? $products[0]->name : 'No Products' }}
                </h1>
            </div>
        </div>
    </section>

    <div style="position: relative;">
        <h5 class="section-heading">SCHEMATICS</h5>
        <img src="{{ asset('frontend/images/cir.png') }}" alt="decoration" style="position: relative; z-index: 1; width: 100%; max-width: 500px; height: auto; margin-bottom: clamp(1.5rem, 5vw, 3.125rem); display: block;">
    </div>
    
    <section class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/p1.png') }}" alt="Energy consumption notification content" class="img-fluid" style="width: 100%; height: auto; display: block;">
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card" style="border: none; border-radius: 25px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/picture36.png') }}" alt="Energy consumption notification content" class="img-fluid" style="width: 100%; height: auto; display: block;">
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card" style="border: none; border-radius: 48px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/picture37.png') }}" alt="Energy consumption notification content" class="img-fluid" style="width: 100%; height: auto; display: block;">
                </div>
            </div>
        </div>
    </section>

    <div style="position: relative;">
        <h5 class="section-heading">HOW EMS IS BETTER THAN SOLAR</h5>
        <img src="{{ asset('frontend/images/cir.png') }}" alt="decoration" style="position: relative; z-index: 1; width: min(100%, 500px); max-width: 100%; height: auto; padding-bottom: clamp(20px, 10vw, 80px); display: block; margin: 0 auto;">
    </div>

    <section class="container border rounded shadow">
        <div class="row">
            <div class="col-2 d-flex flex-column align-items-center justify-content-center bg-primary text-white fw-bold text-center" style="writing-mode: vertical-lr; padding: 10px; font-size: 0.9rem;">
                MAIN FEATURE<br>COMPARISON
            </div>
            <div class="col-5 bg-info text-white fw-bold text-center py-3 position-relative">
                EMS
            </div>
            <div class="col-5 bg-success text-white fw-bold text-center py-3 position-relative">
                SOLAR
            </div>
        </div>

        <div class="row border border-top-0">
            <div class="col-2 fw-bold text-center py-2 bg-light">INITIAL INVESTMENT</div>
            <div class="col-5 py-2 blue">Has a very limited cost upfront</div>
            <div class="col-5 py-2 red">Initial investment cost is 5 times more.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">KEY FEATURES</div>
            <div class="col-5 py-2 blue">Is not a part of generation.</div>
            <div class="col-5 py-2 red">Is the most cost-effective energy generation source.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">CONTROL</div>
            <div class="col-5 py-2 blue">Turning on and off the load to control the loads which can reduce the overall bill.</div>
            <div class="col-5 py-2 red">Does not have a control feature which can reduce the overall bill.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">TRACKING HIGH LOADS</div>
            <div class="col-5 py-2 blue">Warns the user on faulty or high consumption load.</div>
            <div class="col-5 py-2 red">Cannot trace the fault.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">MONITOR BILLS</div>
            <div class="col-5 py-2 blue">Customised per unit rate tariff and the complete projected bills analysis compared to the previous month.</div>
            <div class="col-5 py-2 red">Gives an insight of the ongoing energy consumption however cannot forecast.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">USER FRIENDLY DASHBOARD</div>
            <div class="col-5 py-2 blue">User customized app with built-in tariff rates to calculate the projected energy bills.</div>
            <div class="col-5 py-2 red">Default standard app without tariff customised tariff rates.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">DEPENDENCY ON WEATHER</div>
            <div class="col-5 py-2 blue">No dependency on weather and added advantage if integrated with solar to predict weather forecasts and expected output.</div>
            <div class="col-5 py-2 red">Depends on weather for greater benefits.</div>
        </div>

        <div class="row border">
            <div class="col-2 fw-bold text-center py-2 bg-light">AI BASED PREDICTION</div>
            <div class="col-5 py-2 blue">Predictive analysis of each load health score.</div>
            <div class="col-5 py-2 red">No Predictive analysis of each load.</div>
        </div>
    </section>

    <section class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card" style="border: none; border-radius: 48px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/picture38.png') }}" alt="Energy consumption notification content" class="img-fluid" style="width: 100%; height: auto; display: block;">
                </div>
            </div>
        </div>
    </section>

    {{-- <div style="position: relative;">
        <h5 style="text-transform: uppercase; font-weight: 800; margin: clamp(0.5rem, 2vw, 1rem) 0 clamp(5px, 1vw, 10px) clamp(0.5rem, 2vw, 1rem); padding-top: clamp(10px, 2vw, 20px); position: relative; z-index: 2; font-size: clamp(1.5rem, 6vw, 2.3rem); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.2;">
            AI IN EMS
        </h5>
        <img src="{{ asset('frontend/images/cir.png') }}" alt="decoration" style="position: relative; z-index: 1; width: min(100%, 500px); max-width: 100%; height: auto; padding-bottom: clamp(10px, 2vw, 20px); display: block; margin-left: clamp(0.5rem, 2vw, 1rem);">
    </div> --}}




{{-- <section class="bg-white py-5">

    <div class="container">


        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <p class="fs-5">
                    Artificial Intelligence (AI) plays a transformative role in Energy Management Systems (EMS), enhancing efficiency, reliability, and sustainability. Here are some key ways AI is utilized in EMS in the CF app:
                </p>
            </div>
        </div>

        <!-- Feature: Predictive Maintenance -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture40.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Predictive Maintenance</h5>
                <p>
                    AI algorithms analyze data from various sensors and equipment to predict potential failures before they occur. This helps in scheduling maintenance activities proactively, reducing downtime and extending the lifespan of equipment.
                </p>
            </div>
        </div>

        <!-- Feature: Load Forecasting -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture45.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Load Forecasting</h5>
                <p>
                    AI models predict future energy demand based on historical data, weather conditions, and other factors. Accurate load forecasting helps in better planning and resource allocation.
                </p>
            </div>
        </div>

        <!-- Feature: Fault Detection -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture44.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Fault Detection and Diagnostics</h5>
                <p>
                    AI systems can detect anomalies in the energy system and diagnose issues quickly. This improves response times and minimizes the impact of faults on the overall system.
                </p>
            </div>
        </div>

        <!-- Feature: Renewable Integration -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture43.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Integration of Renewable Energy</h5>
                <p>
                    AI helps in managing the variability of renewable energy sources like solar and wind. By predicting generation patterns and optimizing storage, AI ensures a stable and reliable energy supply.
                </p>
            </div>
        </div>

        <!-- Feature: Decision-Making -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture42.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Enhanced Decision-Making</h5>
                <p>
                    AI provides decision-makers with actionable insights and recommendations based on data analysis. This leads to more informed and effective decisions regarding energy management.
                </p>
            </div>
        </div>

        <!-- Feature: Customer Engagement -->
        <div class="row align-items-start mb-4">
            <div class="col-auto">
                <img src="{{ asset('frontend/images/picture41.png') }}" alt="Icon" style="width: 50px;">
            </div>
            <div class="col">
                <h5 class="fw-bold">Customer Engagement</h5>
                <p>
                    AI-driven apps and dashboards provide users with real-time information about their energy usage, encouraging energy-saving behaviors and promoting sustainability.
                </p>
            </div>
        </div>
    </div>
</section> --}}


<section class="bg-white py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <p class="fs-5">
                    Artificial Intelligence (AI) plays a transformative role in Energy Management Systems (EMS), enhancing efficiency, reliability, and sustainability. Here are some key ways AI is utilized in EMS in the CF app:
                </p>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="row">
            <!-- Main Content (col-lg-8) -->
            <div class="col-lg-8">
                <!-- Predictive Maintenance -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture40.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Predictive Maintenance</h5>
                        <p>
                            AI algorithms analyze data from various sensors and equipment to predict potential failures before they occur. This helps in scheduling maintenance activities proactively, reducing downtime and extending the lifespan of equipment.
                        </p>
                    </div>
                </div>

                <!-- Load Forecasting -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture45.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Load Forecasting</h5>
                        <p>
                            AI models predict future energy demand based on historical data, weather conditions, and other factors. Accurate load forecasting helps in better planning and resource allocation.
                        </p>
                    </div>
                </div>

                <!-- Fault Detection -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture44.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Fault Detection and Diagnostics</h5>
                        <p>
                            AI systems can detect anomalies in the energy system and diagnose issues quickly. This improves response times and minimizes the impact of faults on the overall system.
                        </p>
                    </div>
                </div>

                <!-- Renewable Integration -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture43.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Integration of Renewable Energy</h5>
                        <p>
                            AI helps in managing the variability of renewable energy sources like solar and wind. By predicting generation patterns and optimizing storage, AI ensures a stable and reliable energy supply.
                        </p>
                    </div>
                </div>

                <!-- Enhanced Decision-Making -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture42.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Enhanced Decision-Making</h5>
                        <p>
                            AI provides decision-makers with actionable insights and recommendations based on data analysis. This leads to more informed and effective decisions regarding energy management.
                        </p>
                    </div>
                </div>

                <!-- Customer Engagement -->
                <div class="row align-items-start mb-4">
                    <div class="col-auto">
                        <img src="{{ asset('frontend/images/picture41.png') }}" alt="Icon" style="width: 50px;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold">Customer Engagement</h5>
                        <p>
                            AI-driven apps and dashboards provide users with real-time information about their energy usage, encouraging energy-saving behaviors and promoting sustainability.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar (col-lg-4) -->
            <div class="col-lg-4">
                <!-- Example Sidebar Content -->
                <div class="bg-light p-4 rounded">
                    <h5 class="fw-bold mb-3">AI in EMS Summary</h5>
                    <ul class="list-unstyled">
                        <li>✔ Predictive Maintenance</li>
                        <li>✔ Load Forecasting</li>
                        <li>✔ Fault Detection</li>
                        <li>✔ Renewable Integration</li>
                        <li>✔ Decision-Making Support</li>
                        <li>✔ Customer Engagement</li>
                    </ul>
                    <p class="mt-3">AI transforms how we manage energy by offering intelligent automation, prediction, and optimization at every level.</p>
                </div>
            </div>
        </div>
    </div>
</section>



    



    <section class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #0d6efd;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2" style="color: #0d6efd;"></i>All
                                Load Dashboard</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture1.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #fd7e14;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2" style="color: #fd7e14;"></i>Live
                                Dashboard</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture3.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #20c997;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2"
                                    style="color: #20c997;"></i>Detailed Data (One Load)</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="container my-5">
        <div class="row">
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture4.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #0d6efd;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2" style="color: #0d6efd;"></i>Control
                                The Load</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture5.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #fd7e14;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2" style="color: #fd7e14;"></i>Edit
                                Values To Switch Off Load Automatically</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card" style="border: none; border-radius: 12px; overflow: hidden;">
                    <img src="{{ asset('frontend/images/capture6.png') }}" alt="Energy consumption notification content"
                        class="img-fluid" style="width: 73%; height: 480px; display: block; margin: 0 auto;">
                    <div class="text-center mt-3 px-3">
                        <div class="d-inline-block px-4 py-2"
                            style="background: #f8f9fa; border-radius: 20px; border-left: 4px solid #20c997;">
                            <h5 class="m-0 text-muted"><i class="fas fa-quote-left me-2" style="color: #20c997;"></i>
                                break up of load
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>








    <div class="container-fluid py-5 position-relative">
        <div class="row">
            <div class="col-lg-2 d-flex align-items-center justify-content-center">
                <h5 class="text-center mb-4">Trusted by<br>renowned brands</h5>
            </div>
            <div class="col-lg-10">
                <div class="logo-carousel">
                    <div class="logo-track">
                        @foreach ($partners as $partner)
                            
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
                            <a href="/calculator" class="btn btn-primary btn-lg px-4 py-3 rounded-pill glow-on-hover">
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
                                <div class="screen-content" style="background-image: url('frontend/images/mobiles.png');">
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
            margin-top: 32px;
            width: 90%;
            padding-bottom: 200%;
            /* background: #f1f1f1;
                border-radius: 40px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                border: 10px solid #1e293b; */
        }

        .iphone-mockup .screen {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 10px;
            bottom: 50px;
            border-radius: 30px;
            overflow: hidden;
            /* background: #000; */
        }

        .iphone-mockup .screen-content {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        /*
            .iphone-mockup .home-button {
                position: absolute;
                bottom: 15px;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 5px;
                background: #1e293b;
                border-radius: 5px;
            } */

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





    <section class="py-6 py-lg-7  mb-5 mt-4">
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
                            <source src="{{ asset('frontend/images/landscape.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Play Button with Pulse Animation -->
                        <button
                            class="btn btn-warning rounded-circle position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center shadow"
                            style="width: 80px; height: 80px; z-index: 3; border: none;" onclick="showVideoModal()">
                            <i class="bi bi-play-fill fs-3 text-white" style="margin-left: 4px;"></i>
                            <span
                                class="position-absolute top-0 start-0 w-100 h-100 rounded-circle bg-warning opacity-75 animate-pulse"
                                style="z-index: -1;"></span>
                        </button>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col-lg-6 ps-lg-5 mt-5 mb-5">
                    <h3 class="fw-bold mb-3">Leading the Renewable Energy Revolution</h3>
                    <div class="pe-lg-5">
                        <p class="text-muted mb-4 fs-lg">
                            CF offers a comprehensive range of products and services designed to tackle the energy crisis
                            head-on:
                            Energy Management: Optimize energy consumption with our advanced energy management systems that
                            provide real-time monitoring, analytics, and control.
                            Sustainable Development: Partner with us to develop sustainable infrastructure projects that
                            balance economic growth with environmental stewardship.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
   <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" onclick="closeVideoModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <video id="modalVideo" class="w-100" controls autoplay>
                    <source src="{{asset('frontend/images/landscape.mp4')}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div> 
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-white" onclick="closeVideoModal()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    @if (isset($settings) && $settings->video_url)
                        @if (str_contains($settings->video_url, 'youtube.com') || str_contains($settings->video_url, 'youtu.be'))
                            <!-- YouTube Embed -->
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $settings->video_url }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <!-- Regular Video -->
                            <video id="modalVideo" class="w-100" controls autoplay>
                                <source src="{{ $settings->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @else
                        <div class="alert alert-info">No video URL has been set in settings.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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

        /* Custom modal styling */
        .modal-content {
            background: transparent;
        }

        .btn-close-white {
            filter: invert(1) grayscale(90%) brightness(200%);
        }
    </style>

    <script>
        function showVideoModal() {
            const modal = new bootstrap.Modal(document.getElementById('videoModal'));
            modal.show();
            document.getElementById('modalVideo').play();
        }

        function closeVideoModal() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('videoModal'));
            document.getElementById('modalVideo').pause();
            modal.hide();
        }

        // Close modal when clicking outside the video
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });
    </script>











    <script>
        /* Scroll observer */
        window.addEventListener('scroll', function() {
            document.querySelectorAll('.zoom-scroll').forEach(function(el) {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 100) {
                    el.classList.add('visible');
                }
            });
        });
    </script>
@endsection
