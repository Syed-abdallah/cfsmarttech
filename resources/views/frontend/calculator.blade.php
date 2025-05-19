@extends('frontend.layout.layout')
@section('content')
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .option {
            border: none;
            border-radius: 0;
            padding: 20px 8px;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            color: #06101a;
            position: relative;
        }

        .option:hover {
            transform: translateY(-3px);
        }

        .option.selected {
            position: relative;
            background: linear-gradient(170deg, rgba(0, 0, 0, 0.15), rgba(255, 255, 255, 0.9));
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding-left: 25px;
        }

        .option.selected::before {
            content: "✓";
            position: absolute;
            right: 10px;
            top: 4px;
            font-size: 22px;
            color: #15ce1b;
            font-weight: bold;
        }

        .option::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #3498db;
            transition: all 0.3s ease;
        }

        .option:hover::after {
            width: 100%;
        }

        .option.selected::after {
            width: 100%;
            background: #1abc9c;
        }

        .option-grid .option strong {
            display: block;
            font-size: 18px;
            margin-bottom: 8px;
            color: #3498db;
        }

        .option-grid .option span {
            display: block;
            font-size: 14px;
            color: #b0b0b0;
            line-height: 1.5;
        }

        .other-input {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: none;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        @media (min-width: 768px) {
            .option-grid {
                gap: 80px;
            }
            
            .option {
                padding: 30px 8px;
                width: 200px;
            }
            
            .button-group {
                flex-wrap: nowrap;
            }
            
            #back-btn {
                margin-left: 260px;
            }

            #next-btn {
                margin-right: 260px;
            }

            #calculate-btn {
                margin-right: 260px;
            }
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .next-btn,
        .back-btn {
            border-radius: 30px;
            background-color: transparent;
            padding: 12px 25px;
            border: 2px solid #3498db;
            color: #3498db;
            cursor: pointer;
            margin: 5px 0;
            width: 100%;
        }

        .back-btn {
            border-color: #e0e0e0;
            color: #333;
        }

        .next-btn:hover,
        .back-btn:hover {
            opacity: 0.8;
        }

        .progress-container {
            width: 90%;
            height: 18px;
            background-color: #eceaea;
            border-radius: 4px;
            margin-bottom: 18px;
            border-radius: 100px;
            margin-top: 18px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 768px) {
            .progress-container {
                width: 50%;
                margin-left: 25%;
            }
            
            .next-btn,
            .back-btn {
                padding: 15px 45px;
                width: auto;
            }
        }

        .progress-bar {
            height: 100%;
            position: relative;
            background: linear-gradient(120deg, #eff9ff, #3672aa, #0f2b3b);
            border-radius: 12px;
            transition: width 0.5s ease-in-out, background 1s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress-percentage {
            text-align: center;
            font-size: 14px;
            color: white;
            font-weight: bold;
            pointer-events: none;
        }

        .hidden {
            display: none;
        }

        .result-container {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
        }

        .result-title {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .cost-display {
            font-family: Arial, sans-serif;
        }

        .cost-label {
            font-size: 14px;
            color: #333;
        }

        .cost-value {
            font-size: 28px;
            font-weight: bold;
            color: #000000;
            margin: 10px 0;
        }

        .price-range {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .price-box {
            padding: 8px 15px;
            background-color: #e8f4fc;
            border-radius: 5px;
            font-weight: 500;
            margin: 5px;
            font-size: 14px;
        }

        @media (min-width: 768px) {
            .price-range {
                gap: 20px;
            }
            
            .price-box {
                padding: 10px 20px;
                font-size: 16px;
            }
            
            .cost-value {
                font-size: 32px;
            }
        }

        .room-control {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 15px 0;
            padding: 15px;
            border-radius: 8px;
        }

        .room-name {
            font-weight: 500;
            font-size: 16px;
        }

        .room-counter {
            display: flex;
            align-items: center;
        }

        .counter-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3460db;
            color: white;
            border: none;
            font-size: 17px;
            cursor: pointer;
            display: flex;
            align-items: center;
            margin: 5px;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .counter-btn {
                width: 50px;
                height: 50px;
                margin: 10px;
            }
        }

        .counter-value {
            min-width: 30px;
            text-align: center;
            font-weight: 1200;
        }

        .room-grid {
            margin-top: 30px;
        }

        .yes-no-options {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .yes-no-btn {
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            margin: 5px;
        }

        @media (min-width: 768px) {
            .yes-no-options {
                gap: 20px;
            }
            
            .yes-no-btn {
                padding: 12px 30px;
                margin: 0;
            }
        }

        .yes-no-btn:hover {
            border-color: #3498db;
        }

        .yes-no-btn.selected {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        .geyser-counter {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .geyser-counter-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
        }

        @media (min-width: 768px) {
            .geyser-counter-btn {
                width: 50px;
                height: 50px;
                margin: 0 10px;
            }
        }

        .geyser-counter-value {
            font-size: 18px;
            font-weight: bold;
            min-width: 30px;
            text-align: center;
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .form-step {
            max-width: 600px;
            margin: 0 auto;
        }

        #step0 .option-grid,
        #step1 .option-grid,
        #step11 .option-grid {
            max-width: 400px;
            margin: 0 auto;
        }

        #step0 h2,
        #step1 h2,
        #step11 h2 {
            text-align: center;
        }

        @media (max-width: 768px) {
            #step0 .option-grid,
            #step1 .option-grid,
            #step11 .option-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                /* margin-top: 100px !important; */
            }
        }

        #calculate-btn {
            display: none !important;
        }
        
        /* Image styling for options */
        .option img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }
        
        /* Modal styling */
        .modal-body {
            padding: 20px;
        }
        
        /* Reset button styling */
        #reset-btn, #reset-btn-commercial {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px 20px;
            margin-bottom: 20px;
        }
        .result-value {
    font-size: 3rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1;
}
.budget-disclaimer {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.75rem;
    color: #64748b;
    background: #f8fafc;
    padding: 0.75rem;
    border-radius: 8px;
}

.budget-disclaimer svg {
    flex-shrink: 0;
    color: #94a3b8;
}
    </style>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="selection-slugs" class="slug-container"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 200px">
        <div class="form-container">
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar">
                    <div class="progress-percentage" id="progress-percentage">0%</div>
                </div>
            </div>

            <form id="constructionForm">
                <!-- Your form steps remain exactly the same -->
                <div id="step0" class="form-step active">
                    <div class="option-grid">
                        <div class="option" data-value="residential">
                            <img src="/frontend/images/residance.png" alt="House" width="150" height="150" style="margin-bottom:12px">
                            <strong>Residential</strong>
                            <span>Home, apartment, studio, etc</span>
                        </div>
                        <div class="option" data-value="commercial">
                            <img src="/frontend/images/commercial.png" alt="Office" width="150" height="150" style="margin-bottom:12px">
                            <strong>Commercial</strong>
                            <span>Office, shop, restaurant, etc</span>
                        </div>
                    </div>
                </div>

                <!-- All other steps (1-14) remain exactly the same as in your original code -->
                <div id="step1" class="form-step">
                    <h2>Construction Type </h2>
                    <div class="option-grid">
                        <div class="option" data-value="construction">
                            <strong>Construction</strong>
                        </div>
                        <div class="option" data-value="under-construction">
                            <strong> Under Construction</strong>
                        </div>
                    </div>
                </div>

                <!-- Step 2: City Selection -->
                <div id="step2" class="form-step">
                    <h2>Select Your City</h2>
                    <div class="option-grid">
                        <div class="option" data-value="lahore">Lahore</div>
                        <div class="option" data-value="gujranwala">Gujranwala</div>
                        <div class="option" data-value="islamabad">Islamabad</div>
                        <div class="option" data-value="karachi">Karachi</div>
                        <div class="option" data-value="faisalabad">Faisalabad</div>
                        <div class="option" data-value="other" id="other-city">Other</div>
                    </div>
                    <input type="text" class="other-input" id="other-city-input" placeholder="Apna shehar ka naam likhain">
                </div>

                <!-- Step 3: Property Size -->
                <div id="step3" class="form-step">
                    <h2>Size of Property</h2>
                    <div class="option-grid">
                        <div class="option" data-value="<6marla">&lt;6 Marla</div>
                        <div class="option" data-value="7-10marla">7-10 Marla</div>
                        <div class="option" data-value="12-14marla">12-14 Marla</div>
                        <div class="option" data-value="1-2kanal">1-2 Kanal</div>
                        <div class="option" data-value="5kanal">5 Kanal</div>
                        <div class="option" data-value="other" id="other-size">Other</div>
                    </div>
                    <input type="text" class="other-input" id="other-size-input" placeholder="Apna size marla mein likhain">
                </div>

                <!-- Step 4: Package Selection (only for <6 Marla) -->
                <div id="step4" class="form-step mt-5 mb-5">
                    <h2 >Select Your Favourite Package</h2>
                    <div class="option-grid">
                        <div class="option" data-value="basic">Basic Package<br></div>
                        <div class="option" data-value="standard">Standard Package<br></div>
                        <div class="option" data-value="premium">Premium Package<br></div>
                    </div>
                </div>

                <!-- Step 5: Results for <6 Marla -->
                <div id="step5" class="form-step">
                    <div class="result-container">
                        <h2>Total Estimated Cost</h2>
                        <div class="result-value" id="estimated-cost">Rs. 0</div>
                        <div class="price-range">
                            <div class="price-box">Rs. <span id="lower-range">0</span> </div>
                            <div class="price-box">Rs. <span id="higher-range">0</span> </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Room Selection for >6 Marla -->
                <div id="step6" class="form-step">
                    <h2>Specify no. of Rooms to Automate</h2>
                    <div class="result-container">
                        <div class="cost-display">
                            <div class="cost-label">Estimated Cost</div>
                            <div class="cost-value" id="room-estimated-cost">PKR 0</div>
                        </div>
                    </div>

                    <div class="room-grid">
                        <div class="room-control">
                            <span class="room-name">Bed Rooms</span>
                            <div class="room-counter">
                                <button class="counter-btn minus" data-room="bedroom">-</button>
                                <span class="counter-value" id="bedroom-value">0</span>
                                <button class="counter-btn plus" data-room="bedroom">+</button>
                            </div>
                        </div>

                        <div class="room-control">
                            <span class="room-name">Bath Rooms</span>
                            <div class="room-counter">
                                <button class="counter-btn minus" data-room="bathroom">-</button>
                                <span class="counter-value" id="bathroom-value">0</span>
                                <button class="counter-btn plus" data-room="bathroom">+</button>
                            </div>
                        </div>

                        <div class="room-control">
                            <span class="room-name">Drawing Rooms</span>
                            <div class="room-counter">
                                <button class="counter-btn minus" data-room="drawing">-</button>
                                <span class="counter-value" id="drawing-value">0</span>
                                <button class="counter-btn plus" data-room="drawing">+</button>
                            </div>
                        </div>

                        <div class="room-control">
                            <span class="room-name">Kitchens</span>
                            <div class="room-counter">
                                <button class="counter-btn minus" data-room="kitchen">-</button>
                                <span class="counter-value" id="kitchen-value">0</span>
                                <button class="counter-btn plus" data-room="kitchen">+</button>
                            </div>
                        </div>

                        <div class="room-control">
                            <span class="room-name">Laundry</span>
                            <div class="room-counter">
                                <button class="counter-btn minus" data-room="laundry">-</button>
                                <span class="counter-value" id="laundry-value">0</span>
                                <button class="counter-btn plus" data-room="laundry">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 7: Electric Geyser -->
                {{-- <div id="step7" class="form-step">
                    <h2>Electric Geyser</h2>
                    <div class="result-container">
                        <div class="cost-value" id="geyser-estimated-cost">Rs. 0</div>
                    </div>

                    <div class="geyser-counter">
                        <button class="geyser-counter-btn minus" id="remove-geyser">-</button>
                        <span class="geyser-counter-value" id="geyser-count"></span>
                        <button class="geyser-counter-btn plus" id="add-geyser">+</button>
                    </div>
                    <p style="text-align: center; margin-top: 20px; color: #666;"></p>
                </div> --}}
<div id="step7" class="form-step">
    <h2 style="color: #2c3e50; margin-bottom: 15px;">Premium Electric Geysers</h2>
    <div class="result-container">
        <div class="cost-value" id="geyser-estimated-cost">Rs. 0</div>
    </div>

    <div class="geyser-counter">
        <button class="geyser-counter-btn minus" id="remove-geyser">-</button>
        <span class="geyser-counter-value" id="geyser-count"></span>
        <button class="geyser-counter-btn plus" id="add-geyser">+</button>
    </div>
    <p style="text-align: center; margin: 20px 0; color: #666; font-size: 15px;">
        <span style="color: #e74c3c; font-weight: bold;">LIMITED TIME OFFER:</span> 
    </p>
    <p style="text-align: center; margin: 15px 0; color: #666; font-size: 14px;">
        Our team will install smart controls for your geyser(s)
    </p>
    <div style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; margin-top: 10px;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <span style="color: #27ae60; font-size: 18px;">✓</span>
            <span style="font-size: 13px;">Automated temperature control</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; margin-top: 5px;">
            <span style="color: #27ae60; font-size: 18px;">✓</span>
            <span style="font-size: 13px;">Scheduled on/off functionality</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; margin-top: 5px;">
            <span style="color: #27ae60; font-size: 18px;">✓</span>
            <span style="font-size: 13px;">Remote control via mobile app</span>
        </div>
    </div>
    <div style="text-align: center; background-color: #f8f9fa; padding: 8px; border-radius: 4px; margin-top: 10px;">
        <span style="font-size: 12px; color: #7f8c8d;">✔️ 1000+ happy customers this month</span>
    </div>
</div>
                <!-- Step 8: Water Pump -->
                {{-- <div id="step8" class="form-step">
                    <h2>Water Pump</h2>
                    <div class="result-container">
                        <div class="cost-value" id="pump-estimated-cost">Rs. 0</div>
                    </div>

                    <p style="text-align: center; margin-bottom: 20px;">Do you want to include a water pump? </p>

                    <div class="yes-no-options">
                        <div class="yes-no-btn" data-choice="yes">Yes</div>
                        <div class="yes-no-btn" data-choice="no">No</div>
                    </div>
                </div> --}}

                <div id="step8" class="form-step">
    <h2 style="margin-bottom: 15px;">Water Pump Automation</h2>
    <div class="result-container">
        <div class="cost-value" id="pump-estimated-cost">Rs. 0</div>
    </div>

    <p style="text-align: center; margin: 15px 0 20px; color: #555; font-size: 14px;">
        Enable smart control for your water pump?
    </p>

    <div class="yes-no-options">
        <div class="yes-no-btn" data-choice="yes">Yes</div>
        <div class="yes-no-btn" data-choice="no">No</div>
    </div>

    <div style="background-color: #f8f9fa; padding: 12px; border-radius: 6px; margin-top: 20px;">
        <div style="display: flex; align-items: flex-start; margin-bottom: 8px;">
            <span style="color: #2980b9; margin-right: 8px;">•</span>
            <span style="font-size: 13px;">Automated water level sensing</span>
        </div>
        <div style="display: flex; align-items: flex-start; margin-bottom: 8px;">
            <span style="color: #2980b9; margin-right: 8px;">•</span>
            <span style="font-size: 13px;">Schedule operation times</span>
        </div>
        <div style="display: flex; align-items: flex-start;">
            <span style="color: #2980b9; margin-right: 8px;">•</span>
        </div>
    </div>
</div>

                <!-- Step 9: Install and Setup -->
                {{-- <div id="step9" class="form-step">
                    <h2>Install and Setup</h2>
                    <div class="result-container">
                        <div class="cost-value" id="setup-estimated-cost">Rs. 0</div>
                    </div>

                    <p style="text-align: center; margin-bottom: 20px;">Do you want professional installation and setup? </p>

                    <div class="yes-no-options">
                        <div class="yes-no-btn" data-choice="yes">Yes</div>
                        <div class="yes-no-btn" data-choice="no">No</div>
                    </div>
                </div> --}}

<div id="step9" class="form-step">
    <h2 style="margin-bottom: 15px;">Professional Automation Setup</h2>
    <div class="result-container">
        <div class="cost-value" id="setup-estimated-cost">Rs. 0</div>
    </div>

    <p style="text-align: center; margin: 15px 0 20px; color: #555; font-size: 14px;">
        Include expert installation and configuration?
    </p>

    <div class="yes-no-options">
        <div class="yes-no-btn" data-choice="yes">Yes</div>
        <div class="yes-no-btn" data-choice="no">No</div>
    </div>

    <div style="background-color: #f5f7fa; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #3498db;">
        <div style="display: flex; margin-bottom: 10px; align-items: center;">
            <div style="background-color: #3498db; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 14px;">1</div>
            <span style="font-size: 13px;">Complete system testing and calibration</span>
        </div>
        <div style="display: flex; margin-bottom: 10px; align-items: center;">
            <div style="background-color: #3498db; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 14px;">2</div>
            <span style="font-size: 13px;">Mobile app setup and personalization</span>
        </div>
        <div style="display: flex; align-items: center;">
            <div style="background-color: #3498db; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; margin-right: 10px; font-size: 14px;">3</div>
            <span style="font-size: 13px;">Full demonstration and user training</span>
        </div>
    </div>

    <p style="text-align: center; margin-top: 15px; font-size: 12px; color: #7f8c8d;">
        Recommended for optimal system performance and safety
    </p>
</div>

                <!-- Step 10: Final Results -->
                <div id="step10" class="form-step">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <button id="reset-btn" type="button">Reset</button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;">Result</a>
                    </div>
                    <div class="result-container">
                        <h2>Estimated Budget</h2>
                        <div class="result-value" id="final-cost">Rs. 0</div>
                        <div class="price-range">
                            <div class="price-box">Rs. <span id="final-lower-range">0</span></div>
                            <div class="price-box">Rs. <span id="final-higher-range">0</span> </div>
                        </div>

                           <!-- Disclaimer note -->
    <div class="budget-disclaimer">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <span>Final price may vary based on specific requirements</span>
    </div>
                    </div>
                </div>

                <!-- Step 11: Commercial Type -->
                <div id="step11" class="form-step">
                    <h2>Commercial Type</h2>
                    <div class="option-grid">
                        <div class="option" data-value="commercial-construction">Commercial Construction</div>
                        <div class="option" data-value="commercial-under-construction">Commercial Under Construction</div>
                    </div>
                </div>

                <!-- Step 12: Commercial City Selection -->
                <div id="step12" class="form-step">
                    <h2>Select Your City</h2>
                    <div class="option-grid">
                        <div class="option" data-value="lahore">Lahore</div>
                        <div class="option" data-value="gujranwala">Gujranwala</div>
                        <div class="option" data-value="islamabad">Islamabad</div>
                        <div class="option" data-value="karachi">Karachi</div>
                        <div class="option" data-value="faisalabad">Faisalabad</div>
                        <div class="option" data-value="other" id="other-commercial-city">Other</div>
                    </div>
                    <input type="text" class="other-input" id="other-commercial-city-input" placeholder="Enter your city name">
                </div>

                <!-- Step 13: Commercial Property Size -->
                <div id="step13" class="form-step">
                    <h2>Property Size</h2>
                    <div class="option-grid">
                        <div class="option" data-value="1200">1200 Sq.ft</div>
                        <div class="option" data-value="1800">1800 Sq.ft</div>
                        <div class="option" data-value="2200">2200 Sq.ft</div>
                        <div class="option" data-value="3000">3000 Sq.ft</div>
                        <div class="option" data-value="other" id="other-commercial-size">Other</div>
                    </div>
                    <input type="text" class="other-input" id="other-commercial-size-input" placeholder="Enter your property size">
                </div>

                <!-- Step 14: Commercial Results -->
                <div id="step14" class="form-step">
                    <div class="result-container">
                        <button id="reset-btn-commercial" type="button">Reset</button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;">Result</a>
                        <h2>Total Commercial Property Estimate</h2>
                        <div class="cost-value" id="commercial-estimated-cost">Rs. 0</div>
                        <div class="price-range">
                            <div class="price-box">Rs. <span id="commercial-lower-range">0</span> </div>
                            <div class="price-box">Rs. <span id="commercial-higher-range">0</span></div>
                        </div>
                    </div>
                </div>

                <div class="button-group mb-5">
                    <button type="button" class="back-btn hidden" id="back-btn">Back</button>
                    <button type="button" class="next-btn hidden" id="next-btn">Next</button>
                    <button type="button" class="next-btn hidden" id="calculate-btn">Hisab Karain</button>
                </div>
            </form>
        </div>
    </div>
@endsection