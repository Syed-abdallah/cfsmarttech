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
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 15px;
  margin: 30px 0;
}

.option {
  background: rgb(241, 237, 237);
  /* border: 2px solid #e0e0e0; */
  border-radius: 8px;
  padding: 15px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.option:hover {
  border-color: #3498db;
}

.option.selected {
  background-color: #3498db;
  color: white;
  border-color: #3498db;
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
}

@media (min-width: 768px) {
  .button-group {
    display: flex;
    justify-content: space-between;
  }
  
  #back-btn {
    margin-left: 260px; 
  }
  
  #next-btn {
    margin-right: 260px; /* Margin for the "Next" button */
  }
  
  #calculate-btn {
    margin-right: 260px; /* Margin for the "Hisab Karain" button */
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

.next-btn, .back-btn {
  border-radius: 30px; /* Adds rounded corners */
  background-color: transparent; /* Removes background color */
  padding: 15px 45px; /* Adds padding around the button */
  border: 2px solid #3498db; /* Adds a border to make the buttons visible */
  color: #3498db; /* Makes the text blue for visibility */
  cursor: pointer; /* Changes the cursor to a pointer on hover */
}

.back-btn {
  border-color: #e0e0e0; /* Light gray border for the back button */
  color: #333; /* Dark text for the back button */
}

.next-btn:hover, .back-btn:hover {
  opacity: 0.8; /* Adds a hover effect to make buttons slightly transparent */
}


/* .progress-container {
  width: 100%;
  height: 8px;
  background-color: #e0e0e0;
  border-radius: 4px;
  margin-bottom: 30px;
}

.progress-bar {
  height: 100%;
  background-color: #3498db;
  border-radius: 4px;
  transition: width 0.5s ease;
} */


.progress-container {
  width: 45%; /* Set width to 45% */
  height: 25px;
  background-color: #e0e0e0;
  border-radius: 4px;
  margin-bottom: 20px;
  border-radius: 100px; 
  margin-top: 20px;
  margin-left: 27%; /* Center the progress bar horizontally */
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
  font-weight: bold;
}
/* Example of progress bar animation on page load */
/* window.onload = function() {
  const progressBar = document.getElementById("progress-bar");
  progressBar.style.width = "70%"; 
  // Color transition animation
  progressBar.style.background = "linear-gradient(90deg, #ff6347, #ff1493)";  
}; */

/* 
window.onload = function() {
  document.getElementById("progress-bar").style.width = "70%";  
}; */



.hidden {
  display: none;
}

.result-container {
  text-align: center;
  margin-top: 30px;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
}

.result-title {
  font-size: 24px;
  color: #2c3e50;
  margin-bottom: 15px;
}

.result-value {
  font-size: 32px;
  font-weight: bold;
  color: #3498db;
  margin-bottom: 20px;
}

.price-range {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.price-box {
  padding: 10px 20px;
  background-color: #e8f4fc;
  border-radius: 5px;
  font-weight: 500;
}

.room-control {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 15px 0;
  padding: 15px;
  background-color: #f8f9fa;
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
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: #3498db;
  color: white;
  border: none;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.counter-value {
  margin: 0 15px;
  min-width: 30px;
  text-align: center;
  font-weight: 600;
}

.room-grid {
  margin-top: 30px;
}

.geyser-control {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px 0;
}

.geyser-btn {
  margin-left: 15px;
  padding: 8px 15px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.yes-no-options {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 30px;
}

.yes-no-btn {
  padding: 12px 30px;
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s;
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
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: #3498db;
  color: white;
  border: none;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 10px;
}

.geyser-counter-value {
  font-size: 18px;
  font-weight: bold;
  min-width: 30px;
  text-align: center;
}





/* Add this to your existing styles */
.form-container {
  max-width: 1200px; /* Adjust this value as needed */
  margin: 0 auto; /* This centers the container */
  padding: 0 40px;

}

.form-step {
  max-width: 600px; /* Adjust this value as needed */
  margin: 0 auto; /* This centers the step content */
}

/* For the option grids in these specific steps */
#step0 .option-grid,
#step1 .option-grid,
#step11 .option-grid {
  max-width: 400px; /* Adjust this value as needed */
  margin: 0 auto; /* Center the grid */
}

/* For the h2 headings in these steps */
#step0 h2,
#step1 h2,
#step11 h2 {
  text-align: center;
 
}

@media (max-width: 768px) {
  #step0 .option-grid,
  #step1 .option-grid,
  #step11 .option-grid {
    grid-template-columns: 1fr; /* Single column on small screens */
  }
}


#calculate-btn {
  display: none !important;
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



  <!-- Button trigger modal -->


<!-- Modal -->

    <div class="form-container">

      <div class="progress-container">
        <div class="progress-bar" id="progress-bar">
          <div class="progress-percentage" id="progress-percentage">0%</div>
        </div>
      
      
      </div>

      <form id="constructionForm">

        <div id="step0" class="form-step active">
          <h2>Start</h2>
          <div class="option-grid">
            <div class="option" data-value="residential">Residential</div>
            <div class="option" data-value="commercial">Commercial</div>
          </div>
        </div>


        <div id="step1" class="form-step">
          <h2>Construction Type </h2>
          <div class="option-grid">
            <div class="option" data-value="construction">Construction</div>
            <div class="option" data-value="under-construction">Under Construction</div>
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
            <div class="option" data-value="multan">Multan</div>
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
        <div id="step4" class="form-step">
          <h2>Select Your Favourite Package</h2>
          <div class="option-grid">
            <div class="option" data-value="basic">Basic Package<br>(Rs. 2,500,000)</div>
            <div class="option" data-value="standard">Standard Package<br>(Rs. 3,000,000)</div>
            <div class="option" data-value="premium">Premium Package<br>(Rs. 3,500,000)</div>
          </div>
        </div>

        <!-- Step 5: Results for <6 Marla -->
        <div id="step5" class="form-step">
          <div class="result-container">
            <h2>Total Estimated Cost</h2>
            <div class="result-value" id="estimated-cost">Rs. 0</div>
            <div class="price-range">
              <div class="price-box">Rs. <span id="lower-range">0</span> (50k less)</div>
              <div class="price-box">Rs. <span id="higher-range">0</span> (50k more)</div>
            </div>
          </div>
        </div>

        <!-- Step 6: Room Selection for >6 Marla -->
        <div id="step6" class="form-step">
          <h2>Specify no. of Rooms to Automate</h2>
          <div class="result-container">
            <div class="result-value" id="room-estimated-cost">Rs. 0</div>
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
        <div id="step7" class="form-step">
          <h2>Electric Geyser</h2>
          <div class="result-container">
            <div class="result-value" id="geyser-estimated-cost">Rs. 0</div>
          </div>

          <div class="geyser-counter">
            <button class="geyser-counter-btn minus" id="remove-geyser">-</button>
            <span class="geyser-counter-value" id="geyser-count">0</span>
            <button class="geyser-counter-btn plus" id="add-geyser">+</button>
          </div>
          <p style="text-align: center; margin-top: 10px; color: #666;">(Rs. 25,000 each)</p>
        </div>

        <!-- Step 8: Water Pump -->
        <div id="step8" class="form-step">
          <h2>Water Pump</h2>
          <div class="result-container">
            <div class="result-value" id="pump-estimated-cost">Rs. 0</div>
          </div>

          <p style="text-align: center; margin-bottom: 20px;">Do you want to include a water pump? (Rs. 35,000)</p>

          <div class="yes-no-options">
            <div class="yes-no-btn" data-choice="yes">Yes</div>
            <div class="yes-no-btn" data-choice="no">No</div>
          </div>
        </div>

        <!-- Step 9: Install and Setup -->
        <div id="step9" class="form-step">
          <h2>Install and Setup</h2>
          <div class="result-container">
            <div class="result-value" id="setup-estimated-cost">Rs. 0</div>
          </div>

          <p style="text-align: center; margin-bottom: 20px;">Do you want professional installation and setup? (Rs.
            50,000)</p>

          <div class="yes-no-options">
            <div class="yes-no-btn" data-choice="yes">Yes</div>
            <div class="yes-no-btn" data-choice="no">No</div>
          </div>
        </div>

        <!-- Step 10: Final Results -->
        <div id="step10" class="form-step">
          <!-- reset everything -->
          <div style="display: flex; align-items: center; gap: 10px;">
            <button id="reset-btn" type="button">Reset</button>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;">slugs</a>
        </div>
          <div class="result-container">
            <h2>Estimated Budget</h2>
            <div class="result-value" id="final-cost">Rs. 0</div>
            <div class="price-range">
              <div class="price-box">Rs. <span id="final-lower-range">0</span> (50k less)</div>
              <div class="price-box">Rs. <span id="final-higher-range">0</span> (50k more)</div>
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
            <div class="option" data-value="multan">Multan</div>
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
          <input type="text" class="other-input" id="other-commercial-size-input"
            placeholder="Enter your property size">
        </div>

        <!-- Step 14: Commercial Results -->
        <div id="step14" class="form-step">
          <div class="result-container">
            <button id="reset-btn-commercial" type="button">Reset</button>
            <h2>Total Commercial Property Estimate</h2>
            <div class="result-value" id="commercial-estimated-cost">Rs. 0</div>
            <div class="price-range">
              <div class="price-box">Rs. <span id="commercial-lower-range">0</span> (50k less)</div>
              <div class="price-box">Rs. <span id="commercial-higher-range">0</span> (50k more)</div>
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
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      // Form state
      const formState = {
        currentStep: 0,
        totalSteps: 10,
        constructionType: '',
        city: '',
        propertySize: '',
        selectedPackage: 'basic',
        isCommercial: false,
        commercialType: '',
        commercialCity: '',
        commercialSize: '',
        commercialPrices: {
          '1200': 5000000,
          '1800': 7500000,
          '2200': 9000000,
          '3000': 12000000
        },
        roomCounts: {
          bedroom: 0,
          bathroom: 0,
          drawing: 0,
          kitchen: 0,
          laundry: 0
        },
        roomPrices: {
          bedroom: 50000,
          bathroom: 30000,
          drawing: 80000,
          kitchen: 60000,
          laundry: 20000
        },
        packagePrices: {
          basic: 2500000,
          standard: 3000000,
          premium: 3500000
        },
        sizeBasePrices: {
          '7-10marla': 0,
          '12-14marla': 0,
          '1-2kanal': 0,
          '5kanal': 0
        },
        additionalCosts: {
          geyser: 25000,
          geyserCount: 0,
          waterPump: 35000,
          hasWaterPump: false,
          installation: 50000,
          hasInstallation: false
        },

        currentEstimate: 0,

        init() {
          const savedState = localStorage.getItem('constructionFormState');

          // First load any saved commercial estimate
          const savedCommercialEstimate = localStorage.getItem('commercialEstimatedCost');
          if (savedCommercialEstimate) {
            this.currentEstimate = parseInt(savedCommercialEstimate);
          }

          if (savedState) {
            const parsed = JSON.parse(savedState);
            this.currentStep = parsed.currentStep || 0;
            this.isCommercial = parsed.isCommercial || false;

            // Residential properties
            this.constructionType = parsed.constructionType;
            this.city = parsed.city;
            this.propertySize = parsed.propertySize;
            this.selectedPackage = parsed.selectedPackage || 'basic';

            // Commercial properties
            this.commercialType = parsed.commercialType || '';
            this.commercialCity = parsed.commercialCity || '';
            this.commercialSize = parsed.commercialSize || '';

            // Use saved commercial estimate if available
            if (parsed.commercialEstimate) {
              this.currentEstimate = parsed.commercialEstimate;
            }

            // Common properties
            this.roomCounts = parsed.roomCounts || this.roomCounts;
            this.additionalCosts = parsed.additionalCosts || this.additionalCosts;

            this.restoreSelections();

            // Update estimates based on current step
            if (this.isCommercial) {
              if (this.currentStep === 14) {
                this.updateCommercialEstimateDisplay();
              }
            } else {
              if (this.currentStep >= 5) {
                this.calculateEstimate();
              }
              if (this.currentStep >= 6) {
                this.calculateRoomEstimate();
              }
            }
          }

          this.updateForm();
          this.updateProgressBar();
          this.updateSlugs();
        },

        updateCommercialEstimateDisplay() {
          const formattedEstimate = this.currentEstimate.toLocaleString();
          document.getElementById('commercial-estimated-cost').textContent = `Rs. ${formattedEstimate}`;

          const lowerRange = (this.currentEstimate - 50000).toLocaleString();
          const higherRange = (this.currentEstimate + 50000).toLocaleString();

          document.getElementById('commercial-lower-range').textContent = lowerRange;
          document.getElementById('commercial-higher-range').textContent = higherRange;
        }
        ,
        reset() {
          // Clear localStorage
          localStorage.removeItem('constructionFormState');
          localStorage.removeItem('commercialEstimatedCost');

          // Reset all state
          this.currentStep = 0;
          this.constructionType = '';
          this.city = '';
          this.propertySize = '';
          this.selectedPackage = 'basic';
          this.isCommercial = false;
          this.commercialType = '';
          this.commercialCity = '';
          this.commercialSize = '';

          // Reset room counts
          this.roomCounts = { bedroom: 0, bathroom: 0, drawing: 0, kitchen: 0, laundry: 0 };

          // Reset additional costs
          this.additionalCosts = {
            geyser: 25000,
            geyserCount: 0,
            waterPump: 35000,
            hasWaterPump: false,
            installation: 50000,
            hasInstallation: false
          };

          this.currentEstimate = 0;

          // Reset UI selections
          document.querySelectorAll('.selected').forEach(el => el.classList.remove('selected'));
          document.querySelectorAll('.other-input').forEach(input => {
            input.style.display = 'none';
            input.value = '';
          });

          // Reset counters
          Object.keys(this.roomCounts).forEach(r => {
            document.getElementById(`${r}-value`).textContent = 0;
          });

          document.getElementById('geyser-count').textContent = 0;

          // Rebuild UI
          this.updateForm();
          this.updateProgressBar();
          this.updateSlugs();
        },

        updateSlugs() {
          const bar = document.getElementById('selection-slugs');
          const parts = [];

          // Common selections for both flows
          if (this.city) {
            const cityName = this.city === 'other' || this.commercialCity === 'other'
              ? document.getElementById(this.isCommercial ? 'other-commercial-city-input' : 'other-city-input').value || '(your city)'
              : this.city || this.commercialCity;
            parts.push(`City: ${cityName}`);
          }

          if (this.isCommercial) {
            // Commercial flow specific slugs
            if (this.commercialType) {
              parts.push(`Type: ${this.commercialType.replace('-', ' ')}`);
            }

            if (this.commercialSize) {
              const sizeName = this.commercialSize === 'other'
                ? document.getElementById('other-commercial-size-input').value || '(your size)'
                : `${this.commercialSize} Sq.ft`;
              parts.push(`Size: ${sizeName}`);
            }
            if (this.commercialCity) {
              const cityName = this.commercialCity === 'other'
                ? document.getElementById('other-commercial-city-input').value || '(your city)'
                : this.commercialCity;
              parts.push(`City: ${cityName}`);
            }
          } else {
            // Residential flow specific slugs
            if (this.constructionType) {
              parts.push(`Type: ${this.constructionType}`);
            }

            if (this.propertySize) {
              const sizeName = this.propertySize === 'other'
                ? document.getElementById('other-size-input').value || '(your size)'
                : this.propertySize.includes('marla')
                  ? this.propertySize
                  : `${this.propertySize} Marla`;
              parts.push(`Size: ${sizeName}`);
            }

            if (this.propertySize === '<6marla' && this.selectedPackage) {
              parts.push(`Package: ${this.selectedPackage}`);
            }

            if (this.propertySize !== '<6marla') {
              const rc = this.roomCounts;
              const roomParts = [];
              if (rc.bedroom) roomParts.push(`${rc.bedroom} Bed`);
              if (rc.bathroom) roomParts.push(`${rc.bathroom} Bath`);
              if (rc.drawing) roomParts.push(`${rc.drawing} Drawing`);
              if (rc.kitchen) roomParts.push(`${rc.kitchen} Kitchen`);
              if (rc.laundry) roomParts.push(`${rc.laundry} Laundry`);
              if (roomParts.length) {
                parts.push(`Rooms: ${roomParts.join(', ')}`);
              }
            }
          }

          // Common additional features
          if (this.additionalCosts.geyserCount > 0) {
            parts.push(`Geysers: ${this.additionalCosts.geyserCount}`);
          }

          if (this.additionalCosts.hasWaterPump) {
            parts.push(`Pump: ${this.additionalCosts.hasWaterPump ? 'Yes' : 'No'}`);
          }

          if (this.additionalCosts.hasInstallation) {
            parts.push(`Installation: ${this.additionalCosts.hasInstallation ? 'Yes' : 'No'}`);
          }

          // Render as slugs
          // bar.innerHTML = parts.length > 0
          //   ? parts.map(text => `<span class="slug">${text}</span>`).join(' ')
          //   : '';
          bar.innerHTML = parts.length > 0
    ? `<ul style="padding-left: 20px; margin: 0;">` + 
        parts.map(text => `<li>${text}</li>`).join('') + 
      `</ul>`
    : '';

        },








        restoreSelections() {
          // Residential flow selections
          if (this.constructionType) {
            const residentialTypeOption = document.querySelector(`#step1 .option[data-value="${this.constructionType}"]`);
            if (residentialTypeOption) residentialTypeOption.classList.add('selected');
          }

          // City selection (common for both flows)
          if (this.city || this.commercialCity) {
            const city = this.city || this.commercialCity;
            const isCommercialCity = !!this.commercialCity;

            if (city === 'other') {
              const otherCityOption = isCommercialCity
                ? document.getElementById('other-commercial-city')
                : document.getElementById('other-city');
              const otherCityInput = isCommercialCity
                ? document.getElementById('other-commercial-city-input')
                : document.getElementById('other-city-input');

              if (otherCityOption) otherCityOption.classList.add('selected');
              if (otherCityInput) {
                otherCityInput.style.display = 'block';
                otherCityInput.value = isCommercialCity
                  ? this.commercialCityValue || ''
                  : this.cityValue || '';
              }
            } else {
              const selector = isCommercialCity
                ? `#step12 .option[data-value="${city}"]`
                : `#step2 .option[data-value="${city}"]`;
              const cityOption = document.querySelector(selector);
              if (cityOption) cityOption.classList.add('selected');
            }
          }

          // Property Size (separate for residential/commercial)
          if (this.propertySize) {
            if (this.propertySize === 'other') {
              document.getElementById('other-size').classList.add('selected');
              document.getElementById('other-size-input').style.display = 'block';
              document.getElementById('other-size-input').value = this.propertySizeValue || '';
            } else {
              const sizeOption = document.querySelector(`#step3 .option[data-value="${this.propertySize}"]`);
              if (sizeOption) sizeOption.classList.add('selected');
            }
          }

          if (this.commercialSize) {
            if (this.commercialSize === 'other') {
              document.getElementById('other-commercial-size').classList.add('selected');
              document.getElementById('other-commercial-size-input').style.display = 'block';
              document.getElementById('other-commercial-size-input').value = this.commercialSizeValue || '';
            } else {
              const commercialSizeOption = document.querySelector(`#step13 .option[data-value="${this.commercialSize}"]`);
              if (commercialSizeOption) commercialSizeOption.classList.add('selected');
            }
          }

          // Commercial Type
          if (this.commercialType) {
            const commercialTypeOption = document.querySelector(`#step11 .option[data-value="${this.commercialType}"]`);
            if (commercialTypeOption) commercialTypeOption.classList.add('selected');
          }

          // Residential Package
          if (this.selectedPackage) {
            const packageOption = document.querySelector(`#step4 .option[data-value="${this.selectedPackage}"]`);
            if (packageOption) packageOption.classList.add('selected');
          }

          // Room counts
          for (const room in this.roomCounts) {
            const roomElement = document.getElementById(`${room}-value`);
            if (roomElement) roomElement.textContent = this.roomCounts[room];
          }

          // Additional options
          const geyserCountElement = document.getElementById('geyser-count');
          if (geyserCountElement) geyserCountElement.textContent = this.additionalCosts.geyserCount;
          this.updateGeyserDisplay();

          // Water pump selection
          const waterPumpYes = document.querySelector('#step8 .yes-no-btn[data-choice="yes"]');
          const waterPumpNo = document.querySelector('#step8 .yes-no-btn[data-choice="no"]');
          if (waterPumpYes && waterPumpNo) {
            waterPumpYes.classList.toggle('selected', this.additionalCosts.hasWaterPump);
            waterPumpNo.classList.toggle('selected', !this.additionalCosts.hasWaterPump);
          }

          // Installation selection
          const installYes = document.querySelector('#step9 .yes-no-btn[data-choice="yes"]');
          const installNo = document.querySelector('#step9 .yes-no-btn[data-choice="no"]');
          if (installYes && installNo) {
            installYes.classList.toggle('selected', this.additionalCosts.hasInstallation);
            installNo.classList.toggle('selected', !this.additionalCosts.hasInstallation);
          }
        },


        nextStep() {
          if (this.isCommercial) {
            // Commercial flow navigation
            if (this.currentStep < 14) {
              // Validate current step before proceeding
              if (this.currentStep === 11 && !this.commercialType) {
                alert('Please select commercial type');
                return;
              }
              if (this.currentStep === 12 && !this.commercialCity) {
                if (this.commercialCity === 'other' && !document.getElementById('other-commercial-city-input').value) {
                  alert('Please enter your city name');
                  return;
                }
                alert('Please select a city');
                return;
              }
              if (this.currentStep === 13 && !this.commercialSize) {
                if (this.commercialSize === 'other' && !document.getElementById('other-commercial-size-input').value) {
                  alert('Please enter property size');
                  return;
                }
                alert('Please select property size');
                return;
              }

              this.currentStep++;

              // Calculate estimate when reaching results step
              if (this.currentStep === 14) {
                this.calculateCommercialEstimate();
              }

              this.updateForm();
              this.updateCommercialProgressBar();
              this.saveState();
            }
          } else {
            // Existing residential flow (keep your current code)
            if (this.currentStep < this.totalSteps) {
              // Only apply special step skipping when moving from property size selection
              if (this.currentStep === 3) {
                if (this.propertySize === '<6marla') {
                  this.currentStep = 4; // Go to package selection
                } else {
                  this.currentStep = 6; // Skip to room selection
                }
              }
              // For all other steps, just go to next step normally
              else {
                this.currentStep++;
              }

              this.calculateEstimate();
              this.updateForm();
              this.updateProgressBar();
              this.saveState();
            }
          }
        },





        prevStep() {
          if (this.isCommercial) {
            // Commercial flow back navigation
            if (this.currentStep > 11) {
              this.currentStep--;
            } else if (this.currentStep === 11) {
              // Go back to start (Step 0)
              this.currentStep = 0;
              this.isCommercial = false;
            }
          } else {
            // Residential flow back navigation
            if (this.currentStep > 1) {
              // Handle special cases when going back
              if (this.currentStep === 6) {
                this.currentStep = 3; // Back to property size from rooms
              } else if (this.currentStep === 4) {
                this.currentStep = 3; // Back to property size from package
              } else {
                // Normal back navigation
                this.currentStep--;
              }
            } else if (this.currentStep === 1) {
              // Go back to start (Step 0)
              this.currentStep = 0;
            }
          }

          this.updateForm();
          this.updateProgressBar();
          this.saveState();
        },





        updateForm() {
          // Hide all steps first
          document.querySelectorAll('.form-step').forEach(step => {
            step.classList.remove('active');
          });

          // Show current step
          document.getElementById(`step${this.currentStep}`).classList.add('active');

          // Navigation buttons logic
          const isCommercialStep = this.currentStep >= 11 && this.currentStep <= 14;
          const isResidentialFinalStep = this.currentStep === 5 || this.currentStep === 10;

          // Show back button on all steps except Step 0
          document.getElementById('back-btn').classList.toggle('hidden', this.currentStep === 0);

          // Hide next button on final steps and Step 0
          document.getElementById('next-btn').classList.toggle('hidden',
            this.currentStep === 0 ||
            (isCommercialStep ? this.currentStep === 14 : isResidentialFinalStep));

          // Only show calculate button on Step 4
          document.getElementById('calculate-btn').classList.toggle('hidden',
            this.currentStep !== 4);
        },


        updateProgressBar() {
          let progressPercentage = 0;

          if (this.currentStep === 0) {
            // Start screen - 0% progress
            progressPercentage = 0;
          }
          else if (this.isCommercial) {
            // Commercial flow (Steps 11-14)
            const commercialSteps = 4;
            const currentCommercialStep = this.currentStep - 10;
            progressPercentage = ((currentCommercialStep) / commercialSteps) * 100;
          }
          else {
            // Residential flow
            if (this.propertySize === '<6marla') {
              // <6 Marla flow (Steps 1-5)
              const residentialSteps = 5;
              progressPercentage = ((this.currentStep) / residentialSteps) * 100;
            } else {
              // >6 Marla flow (Steps 1-3,6-10)
              const residentialSteps = 8;
              let currentResidentialStep = this.currentStep <= 3 ? this.currentStep : this.currentStep - 2;
              progressPercentage = ((currentResidentialStep) / residentialSteps) * 100;
            }
          }

          // Ensure percentage stays between 0-100
          progressPercentage = Math.min(100, Math.max(0, progressPercentage));
          document.getElementById('progress-bar').style.width = `${progressPercentage}%`;
          document.getElementById('progress-percentage').textContent = `${Math.round(progressPercentage)}%`;
        },

        saveState() {
          const stateToSave = {
            currentStep: this.currentStep,
            isCommercial: this.isCommercial,

            // Residential properties
            constructionType: this.constructionType,
            city: this.city,
            cityValue: this.city === 'other' ? document.getElementById('other-city-input').value : '',
            propertySize: this.propertySize,
            propertySizeValue: this.propertySize === 'other' ? document.getElementById('other-size-input').value : '',
            selectedPackage: this.selectedPackage,

            // Commercial properties
            commercialType: this.commercialType,
            commercialCity: this.commercialCity,
            commercialCityValue: this.commercialCity === 'other'
              ? document.getElementById('other-commercial-city-input').value
              : '',
            commercialSize: this.commercialSize,
            commercialSizeValue: this.commercialSize === 'other'
              ? document.getElementById('other-commercial-size-input').value
              : '',
            commercialEstimate: this.currentEstimate,

            // Common properties
            roomCounts: this.roomCounts,
            additionalCosts: this.additionalCosts,
            currentEstimate: this.currentEstimate
          };

          localStorage.setItem('constructionFormState', JSON.stringify(stateToSave));
          this.updateSlugs();
        },

        calculateCommercialEstimate() {
          let basePrice = 0;

          if (this.commercialSize in this.commercialPrices) {
            basePrice = this.commercialPrices[this.commercialSize];
          } else if (this.commercialSize === 'other') {
            const customSize = parseInt(document.getElementById('other-commercial-size-input').value) || 0;
            basePrice = customSize * 4000; // Rs.4000 per sq.ft as sample calculation
          }

          this.currentEstimate = basePrice;

          // Save to localStorage
          localStorage.setItem('commercialEstimatedCost', this.currentEstimate);

          // Also save to the form state
          this.saveState();

          // Update display
          this.updateCommercialEstimateDisplay();
        }
        ,
        updateCommercialProgressBar() {
          const totalSteps = 4; // Steps 11-14
          const currentProgressStep = this.currentStep - 10; // Convert to 1-4 range
          const progressPercentage = ((currentProgressStep - 1) / (totalSteps - 1)) * 100;
          document.getElementById('progress-bar').style.width = `${progressPercentage}%`;
          document.getElementById('progress-percentage').textContent = `${Math.round(progressPercentage)}%`;
        },

        calculateEstimate() {
          let basePrice = 0;

          if (this.propertySize === '<6marla') {
            basePrice = this.packagePrices[this.selectedPackage];
            this.currentEstimate = basePrice;
            document.getElementById('estimated-cost').textContent = `Rs. ${basePrice.toLocaleString()}`;
            document.getElementById('lower-range').textContent = (basePrice - 50000).toLocaleString();
            document.getElementById('higher-range').textContent = (basePrice + 50000).toLocaleString();
          } else {
            // Calculate room estimate first
            this.calculateRoomEstimate();

            // Calculate total with all additions
            let total = this.currentEstimate;

            // Add geyser cost if on step 7 or beyond
            if (this.currentStep >= 7) {
              total += this.additionalCosts.geyserCount * this.additionalCosts.geyser;
            }

            // Add water pump if on step 8 or beyond and selected
            if (this.currentStep >= 8 && this.additionalCosts.hasWaterPump) {
              total += this.additionalCosts.waterPump;
            }

            // Add installation if on step 9 or beyond and selected
            if (this.currentStep >= 9 && this.additionalCosts.hasInstallation) {
              total += this.additionalCosts.installation;
            }

            // Update the display based on current step
            if (this.currentStep === 7) {
              document.getElementById('geyser-estimated-cost').textContent =
                `Rs. ${total.toLocaleString()}`;
            } else if (this.currentStep === 8) {
              document.getElementById('pump-estimated-cost').textContent =
                `Rs. ${total.toLocaleString()}`;
            } else if (this.currentStep === 9) {
              document.getElementById('setup-estimated-cost').textContent =
                `Rs. ${total.toLocaleString()}`;
            } else if (this.currentStep === 10) {
              document.getElementById('final-cost').textContent = `Rs. ${total.toLocaleString()}`;
              document.getElementById('final-lower-range').textContent = (total - 50000).toLocaleString();
              document.getElementById('final-higher-range').textContent = (total + 50000).toLocaleString();
            }
          }
        },

        calculateRoomEstimate() {
          let total = 0;

          // Calculate based on room counts
          for (const room in this.roomCounts) {
            // total += this.roomCounts[room] * this.roomPrices[room] * 1000; // Convert to actual rupees
            total += this.roomCounts[room] * this.roomPrices[room] ; // Convert to actual rupees
          }

          // Add base price based on property size
          if (this.propertySize in this.sizeBasePrices) {
            total += this.sizeBasePrices[this.propertySize];
          }

          this.currentEstimate = total;

          // Update the display
          if (this.currentStep === 6) {
            document.getElementById('room-estimated-cost').textContent = `Rs. ${total.toLocaleString()}`;
          }
        },

        updateRoomCount(room, change) {
          let newValue = this.roomCounts[room] + change;
          newValue = Math.max(0, newValue);

          this.roomCounts[room] = newValue;
          document.getElementById(`${room}-value`).textContent = newValue;
          this.calculateRoomEstimate();
          this.saveState();
        },

        updateGeyserCount(change) {
          let newValue = this.additionalCosts.geyserCount + change;
          newValue = Math.max(0, newValue);

          this.additionalCosts.geyserCount = newValue;
          document.getElementById('geyser-count').textContent = newValue;
          this.updateGeyserDisplay();
          this.calculateEstimate();
          this.saveState();
        },

        updateGeyserDisplay() {
          const geyserCost = this.additionalCosts.geyserCount * this.additionalCosts.geyser;
          document.getElementById('geyser-estimated-cost').textContent =
            `Rs. ${(this.currentEstimate + geyserCost).toLocaleString()}`;
        },

        setWaterPump(hasPump) {
          this.additionalCosts.hasWaterPump = hasPump;
          const pumpElements = document.querySelectorAll('#step8 .yes-no-btn');
          pumpElements.forEach(el => el.classList.remove('selected'));

          if (hasPump) {
            document.querySelector('#step8 .yes-no-btn[data-choice="yes"]').classList.add('selected');
          } else {
            document.querySelector('#step8 .yes-no-btn[data-choice="no"]').classList.add('selected');
          }

          this.calculateEstimate();
          this.saveState();
        },

        setInstallation(hasInstallation) {
          this.additionalCosts.hasInstallation = hasInstallation;
          const installElements = document.querySelectorAll('#step9 .yes-no-btn');
          installElements.forEach(el => el.classList.remove('selected'));

          if (hasInstallation) {
            document.querySelector('#step9 .yes-no-btn[data-choice="yes"]').classList.add('selected');
          } else {
            document.querySelector('#step9 .yes-no-btn[data-choice="no"]').classList.add('selected');
          }

          this.calculateEstimate();
          this.saveState();
        }
      };


      // after init, wire up the Reset button
      document.getElementById('reset-btn').addEventListener('click', () => {
        if (confirm('This will clear all your selections and start over. Proceed?')) {
          formState.reset();
        }
      });
      document.getElementById('reset-btn-commercial').addEventListener('click', () => {
        if (confirm('This will clear all your selections and start over. Proceed?')) {
          formState.reset();
        }
      });




      // Initialize form
      formState.init();

      // Step 1: Construction Type
      document.querySelectorAll('#step1 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step1 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          formState.constructionType = this.getAttribute('data-value');
          formState.saveState();
          formState.nextStep();
        });
      });

      // Step 2: City Selection
      document.querySelectorAll('#step2 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step2 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');

          if (this.id === 'other-city') {
            document.getElementById('other-city-input').style.display = 'block';
            formState.city = 'other';
          } else {
            document.getElementById('other-city-input').style.display = 'none';
            formState.city = this.getAttribute('data-value');
          }
          formState.saveState();
        });
      });

      // Other city input
      document.getElementById('other-city-input').addEventListener('input', function () {
        formState.saveState();
      });

      // Step 3: Property Size
      document.querySelectorAll('#step3 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step3 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');

          if (this.id === 'other-size') {
            document.getElementById('other-size-input').style.display = 'block';
            formState.propertySize = 'other';
          } else {
            document.getElementById('other-size-input').style.display = 'none';
            formState.propertySize = this.getAttribute('data-value');
          }

          formState.saveState();
        });
      });

      // Other size input
      document.getElementById('other-size-input').addEventListener('input', function () {
        formState.propertySize = 'other';
        formState.saveState();
      });

      // Step 4: Package Selection
      document.querySelectorAll('#step4 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step4 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          formState.selectedPackage = this.getAttribute('data-value');
          formState.saveState();
        });
      });

      // Room counter buttons
      document.querySelectorAll('.counter-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          const room = this.getAttribute('data-room');
          const isPlus = this.classList.contains('plus');
          formState.updateRoomCount(room, isPlus ? 1 : -1);
        });
      });

      // Geyser counter buttons
      document.getElementById('add-geyser').addEventListener('click', function (e) {
        e.preventDefault();
        formState.updateGeyserCount(1);
      });

      document.getElementById('remove-geyser').addEventListener('click', function (e) {
        e.preventDefault();
        formState.updateGeyserCount(-1);
      });

      // Water pump options
      document.querySelectorAll('#step8 .yes-no-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          const choice = this.getAttribute('data-choice');
          formState.setWaterPump(choice === 'yes');
        });
      });

      // Installation options
      document.querySelectorAll('#step9 .yes-no-btn').forEach(btn => {
        btn.addEventListener('click', function () {
          const choice = this.getAttribute('data-choice');
          formState.setInstallation(choice === 'yes');
        });
      });


      // Step 0: Start (Residential vs Commercial)
      // Step 0: Start (Residential vs Commercial)
      document.querySelectorAll('#step0 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step0 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');

          formState.isCommercial = this.getAttribute('data-value') === 'commercial';
          if (formState.isCommercial) {
            formState.currentStep = 11; // Start commercial flow
          } else {
            formState.currentStep = 1;  // Start residential flow
          }
          formState.updateForm();
          formState.updateProgressBar();
          formState.saveState();
        });
      });

      // Step 11: Commercial Type
      document.querySelectorAll('#step11 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step11 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          formState.commercialType = this.getAttribute('data-value');
          formState.saveState();
          formState.nextStep();
        });
      });

      // Step 12: Commercial City
      // Step 12: Commercial City
      document.querySelectorAll('#step12 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step12 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');

          formState.commercialCity = this.getAttribute('data-value');
          if (this.id === 'other-commercial-city') {
            document.getElementById('other-commercial-city-input').style.display = 'block';
          } else {
            document.getElementById('other-commercial-city-input').style.display = 'none';
          }
          formState.saveState();
          formState.updateSlugs(); // Explicitly update slugs after city selection
        });
      });

      // Step 13: Commercial Size
      document.querySelectorAll('#step13 .option').forEach(option => {
        option.addEventListener('click', function () {
          document.querySelectorAll('#step13 .option').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          formState.commercialSize = this.getAttribute('data-value');
          if (this.id === 'other-commercial-size') {
            document.getElementById('other-commercial-size-input').style.display = 'block';
          } else {
            document.getElementById('other-commercial-size-input').style.display = 'none';
            // Calculate immediately when a predefined size is selected
            formState.calculateCommercialEstimate();
          }
          formState.saveState();
        });
      });

      // Other commercial city input
      document.getElementById('other-commercial-city-input').addEventListener('input', function () {
        formState.commercialCity = 'other';
        formState.calculateCommercialEstimate();
        formState.saveState();
      });

      // Other commercial size input
      document.getElementById('other-commercial-size-input').addEventListener('input', function () {
        formState.commercialSize = 'other';
        formState.calculateCommercialEstimate();
        formState.saveState();
      });
      // Navigation buttons
      document.getElementById('back-btn').addEventListener('click', function () {
        formState.prevStep();
      });

      document.getElementById('next-btn').addEventListener('click', function () {
        const currentStep = formState.currentStep;
        if (currentStep === 13) {
          if (!formState.commercialSize) {
            alert('Please select a property size or enter your size');
            return;
          }
          if (formState.commercialSize === 'other' && !document.getElementById('other-commercial-size-input').value) {
            alert('Please enter your property size');
            return;
          }
          // Calculate the estimate before proceeding
          formState.calculateCommercialEstimate();
        }
        if (currentStep === 2) {
          if (!formState.city) {
            alert('Please select a city or enter your city name');
            return;
          }
          if (formState.city === 'other' && !document.getElementById('other-city-input').value) {
            alert('Please enter your city name');
            return;
          }
        }
        else if (currentStep === 3) {
          if (!formState.propertySize) {
            alert('Please select a property size or enter your size');
            return;
          }
          if (formState.propertySize === 'other' && !document.getElementById('other-size-input').value) {
            alert('Please enter your property size');
            return;
          }
        }

        formState.nextStep();
      });

      // Calculate button (for package selection)
      document.getElementById('calculate-btn').addEventListener('click', function () {
        if (formState.propertySize === '<6marla' && !formState.selectedPackage) {
          alert('Please select a package');
          return;
        }
        formState.nextStep();
      });
    });
  </script>



@endsection