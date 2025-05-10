@extends('frontend.layout.layout')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }
    
    .director-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
    }
    
    .signature {
        font-family: 'Dancing Script', cursive !important;
    }
    
    .divider-line {
        height: 2px;
        background: linear-gradient(90deg, rgba(13,110,253,0.1) 0%, rgba(13,110,253,1) 50%, rgba(13,110,253,0.1) 100%);
    }
    
    .director-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .director-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .img-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
    }
</style>

    <section class="hero-section" style="margin-top: 140px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold text-primary hero-title">Welcome to Fico Hi-Tech</h1>
            <p class="lead fs-4 text-muted">Leading edge operations with a vision for tomorrow</p>
            <div class="d-flex justify-content-center mt-3">
                <div style="width: 80px; height: 4px; background: #0d6efd;" class="rounded"></div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row align-items-center g-5">
            <!-- Image Column -->
            <div class="col-lg-5">
                <div class="position-relative director-card">
                    <img src="{{asset('frontend/images/zia-saab.jpg')}}" alt="MD Zia-ul-Islam" 
                         class="img-fluid rounded-3 shadow-lg" 
                         style="width: 100%; max-height: 550px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 px-3 py-2 rounded-end img-overlay">
                        <h5 class="mb-0 text-white">Mr. Zia-ul-Islam</h5>
                        <small class="text-white-50">Managing Director</small>
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-7">
                <h2 class="mb-4 fw-bold text-primary director-title">Message from MD – Mr. ZIA-UL-ISLAM</h2>
                <div class="welcome-message" style="font-size: 1.1rem; line-height: 1.8;">
                    <p class="mb-4">It gives me great pleasure to welcome you to the Fico hi-tech (pvt) limited website. These are exciting yet challenging times at Fico hi-tech (pvt) limited and I hope our portal creates an opportunity for our valued visitors around the world and in Pakistan to learn about our leading edge operations.</p>
                    
                    <p class="mb-4">We are a company built on a skilled team with collective wisdom & has a defined construction parameters in a new way to give a fresh look to our tomorrow. This website is part of the external manifestation of our commitment to transparency and open communications to all our stakeholders interested in our activities.</p>
                    
                    <p class="mb-4">Thank you for taking time to visit the Fico hi-tech (pvt) limited website and I wholeheartedly welcome any constructive feedback you may have.</p>
                    
                    <div class="signature mt-5" style="font-size: 2.5rem; color: #0d6efd;">Zia-ul-Islam</div>
                    <div class="text-muted">Managing Director</div>
                    <div class="text-muted">Fico Hi-Tech (Pvt) Limited</div>
                </div>
            </div>
        </div>
    </main>
    
    <div class="footer-divider my-5 py-3 position-relative">
        <div class="divider-line"></div>
    </div>
    
    <section class="container my-5 py-4">
        <div class="row align-items-center g-5">
            <!-- Content Column -->
            <div class="col-lg-7 order-lg-1 order-2">
                <h4 class="mb-3 fw-bold text-primary director-title">MUHAMMAD TAHIR AZIZ <small class="text-muted">(OPERATIONS DIRECTOR)</small></h4>
                <h6 class="text-muted mb-3">Master of Engineering in Mechatronics & Robotics from University of Liverpool</h6>
                
                <div class="director-message" style="font-size: 0.95rem; line-height: 1.6;">
                    <p class="mb-2">WE, FICO HI-TECH MAINLY FOCUS ON PAKISTAN BUSINESS SECTOR ALONG WITH OTHER INTERNATIONAL SECTORS. AS WE ARE AIMING AT SLOW AND STEADY GROWTH, WE ARE PIONEERS OF TRANSMISSION LINE HARDWARE EQUIPMENTS & LOW VOLTAGE SWITCHGEAR ACCESSORIES. WE HAVE ALWAYS BEEN DEVOTED AND DEDICATED IN WHAT WE DO.</p>
                    
                    <p class="mb-2">WE ARE MEANT TO INFUSE THE TEAM SPIRIT AMONGST ALL OUR FELLOW COLLEAGUES TO ATTAIN OUR GOAL AND SUCCESS. FICO HI-TECH (PVT) LIMITED HAS MANY PLANS OF GLOBAL EXPANSION FOR THE NEAR FUTURE, AND SETTING OUT TO BECOME MORE EFFECTIVE, MORE AWARE OF MARKET ENVIRONMENT, MORE RESPONSIVE TO CLIENT NEEDS AND BETTER AT WHAT WE OFFER TODAY, TOMORROW AND ALWAYS.</p>
                    
                    <p class="mb-2">THOSE CORE VALUES REFLECT OUR COMMITMENT TO OUR CUSTOMERS AND CLIENTS. AS PER OUR VALUES WE STRONGLY BELIEVE IN RESPECT, INTEGRITY, ACCOUNTABILITY, AND PROTECTING THOSE THINGS THAT WE VALUE AT OUR INDUSTRY.</p>
                    
                    <p class="mb-3">I AM VERY PROUD TO HAVE WORKED ALONGSIDE SO MANY SKILLED AND DEDICATED TEAM OF EMPLOYEE THROUGHOUT MY JOURNEY TILL DATE. OUR PLAN IS TO REFLECT, CONTINUE AND EVOLVE WITH PROFESSIONALISM AND ENSURE HIGH-QUALITY SERVICES THAT WILL MEET THE NEEDS OF ALL OUR CUSTOMERS AND CLIENTS FOR YEARS TO COME.</p>
                    
                    <div class="signature mt-3" style="font-size: 2rem; color: #0d6efd;">Muhammad Tahir Aziz</div>
                    <div class="text-muted small">Operations Director</div>
                    <div class="text-muted small">Fico Hi-Tech (Pvt) Limited</div>
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="position-relative director-card">
                    <img src="{{asset('frontend/images/tariq-aziz.jpg')}}" alt="Operations Director Muhammad Tahir Aziz" 
                         class="img-fluid rounded-3 shadow" 
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 px-3 py-1 rounded-end img-overlay">
                        <h6 class="mb-0 text-white">Muhammad Tahir Aziz</h6>
                        <small class="text-white-50">Operations Director</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="footer-divider my-5 py-3 position-relative">
        <div class="divider-line"></div>
    </div>
    
    <!-- Sales & Marketing Director Section -->
    <section class="container my-5 py-4">
        <div class="row align-items-center g-5">
            <!-- Image Column -->
            <div class="col-lg-5">
                <div class="position-relative director-card">
                    <img src="{{asset('frontend/images/abdul-aziz.jpeg')}}" alt="Director Abdul Aziz" 
                         class="img-fluid rounded-3 shadow" 
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 px-3 py-1 rounded-end img-overlay">
                        <h6 class="mb-0 text-white">Abdul Aziz</h6>
                        <small class="text-white-50">Director (Sales & Marketing)</small>
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-7">
                <h3 class="mb-3 fw-bold text-primary director-title">ABDUL AZIZ <small class="text-muted">Director (Sales & Marketing)</small></h3>
                
                <div class="qualifications mb-3">
                    <h6 class="text-muted mb-1">BSc (Elec Engg) UCP</h6>
                    <h6 class="text-muted">MS (Organisational Management) University of Liverpool</h6>
                </div>
                
                <div class="director-message" style="font-size: 0.95rem; line-height: 1.6;">
                    <p class="mb-2">FICO HI-TECH (PVT) LIMITED. THE THEME OF "TRANSFORM FOR THE FUTURE," WE ARE STRIVING TO BECOME A MULTI-BUSINESS ENTERPRISE WITH RESILIENT DNA AND A TRACK RECORD OF SUCCESS THAT CONTINUALLY EVOLVES TO DELIVER PROFITABLE GROWTH BY MEETING THE CHALLENGES OF CHANGING TIMES AND ENVIRONMENTS, THROUGH THREE TRANSFORMATIONS: BUSINESS TRANSFORMATION, OPERATIONAL TRANSFORMATION AND TALENT TRANSFORMATION.</p>
                    
                    <p class="mb-2">FOR "BUSINESS TRANSFORMATION," WE ARE PROCEEDING AS PLANNED WITH RESOURCE SHIFT AND PRIOR INVESTMENTS TO GROWTH BUSINESSES. THE DORADO BUSINESS IS RECOGNIZED WELL, AND WE WILL TRANSFORM IT INTO THE GROUP'S CORE BUSINESS BY DEMONSTRATING THE SYNERGY.</p>
                    
                    <p class="mb-2">TO ACHIEVE "OPERATIONAL TRANSFORMATION," WE WILL STRIVE FURTHER TO ESTABLISH A SYSTEM MANUFACTURING THE EFFICIENCY IN THE ENTIRE MANUFACTURING PROCESS INCLUDING DEVELOPMENT, PRODUCTION, QUALITY CONTROL, AND PROCUREMENT. WITH A FOCUS ON STREAMLINING DEVELOPMENT PROCESS BY INTRODUCING A NEW RESUME SUPPORT SYSTEM.</p>
                    
                    <p class="mb-2">TO ADVANCE "TALENT TRANSFORMATION," WE WILL CREATE SYSTEMS AND ENVIRONMENTS WHERE MORE EXPERIENCED TALENTS CAN EXERCISE THEIR ABILITIES AND DEVELOP SUCCESSION PLANS AND YOUTH ADVANCEMENT PROGRAMS. WE WILL ALSO PUT MORE EFFORT INTO NURTURING THE NEXT GENERATION OF MANAGERIAL TALENTS AND GLOBAL HUMAN RESOURCES AS WELL AS GENERATIONAL CHANGE.</p>
                    
                    <p class="mb-3">AS FOR CORPORATE GOVERNANCE, WE PLACE IMPORTANCE ON ENHANCING CORPORATE VALUE IN THE LONG TERM BY OPTIMIZING MANAGERIAL RESOURCES AND CREATING CUSTOMER VALUE. AS WELL AS ESTABLISHING A LONG-TERM TRUSTED RELATIONSHIP BY IMPROVING OUR CORPORATE TRANSPARENCY.</p>
                    
                    <p class="mb-3">TRANSFORMING FOR THE FUTURE IS ESSENTIAL FOR FICO HI-TECH (PVT) LIMITED TO REMAIN A COMPANY THAT CUSTOMERS CAN TRUST, EMPLOYEES CAN BE PROUD TO BE PART OF, AND ONE THAT LEADS TO A LONG SUCCESSFUL FUTURE. TO BECOME A STRONG GROUP WHICH CAN SURVIVE THROUGH ANY CHALLENGING ENVIRONMENT, WE ARE DETERMINED TO TRANSFORM INTO A BUSINESS STRUCTURE TAKING ON CHALLENGES MORE THAN EVER.</p>
                    
                    <div class="signature mt-3" style="font-size: 2rem; color: #0d6efd;">Abdul Aziz</div>
                    <div class="text-muted small">Director (Sales & Marketing)</div>
                    <div class="text-muted small">Fico Hi-Tech (Pvt) Limited</div>
                </div>
            </div>
        </div>
    </section>
@endsection