
@extends('frontend.layout.layout')



@section('content')

<!-- Hero Section -->
<section data-aos="fade-in" style="background-color: rgb(249, 251, 253); height: 85vh; position: relative; overflow: hidden;">
    <img src="{{ asset('frontend/images/picture27.jpg') }}" 
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
        <div>Case</div>
        <div>Study</div>
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
            left: 0;
            bottom: 740px;
            height: 220px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
            " data-aos="fade-left" data-aos-delay="200">

<img src="{{ asset('frontend/images/giff.gif') }}" 
alt="Decorative Background" 
style="
            position: absolute;
            right: 25px;
            bottom: 0px;
            width: 550px;
            opacity: 0.2;
            height: 380px;
            z-index: 1;
            pointer-events: none;
         " data-aos="zoom-in" data-aos-delay="300">

    <!-- About / Vision / Mission Blocks -->
    <div class="mt-5" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="100">
        <!-- Left Icon -->
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture28.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <!-- Text -->
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">PROBLEMS</h2>
            <p>
UNION Automobile wants to monitor and minimize their Energy Consumption which is costing them to pay the Extra amount in their Electric bill. They want to monitor their Energy Consumption separately for each production line so that they could compare this production with energy consumption. They were not able to monitor their Maximum Demand which is causing them to pay heavy penalties on Maximum Demand to Electricity Board. They were not getting real time alerts of Voltage, Power Factor, Maximum Demandand Harmonics, due to which they were facing higher maintenance of their Electrical and Electronics components.            </p>
        </div>
    </div>

    <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-left" data-aos-delay="200">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture29.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">SOLUTION</h2>
            <p>
To get the real time Energy and Power quality data from all major loads and Main Incomer, CF installed Energy Management Systems having 1 Smart Meters on Main Incomer and 8 Smart Meters on their 8 outgoings
Now we were able to get the real time data from all loads and incomer.
            </p>
        </div>
    </div>

    <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right" data-aos-delay="300">
        <div style="flex: 0 0 auto;">
            <img src="{{ asset('frontend/images/Picture30.png') }}" alt="Icon" style="width: 100px; margin-right:30px">
        </div>
        <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
            <h2 style="font-weight: bold;">BANAFITS</h2>
          <p>UNION Auto now getting real time data of PF, Voltage, Harmonics, Maximum Demand and Energy from main Incomer and all outgoings. After getting real time reports and alerts on Maximum Demand they are able to get rid from penalties. After getting real time reports and alerts on PF they are able to maintain the PF 0.99. Now they are getting real time Harmonics data which is helping them to reduce them Maintenance cost of Electronics components. After getting Energy Data reports they are able to compare that with their production and finding the cost of energy used per product.</p>
        </div>
    </div>

   

</section>

@endsection

