@extends('frontend.layout.layout')



@section('content')

      


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


    <!-- History Section with Decorative Image -->
    <section data-aos="fade-up"
        style="background-color: #f9fbfd; padding: 50px 10%; display: flex; flex-direction: column; gap: 60px; position: relative;">

        <!-- Decorative background images -->
        <img src="{{ asset('frontend/images/bg.png') }}" alt="Decorative Background"
            style="
            position: absolute;
            right: 1px;
            bottom: 770px;
            height: 540px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         "
            data-aos="fade-right" data-aos-delay="100">

        <img src="{{ asset('frontend/images/dotted.png') }}" alt="Decorative Background"
            style="
            position: absolute;
            left: 0;
            bottom: 1350px;
            height: 220px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         "
            data-aos="fade-left" data-aos-delay="200">



            
        <div class="mt-2" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right"
            data-aos-delay="100">
            <!-- Left Icon -->
            <div style="flex: 0 0 auto;">
                <img src="{{ asset('frontend/images/Picture19.png') }}" alt="Icon"
                    style="width: 100px; margin-right:30px">
            </div>
            <!-- Text -->
            <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
                <h2 style="font-weight: bold;">METERING</h2>
                <p>
                   Recording the electricity consumed by a circuit..
                </p>
            </div>
        </div>

        <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-left"
            data-aos-delay="200">
            <div style="flex: 0 0 auto;">
                <img src="{{ asset('frontend/images/Picture20.png') }}" alt="Icon"
                    style="width: 100px; margin-right:30px">
            </div>
            <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
                <h2 style="font-weight: bold;">MEASUREMENT</h2>
                <p>
                    Measuring electrical values (current, voltage, power, harmonic distortion, etc or analogue values
(temperature) to check the installation is working properly.

                </p>
            </div>
        </div>

        <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-right"
            data-aos-delay="300">
            <div style="flex: 0 0 auto;">
                <img src="{{ asset('frontend/images/Picture21.png') }}" alt="Icon"
                    style="width: 100px; margin-right:30px">
            </div>
            <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
                <h2 style="font-weight: bold;">SIGNALLING</h2>
                <p>Checking locally (LEDs, display unit, touch screen, etc) or remotely (LEDs, display unit, PLC,
PC, tablet, smart
phone, etc): the on/off status of one or more devices and/or circuits any faults such as circuit breaker
tripping, min. or max. threshold overrun, etc
</p>
            </div>
        </div>

        <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-left"
            data-aos-delay="400">
            <div style="flex: 0 0 auto;">
                <img src="{{ asset('frontend/images/Picture22.png') }}" alt="Icon"
                    style="width: 100px; margin-right:30px">
            </div>
            <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
                <h2 style="font-weight: bold;">CONTROL</h2>
                <ul>
                    <li>Energy Management: Optimize energy consumption with our advanced energy management systems that
                        provide real-time monitoring, analytics, and control.</li>
                    <li>Sustainable Development: Partner with us to develop sustainable infrastructure projects that balance
                        economic growth with environmental stewardship.</li>
                </ul>
            </div>
        </div>
        <div class="mt-3" style="display: flex; align-items: center; flex-wrap: wrap; gap: 20px;" data-aos="fade-left"
            data-aos-delay="400">
            <div style="flex: 0 0 auto;">
                <img src="{{ asset('frontend/images/Picture23.png') }}" alt="Icon"
                    style="width: 100px; margin-right:30px">
            </div>
            <div style="flex: 1; min-width: 250px; padding: 0 20px; max-width: 760px;">
                <h2 style="font-weight: bold;">SUPERVISION</h2>
             <div style=" max-width:700px; margin:2rem auto; line-height:1.6; color:#2c3e50;">
  <p style="margin-bottom:1rem;">
    Supervision is a 
    <span style="color: blueviolet; font-weight:600; background:rgba(138,43,226,0.1); padding:0 0.2rem; border-radius:4px;">
      computerised control and monitoring
    </span> 
    technique applied to industrial and electrical processes. In the measurement field, it serves as an umbrella term for functions such as display, monitoring, control, parameter setting, and programming.
  </p>
  <p style="margin-bottom:0;">
    A supervision system acquires data—measurements, alarms, status feedback—and integrates process control and remote operation (e.g., circuit-breaker control). It continuously oversees the entire electrical network, ensuring equipment safety, rapid intervention, and uninterrupted service. The collected data on operating status, power distribution, and consumption can then be analyzed to implement effective energy-management solutions.
  </p>
</div>

            </div>
        </div>

    </section>
@endsection
