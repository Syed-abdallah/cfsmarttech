
@extends('frontend.layout.layout')



@section('content')

<!-- Hero Section -->
<section data-aos="fade-in" style="background-color: rgb(249, 251, 253); height: 85vh; position: relative; overflow: hidden;">
    <img src="{{ asset('frontend/images/hisback.jpg') }}" 
         alt="Smart Products" 
         style="height: 85vh; width: 100%; object-fit: cover;" data-aos="zoom-out">

    <div data-aos="fade-up" data-aos-delay="200"
         style="
        position: absolute;
        bottom: 20px;
        left: 30px;
        color: rgb(255, 255, 255);
        font-size: 5.2rem;
        line-height: 1.1;
        font-weight: bold;
        font-family:'Courier New', Courier, monospace;
    ">
        <div>Our</div>
        <div>Goal</div>
    </div>
</section>

<!-- History Section with Decorative Image -->
<section data-aos="fade-up" style="background-color: #f9fbfd; padding: 50px 10%; display: flex; flex-direction: column; gap: 60px; position: relative;">
    
    <!-- Decorative background images -->
    <img src="{{ asset('frontend/images/bgimage1.png') }}" 
         alt="Decorative Background" 
         style="
            position: absolute;
            left: 0;
            bottom: 0;
            height: 220px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         " data-aos="fade-right" data-aos-delay="100">

    <img src="{{ asset('frontend/images/dotted.png') }}" 
         alt="Decorative Background" 
         style="
            position: absolute;
            right: 0;
            bottom: 900px;
            height: 220px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         " data-aos="fade-right" data-aos-delay="200">

    <img src="{{ asset('frontend/images/mobiles.png') }}" 
         alt="Decorative Background" 
         style="
            position: absolute;
            right: 20px;
            bottom: 500px;
            width: 200px;
            height: 380px;
            z-index: 1;
            pointer-events: none;
         " data-aos="zoom-in" data-aos-delay="300">

    <!-- About / Vision / Mission Blocks -->
    <div class="mt-5" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="100">
        <!-- Left Icon -->
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture17.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <!-- Text -->
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">ABOUT US</h2>
            <p>
               In the face of growing energy demands and environmental challenges, CF SMART TECHNOLOGIES emerges as a beacon of hope and innovation. Founded by A. AZIZ, our mission is to address the REGIONAL energy crisis with cutting-edge solutions that promote sustainability, efficiency, and resilience.
            </p>
        </div>
    </div>

    <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="200">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture15.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">OUR VISION</h2>
            <p>
                At CF, we envision a world where energy is accessible, affordable, and sustainable for all. We are committed to developing technologies and strategies that reduce dependence on non-renewable resources and minimize environmental impact.
            </p>
        </div>
    </div>

    <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="300">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture16.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">OUR MISSION</h2>
            <ul>
                <li>Enhance energy efficiency and conservation.</li>
                <li>Promote the adoption of renewable energy sources.</li>
                <li>Develop smart grid technologies for reliable and resilient power distribution.</li>
                <li>Educate and empower individuals and organizations to make informed energy choices.</li>
            </ul>
        </div>
    </div>

    <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="400">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture18.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">OUR PRODUCTS &amp; SERVICES</h2>
            <ul>
                <li>Energy Management: Optimize energy consumption with our advanced energy management systems that provide real-time monitoring, analytics, and control.</li>
                <li>Sustainable Development: Partner with us to develop sustainable infrastructure projects that balance economic growth with environmental stewardship.</li>
            </ul>
        </div>
    </div>

</section>

@endsection

