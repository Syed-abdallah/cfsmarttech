@extends('frontend.layout.layout')



@section('content')
    <style>
        .step-item {
            position: relative;
            margin-bottom: 1rem;
            padding: 1rem 1rem 1rem 4rem;
            border-radius: 0.5rem;
            color: #fff;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s ease-out forwards;
        }

        /* staggered delays */
        .step1-bg {
            animation-delay: 0.1s;
        }

        .step2-bg {
            animation-delay: 0.2s;
        }

        .step3-bg {
            animation-delay: 0.3s;
        }

        .step4-bg {
            animation-delay: 0.4s;
        }

        .step5-bg {
            animation-delay: 0.5s;
        }

        .step6-bg {
            animation-delay: 0.6s;
        }

        .step7-bg {
            animation-delay: 0.7s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-circle {
            position: absolute;
            top: 50%;
            left: -1.5rem;
            transform: translateY(-50%);
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #000;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.15);
        }

        .step1-bg {
            background-color: #8bc540;
        }

        .step2-bg {
            background-color: #4b4f6f;
        }

        .step3-bg {
            background-color: #00cfe8;
        }

        .step4-bg {
            background-color: #ffb92d;
        }

        .step5-bg {
            background-color: #fb6467;
        }

        .step6-bg {
            background-color: #ffc107;
        }

        .step7-bg {
            background-color: #00a7af;
        }

        /* Icon animation */
        .step-item i {
            transition: all 0.3s ease;
        }

        .step1-bg i {
            animation: iconMove 1s ease 0.8s infinite alternate;
        }

        .step2-bg i {
            animation: iconMove 1s ease 0.9s infinite alternate;
        }

        .step3-bg i {
            animation: iconMove 1s ease 1.0s infinite alternate;
        }

        .step4-bg i {
            animation: iconMove 1s ease 1.1s infinite alternate;
        }

        .step5-bg i {
            animation: iconMove 1s ease 1.2s infinite alternate;
        }

        .step6-bg i {
            animation: iconMove 1s ease 1.3s infinite alternate;
        }

        .step7-bg i {
            animation: iconMove 1s ease 1.4s infinite alternate;
        }

        @keyframes iconMove {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateX(-2px) rotate(4deg);
            }

            50% {
                transform: translateY(2px) rotate(-5deg);
            }

            100% {
                transform: translateX(-2px) rotate(3deg);
            }
        }
    </style>
    <section
        style="background-color: #f9fbfd; height: 65vh; display: flex; flex-direction: column; align-items: center; justify-content: center;">

        <!-- Static title -->
        <b><h1 class="display-3 text-dark mb-1 mt-3">ENERGY AUDIT</h1></b>

        <!-- Carousel for only the sub-headings -->
        {{-- <div id="heroCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="2000">
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
        </div> --}}
    </section>


    <!-- History Section with Decorative Image -->
    <section data-aos="fade-up"
        style="background-color: #f9fbfd; padding: 50px 10%; display: flex; flex-direction: column; gap: 60px; position: relative;">

         <img src="{{ asset('frontend/images/bgimage1.png') }}" 
         alt="Decorative Background" 
         style="position: absolute; left: 0; bottom: 0; height: 220px; opacity: 0.1; z-index: 1; pointer-events: none;" data-aos="fade-right">

        <img src="{{ asset('frontend/images/picture26.png') }}" alt="Decorative Background"
            style="
            position: absolute;
            left: 10;
            bottom: 800px;
            height: 240px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         "
            data-aos="fade-right" data-aos-delay="200">
        <img src="{{ asset('frontend/images/gear.png') }}" alt="Decorative Background"
            style="
            position: absolute;
            right: 0;
            bottom: 350px;
            height: 550px;
            opacity: 0.1;
            z-index: 1;
            pointer-events: none;
         "
            data-aos="fade-right" data-aos-delay="200">




<div class="row">


        <div class="col-lg-6">

            <div class="step-item step1-bg">
                <div class="step-circle">01</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-collection fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Data Collection and Break Up</div>
                </div>
            </div>

            <div class="step-item step2-bg">
                <div class="step-circle">02</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-clipboard-check fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Each Load Health Inspection</div>
                </div>
            </div>

            <div class="step-item step3-bg">
                <div class="step-circle">03</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-speedometer2 fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Efficiency Report Through AI per Load</div>
                </div>
            </div>

            <div class="step-item step4-bg">
                <div class="step-circle">04</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-search fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Trace Root Cause of Energy Loads</div>
                </div>
            </div>

            <div class="step-item step5-bg">
                <div class="step-circle">05</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-tools fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Perform the Corrective Action</div>
                </div>
            </div>

            <div class="step-item step6-bg">
                <div class="step-circle">06</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-graph-up fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">Control and Analyse Load Data Through AI</div>
                </div>
            </div>

            <div class="step-item step7-bg">
                <div class="step-circle">07</div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-cash-stack fs-2 me-3"></i>
                    <div class="fw-bold text-uppercase">20% to 75% Reduction in Bills</div>
                </div>
            </div>

        </div>
{{-- <div class="col-lg-6">
  <div
    style="
      background-color: #f0f4f8;
      border-left: 4px solid #0d6efd;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 0.5rem;
      padding: 1.25rem;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    "
    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 18px rgba(0, 0, 0, 0.08)';"
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.05)';"
  >
    <div style="display: flex; align-items: flex-start; gap: 1rem;">
      <div>
        <!-- Bootstrap Icon (swap as needed) -->
        <i class="bi bi-lightning-charge-fill" style="font-size: 1.5rem; color: #0d6efd;"></i>
      </div>
      <div>
        <h5 style="margin: 0 0 0.5rem; color: #0d6efd;">Energy Audit Flow</h5>
        <p style="margin: 0; color: #6c757d; line-height: 1.4;">
          CF has been performing an energy audit with a thorough evaluation of a building or facility’s energy consumption, aimed at identifying opportunities to improve energy efficiency, reduce energy consumption, and lower costs. Here’s a quick flowchart.
        </p>
      </div>
    </div>
  </div>
</div> --}}

<div class="col-lg-6">
  <div
    id="info-box"
    style="
      background-color: #f0f4f8;
      border-left: 4px solid #0d6efd;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-radius: 0.5rem;
      padding: 1.25rem;
      overflow: hidden;
      min-height: 120px;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    "
    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 6px 18px rgba(0, 0, 0, 0.08)';"
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.05)';"
  >
    <div style="display: flex; align-items: flex-start; gap: 1rem;">
      <i class="bi bi-lightning-charge-fill" style="font-size: 1.5rem; color: #0d6efd;"></i>
      <div>
        <h5 id="typed-title" style="margin: 0 0 0.5rem; color: #0d6efd;"></h5>
        <p id="typed-body" style="margin: 0; color: #6c757d; line-height: 1.4;"></p>
      </div>
    </div>
  </div>
</div>

<script>
  // Text to type
  const titleText = 'Energy Audit Flow';
  const bodyText = 'CF has been performing an energy audit with a thorough evaluation of a building or facility’s energy consumption, aimed at identifying opportunities to improve energy efficiency, reduce energy consumption, and lower costs. Here’s a quick flowchart.';
  
  // Elements
  const titleEl = document.getElementById('typed-title');
  const bodyEl  = document.getElementById('typed-body');
  
  // Typewriter function
  function typeWriter(text, el, delay = 50, callback) {
    let i = 0;
    function typeChar() {
      if (i < text.length) {
        el.textContent += text.charAt(i++);
        setTimeout(typeChar, delay);
      } else if (callback) {
        callback();
      }
    }
    typeChar();
  }
  
  // On page load, start typing title, then body
  window.addEventListener('DOMContentLoaded', () => {
    typeWriter(titleText, titleEl, 80, () => {
      // small pause before body
      setTimeout(() => {
        typeWriter(bodyText, bodyEl, 30);
      }, 500);
    });
  });
</script>


        </div>
    </section>
@endsection
