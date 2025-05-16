
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
  