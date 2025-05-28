@extends('frontend.layout.layout')


@section('content')

<style>
    .sketch-rule {
      width: 100%;
      height: 0.4em;
      border: 0;
      background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='none' viewBox='0 0 119 6'%3E%3Cpath d='M119 3.8c-60 2.5-33.5-7-119 0' fill='none' stroke='%231d2d35' stroke-width='2'/%3E%3C/svg%3E") center/5em 100% repeat-x;
    }

    /* Slide-in animation triggered on load */
    .animate-slide-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
    }
</style>

<!-- Hero Section -->
<section data-aos="fade-in" class="position-relative overflow-hidden" style="background-color: rgb(249, 251, 253); height: 85vh;">
    <img 
        src="{{ asset('frontend/images/hisback.jpg') }}" 
        alt="Smart Products" 
        class="w-100 h-100 object-fit-cover" 
        data-aos="zoom-out"
        style="object-fit: cover;"
    >

    <div 
        data-aos="fade-up" 
        data-aos-delay="200"
        class="position-absolute text-white fw-bold"
        style="
            bottom: 5%;
            left: 5%;
            font-family: 'Courier New', Courier, monospace;
            line-height: 1.1;
        "
    >
        <div class="display-3 d-none d-md-block">Our</div>
        <div class="display-3 d-none d-md-block">History</div>
        
        <div class="h2 d-block d-md-none">Our</div>
        <div class="h2 d-block d-md-none">History</div>
    </div>
</section>


<!-- History Section with Decorative Image -->
<section data-aos="fade-up" style="background-color: #f9fbfd; padding: 50px 10%; display: flex; flex-direction: column; gap: 60px; position: relative;">
    <!-- Decorative background images -->
    <img src="{{ asset('frontend/images/bgimage1.png') }}" 
         alt="Decorative Background" 
         style="position: absolute; left: 0; bottom: 0; height: 220px; opacity: 0.1; z-index: 1; pointer-events: none;" data-aos="fade-right">

    <img src="{{ asset('frontend/images/dotted.png') }}" 
         alt="Decorative Background" 
         style="position: absolute; right: 0; bottom: 550px; height: 220px; opacity: 0.1; z-index: 1; pointer-events: none;" data-aos="fade-left" data-aos-delay="100">

    <!-- Founder Block -->
    <div class="mt-5" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="200">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/late.png') }}" alt="Founder" style="width: 150px;">
        </div>
        <div style="flex: 0 0 auto; height: 150px; border-left: 2px solid #000;"></div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 660px;">
            <h2 style="font-weight: bold;">FOUNDER OF CLIMAX</h2>
            <p><strong>CH. ABDUL AZIZ (LATE)</strong>, the visionary founder of CLIMAX ENGINEERING COMPANY, founded in 1940, has left an indelible mark on the engineering industry in our country. His pioneering spirit, innovative mindset, and unwavering dedication have shaped the landscape of engineering and inspired countless professionals.</p>
        </div>
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/climax2.png') }}" alt="Climax Logo" style="width: 150px;">
        </div>
    </div>

    <!-- Separator -->
    <div class="container" data-aos="zoom-in" data-aos-delay="300">
      <div class="row justify-content-center">
        <div class="col-10 col-md-6 text-center">
          <hr class="sketch-rule animate-slide-in" onload="this.classList.add('animate-slide-in')">
        </div>
      </div>
    </div>

    <!-- Chairman Block -->
    <div class="mb-5" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-left" data-aos-delay="400">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/ziasaab.png') }}" alt="Chairman" style="width: 155px;">
        </div>
        <div style="flex: 0 0 auto; height: 150px; border-left: 2px solid #000;"></div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 660px;">
            <h2 style="font-weight: bold;">CHAIRMAN<br>FICO HI-TECH (PVT) LTD</h2>
            <p><strong>MR. Zia-ul-Islam</strong> continues the journey set forth by the founder of CLIMAX and is dedicated to his vision of innovation, excellence, and integrity. By building on the solid foundation, he established FICO HI-TECH.</p>
        </div>
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture1.png') }}" alt="FICO Logo" style="width: 150px;">
        </div>
    </div>
</section>

@endsection

