@extends('frontend.layout.layout')



@section('content')
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --text-color: #333;
            --light-bg: #f8f9fa;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .hub-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .hub-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 0;
            padding-bottom: 100%;
            /* 1:1 aspect */
            margin: 0 auto;
        }

        .hub-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* ==== UPDATED: draw the icon as a background of the circle ==== */
        .hub-center {
            position: absolute;
            top: 55%;
            left: 60%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 90%;
            border-radius: 50%;

            /* 1) Icon image centered, 2) gradient behind it */
           background: url('frontend/images/dotted.png') no-repeat center center;
            
            background-size: 100% 100%, cover;

            box-shadow: var(--shadow);
            border: 6px solid white;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .hub-center:hover {
            transform: translate(-50%, -50%) scale(1.05);
        }

        /* hide the old <img> if you left it in place */
        .hub-center-img {
            display: none;
        }

        /* ==== icon wrappers around the circle ==== */
        .hub-icon {
            position: absolute;
            width: 20%;
            text-align: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-color);
            transition: all 0.3s ease;
            z-index: 5;
        }

        .hub-icon:hover {
            transform: scale(1.15);
            z-index: 15;
        }

        .hub-icon .icon-circle {
            width: 60%;
            aspect-ratio: 1/1;
            margin: 0 auto 5px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            border: 3px solid #fff;
        }

        .hub-icon img {
            width: 60%;
            height: auto;
        }

        .icon-top {
            top: 5%;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .icon-top-right {
            top: 18%;
            left: 82%;
            transform: translate(-50%, 0);
        }

        .icon-right {
            top: 50%;
            left: 95%;
            transform: translate(-100%, -50%);
        }

        .icon-bot-right {
            top: 82%;
            left: 82%;
            transform: translate(-50%, -100%);
        }

        .icon-bot {
            top: 95%;
            left: 50%;
            transform: translate(-50%, -100%);
        }

        .icon-bot-left {
            top: 82%;
            left: 18%;
            transform: translate(-50%, -100%);
        }

        .icon-left {
            top: 50%;
            left: 5%;
            transform: translate(0, -50%);
        }

        .icon-top-left {
            top: 18%;
            left: 18%;
            transform: translate(-50%, 0);
        }

        /* optional floating animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hub-icon:nth-child(odd) {
            animation: float 3s ease-in-out infinite;
        }

        .hub-icon:nth-child(even) {
            animation: float 3s ease-in-out infinite 1.5s;
        }

        /* responsive tweaks */
        @media (max-width: 992px) {
            .hub-container {
                max-width: 400px;
            }

            .hub-icon {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 768px) {
            .hub-container {
                max-width: 350px;
            }

            .hub-icon {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 576px) {
            .hub-container {
                max-width: 300px;
            }

            .hub-icon {
                font-size: 0.6rem;
            }

            .info-card .card-body {
                font-size: 0.6rem;
                padding: 5px;
            }
        }
    </style>


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
    </div>

@endsection