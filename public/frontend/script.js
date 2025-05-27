

// Add this to your existing JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });
    }

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Newsletter form submission
    const newsletterForm = document.querySelector('.footer-newsletter form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            if (emailInput.value) {
                // Here you would typically send the data to your server
                alert('Thank you for subscribing to our newsletter!');
                emailInput.value = '';
            }
        });
    }
});






// Navbar and marquee behavior on scroll
let lastScroll = 0;
const marquee = document.getElementById('marquee');
const navbar = document.getElementById('navbar');

window.addEventListener('scroll', function () {
    const currentScroll = window.scrollY;

    // Navbar background change
    if (currentScroll > 50) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }

    // Marquee hide/show logic
    if (currentScroll > 100) { // Hide marquee when scrolled down 100px
        marquee.classList.add('hidden');
        navbar.classList.add('marquee-hidden');
    } else { // Show marquee when near top
        marquee.classList.remove('hidden');
        navbar.classList.remove('marquee-hidden');
    }

    lastScroll = currentScroll;
});



// dark light mode
// Dark mode functionality
// document.addEventListener('DOMContentLoaded', function() {
//   const themeToggle = document.getElementById('themeToggle');
//   const icon = themeToggle.querySelector('i');

//   // Check for saved user preference or use system preference
//   const savedTheme = localStorage.getItem('theme');
//   const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

//   // Apply the initial theme
//   if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
//     document.body.classList.add('dark-mode');
//     icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
//   }

//   // Toggle theme when button is clicked
//   themeToggle.addEventListener('click', function() {
//     document.body.classList.toggle('dark-mode');

//     if (document.body.classList.contains('dark-mode')) {
//       icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
//       localStorage.setItem('theme', 'dark');
//     } else {
//       icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
//       localStorage.setItem('theme', 'light');
//     }
//   });

//   // Watch for system preference changes
//   window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
//     if (!localStorage.getItem('theme')) {
//       if (e.matches) {
//         document.body.classList.add('dark-mode');
//         icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
//       } else {
//         document.body.classList.remove('dark-mode');
//         icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
//       }
//     }
//   });
// });



// AOS.init();



document.addEventListener('DOMContentLoaded', () => {
    const card = document.getElementById('small-card');
    const closeBtn = card.querySelector('.small-card-close');

    // show the card after 50 seconds
    setTimeout(() => {
        card.style.display = 'block';
        card.classList.add('fade-in-up');
    }, 4000);

    // hide card when close button is clicked
    closeBtn.addEventListener('click', () => {
        card.style.display = 'none';
    });
    setTimeout(() => {
        const card = document.querySelector('.small-card');
        if (!card) return;

        // CSS shake:
        card.classList.add('vibrate');

        // device vibration (if supported):
        if (navigator.vibrate) {
            navigator.vibrate([200, 100, 200]);
        }
    }, 3000);
});



/*-----------------------------------------------------------------------------------------------------------


    //   single item page js 



-------------------------------------------------------------------------------------------------------------
   */




AOS.init({
    once: false
});

// Global cart and stock management
let cart = JSON.parse(localStorage.getItem('cart')) || {};
let currentStock = JSON.parse(localStorage.getItem('stock')) || {};

// DOM elements that exist on multiple pages
const cartCount = document.getElementById('cart-count');
const cartSummary = document.getElementById('cart-summary');
const cartEmpty = document.getElementById('cart-empty');
const cartItems = document.getElementById('cart-items');
const cartItemsContainer = document.getElementById('cart-items-container');
const cartTotal = document.getElementById('cart-total');
const checkoutItems = document.getElementById('checkout-items');
const checkoutSubtotal = document.getElementById('checkout-subtotal');
const checkoutTotal = document.getElementById('checkout-total');

// Constants
const DELIVERY_CHARGE = 0;
// const FREE_SHIPPING_THRESHOLD = 500;
// const TAX_RATE = 0.10; // 10% tax
const TAX_RATE = 0; // 10% tax

// Initialize the page when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Initialize cart dropdown if it exists on the page
    if (document.getElementById('cart-dropdown')) {
        const cartDropdown = new bootstrap.Dropdown(document.getElementById('cart-dropdown'));
        setupCartDropdownBehavior();
    }

    // Setup add to cart buttons if they exist
    if (document.querySelectorAll('.add-to-cart').length > 0) {
        setupAddToCartButtons();
    }

    // Initialize stock display if it exists
    if (document.querySelector('.stock-status')) {
        updateStockDisplay();
    }

    // Update cart display
    updateCartDisplay();

    // Setup checkout page if it exists
    if (document.querySelector('.checkout-container')) {
        setupCheckoutPage();
    }
});





// Setup all Add to Cart buttons
function setupAddToCartButtons() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const product = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image,
                stock: parseInt(this.dataset.stock),
                quantity: 1
            };

            addToCart(product);
        });
    });
}

// Add item to cart with stock validation
function addToCart(product) {
    // Check if product already exists in cart
    if (cart[product.id]) {
        // Validate stock
        if (cart[product.id].quantity >= product.stock) {
            showToast(`Only ${product.stock} available in stock!`, 'error');
            return;
        }
        cart[product.id].quantity += 1;
    } else {
        cart[product.id] = product;
    }

    // Update stock
    currentStock[product.id] = product.stock - cart[product.id].quantity;
    localStorage.setItem('stock', JSON.stringify(currentStock));

    saveCart();
    showToast(`${product.name} added to cart`, 'success');
    // Open the cart dropdown automatically
    const cartDropdownElement = document.getElementById('cart-dropdown');
    if (cartDropdownElement) {
        const cartDropdown = bootstrap.Dropdown.getInstance(cartDropdownElement) ||
            new bootstrap.Dropdown(cartDropdownElement);
        cartDropdown.show();
    }
}

// Save cart to localStorage and update UI
// function saveCart() {
//     localStorage.setItem('cart', JSON.stringify(cart));
//     updateCartDisplay();


//     if (document.querySelector('.stock-status')) {
//         updateStockDisplay();
//     }
// }




function logCartDetails() {
    const cartData = JSON.parse(localStorage.getItem('cart')) || {};
    const stockData = JSON.parse(localStorage.getItem('stock')) || {};

    console.log("===== CART DETAILS =====");

    // Log each product in the cart
    Object.values(cartData).forEach(product => {
        console.log(`Product ID: ${product.id}`);
        console.log(`Name: ${product.name}`);
        console.log(`Price: $${product.price.toFixed(2)}`);
        console.log(`Quantity in Cart: ${product.quantity}`);
        console.log(`Total for this product: $${(product.price * product.quantity).toFixed(2)}`);
        console.log(`Original Stock: ${product.stock}`);
        console.log(`Remaining Stock: ${stockData[product.id] || product.stock}`);
        console.log("----------------------");
    });

    // Calculate and log totals
    const subtotal = Object.values(cartData).reduce((sum, product) =>
        sum + (product.price * product.quantity), 0);
    const tax = subtotal * TAX_RATE;
    const shipping = subtotal > 0 ? DELIVERY_CHARGE : 0;
    const total = subtotal + tax + shipping;

    console.log(`Subtotal: $${subtotal.toFixed(2)}`);
    console.log(`Tax (${TAX_RATE * 100}%): $${tax.toFixed(2)}`);
    console.log(`Shipping: $${shipping.toFixed(2)}`);
    console.log(`Total: $${total.toFixed(2)}`);
    console.log("======================");
}

// Then modify your saveCart function to call this:
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    localStorage.setItem('stock', JSON.stringify(currentStock));
    updateCartDisplay();
    logCartDetails();

    // Update stock display if on product page
    if (document.querySelector('.stock-status')) {
        updateStockDisplay();
    }
}




// Update all cart-related UI elements
function updateCartDisplay() {
    const cartItemsArray = Object.values(cart);
    const itemCount = cartItemsArray.reduce((total, item) => total + item.quantity, 0);

    // Update cart count badge if it exists
    if (cartCount) {
        cartCount.textContent = itemCount;
        cartCount.style.display = itemCount > 0 ? 'block' : 'none';
    }

    // Update cart summary if it exists
    if (cartSummary) {
        cartSummary.textContent = `${itemCount} ${itemCount === 1 ? 'item' : 'items'}`;
    }

    // Update cart dropdown if it exists
    if (cartEmpty && cartItems) {
        if (itemCount === 0) {
            cartEmpty.classList.remove('d-none');
            cartItems.classList.add('d-none');
        } else {
            cartEmpty.classList.add('d-none');
            cartItems.classList.remove('d-none');

            // Calculate subtotal
            const subtotal = cartItemsArray.reduce((total, item) => total + (item.price * item.quantity), 0);

            // Update cart items list
            if (cartItemsContainer) {
                renderCartItems(cartItemsArray, cartItemsContainer, true);
            }

            // Update cart total if it exists
            if (cartTotal) {
                cartTotal.textContent = `$${subtotal.toFixed(2)}`;
            }
        }
    }

    // Update checkout items if on checkout page
    if (checkoutItems) {
        const subtotal = cartItemsArray.reduce((total, item) => total + (item.price * item.quantity), 0);
        renderCartItems(cartItemsArray, checkoutItems, false);
        updateCheckoutSummary(subtotal);
    }
}

// Render cart items in specified container
function renderCartItems(items, container, showControls) {
    container.innerHTML = '';

    items.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = showControls ? 'dropdown-item py-2' : 'cart-item mb-3';

        itemElement.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="${item.image}" alt="${item.name}" width="${showControls ? 50 : 70}" height="${showControls ? 50 : 70}" class="rounded me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-0">${item.name}</h6>
                    ${showControls ?
                `<small class="text-muted">${item.quantity} × $${item.price.toFixed(2)}</small>
                       <div class="d-flex align-items-center mt-1">
                           <button class="btn btn-sm btn-outline-secondary decrease-quantity" data-id="${item.id}" style="padding: 0.15rem 0.5rem;">
                               <i class="bi bi-dash"></i>
                           </button>
                           <span class="mx-2">${item.quantity}</span>
                           <button class="btn btn-sm btn-outline-secondary increase-quantity" data-id="${item.id}" style="padding: 0.15rem 0.5rem;">
                               <i class="bi bi-plus"></i>
                           </button>
                       </div>` :
                `<p class="text-muted small mb-1">Qty: ${item.quantity}</p>`
            }
                </div>
                <div class="text-end">
                    <strong>$${(item.price * item.quantity).toFixed(2)}</strong>
                    ${showControls ?
                `<button class="btn btn-sm btn-outline-danger remove-item d-block mt-1 w-100" data-id="${item.id}">
                          <i class="bi bi-trash"></i> Remove
                      </button>` : ''
            }
                </div>
            </div>
        `;
        container.appendChild(itemElement);
    });

    // Add event listeners if controls are shown
    if (showControls) {
        setupQuantityControls();
    }
}

// Setup quantity increase/decrease controls
function setupQuantityControls() {
    document.querySelectorAll('.increase-quantity').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const itemId = this.dataset.id;

            // Check stock before increasing
            if (cart[itemId].quantity >= cart[itemId].stock) {
                showToast(`Only ${cart[itemId].stock} available in stock!`, 'error');
                return;
            }

            cart[itemId].quantity += 1;
            currentStock[itemId] = cart[itemId].stock - cart[itemId].quantity;
            localStorage.setItem('stock', JSON.stringify(currentStock));
            saveCart();
        });
    });

    document.querySelectorAll('.decrease-quantity').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const itemId = this.dataset.id;

            if (cart[itemId].quantity > 1) {
                cart[itemId].quantity -= 1;
                currentStock[itemId] = cart[itemId].stock - cart[itemId].quantity;
                localStorage.setItem('stock', JSON.stringify(currentStock));
                saveCart();
            }
        });
    });

    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const itemId = this.dataset.id;

            // Return stock when removing item
            currentStock[itemId] = cart[itemId].stock;
            localStorage.setItem('stock', JSON.stringify(currentStock));

            delete cart[itemId];
            saveCart();
            showToast('Item removed from cart', 'warning');
        });
    });
}

// Update stock display on product page
function updateStockDisplay() {
    const stockStatusElement = document.querySelector('.stock-status');
    const productId = document.querySelector('.add-to-cart')?.dataset.id;

    if (productId && stockStatusElement) {
        const addToCartBtn = document.querySelector('.add-to-cart[data-id="' + productId + '"]');
        const availableStock = currentStock[productId] !== undefined ?
            currentStock[productId] :
            parseInt(addToCartBtn.dataset.stock);

        if (availableStock > 0) {
            stockStatusElement.innerHTML = `<i class="bi bi-check-circle-fill"></i> In Stock (${availableStock} available)`;
            stockStatusElement.className = 'stock-status in-stock';

            // Enable add to cart button
            addToCartBtn.disabled = false;
            addToCartBtn.style.opacity = '1';
        } else {
            stockStatusElement.innerHTML = '<i class="bi bi-x-circle-fill"></i> Out of Stock';
            stockStatusElement.className = 'stock-status out-of-stock';

            // Disable add to cart button
            addToCartBtn.disabled = true;
            addToCartBtn.style.opacity = '0.5';
        }
    }
}

// Update checkout summary
function updateCheckoutSummary(subtotal) {
    // Calculate shipping
    // let shipping = subtotal < FREE_SHIPPING_THRESHOLD && subtotal > 0 ? DELIVERY_CHARGE : 0;
    let shipping = subtotal < subtotal > 0 ? DELIVERY_CHARGE : 0;

    // Calculate tax
    const tax = subtotal * TAX_RATE;

    // Update display
    if (checkoutSubtotal) checkoutSubtotal.textContent = `$${subtotal.toFixed(2)}`;
    if (document.getElementById('shipping-cost')) {
        document.getElementById('shipping-cost').textContent = shipping > 0 ? `$${shipping.toFixed(2)}` : 'FREE';
    }
    if (document.getElementById('tax-amount')) {
        document.getElementById('tax-amount').textContent = `$${tax.toFixed(2)}`;
    }
    if (checkoutTotal) checkoutTotal.textContent = `$${(subtotal + shipping + tax).toFixed(2)}`;
}

// Setup cart dropdown behavior
function setupCartDropdownBehavior() {
    const cartDropdownMenu = document.getElementById('cart-dropdown-menu');

    if (cartDropdownMenu) {
        // Prevent dropdown from closing when clicking inside
        cartDropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        // Make dropdown responsive on mobile
        function handleMobileDropdown() {
            if (window.innerWidth < 992) {
                cartDropdownMenu.style.position = 'fixed';
                cartDropdownMenu.style.top = '60px';
                cartDropdownMenu.style.right = '15px';
                cartDropdownMenu.style.left = '15px';
                cartDropdownMenu.style.width = 'auto';
                cartDropdownMenu.style.maxWidth = '350px';
                cartDropdownMenu.style.margin = '0 auto';
            } else {
                cartDropdownMenu.style.position = '';
                cartDropdownMenu.style.top = '';
                cartDropdownMenu.style.right = '';
                cartDropdownMenu.style.left = '';
                cartDropdownMenu.style.width = '';
                cartDropdownMenu.style.maxWidth = '';
                cartDropdownMenu.style.margin = '';
            }
        }

        window.addEventListener('resize', handleMobileDropdown);
        handleMobileDropdown();










    }
}

// ----------------------------------------------Check out page------------------------------------------------------------------------



// ----------------------------------------------Check out page-------------------------------------------------------------------------


// Setup checkout page functionality
// function setupCheckoutPage() {
//     // Check if user is logged in (you would replace this with actual auth check)
//     const isLoggedIn = true; // Change to false to test login prompt

//     const loginPrompt = document.getElementById('login-prompt');
//     const addressSection = document.getElementById('address-section');

//     if (loginPrompt && addressSection) {
//         if (isLoggedIn) {
//             loginPrompt.classList.add('d-none');
//             addressSection.classList.remove('d-none');
//             loadAddresses();
//         } else {
//             loginPrompt.classList.remove('d-none');
//             addressSection.classList.add('d-none');
//         }
//     }

//     // Setup payment method selection
//     setupPaymentOptions();

//     // Setup address management
//     setupAddressManagement();
// }


function setupCheckoutPage() {
    const loginPrompt = document.getElementById('login-prompt');
    const addressSection = document.getElementById('address-section');

    if (loginPrompt && addressSection) {
        if (isLoggedIn) {
            loginPrompt.classList.add('d-none');
            addressSection.classList.remove('d-none');
            loadAddresses();
        } else {
            loginPrompt.classList.remove('d-none');
            addressSection.classList.add('d-none');
        }
    }

    // Setup payment method selection
    setupPaymentOptions();

    // Setup address management
    setupAddressManagement();
}




// Setup payment method selection
function setupPaymentOptions() {
    const codOption = document.getElementById('cod-option');
    const paypalOption = document.getElementById('paypal-option');
    const codRadio = document.getElementById('cod');
    const paypalRadio = document.getElementById('paypal');
    const paypalForm = document.getElementById('paypal-form');

    if (codOption && paypalOption) {
        // COD option
        codOption.addEventListener('click', function (e) {
            if (e.target.tagName !== 'INPUT') {
                codRadio.checked = true;
                if (paypalForm) paypalForm.style.display = 'none';
                updatePaymentOptionStyles();
            }
        });

        // PayPal option
        paypalOption.addEventListener('click', function (e) {
            if (e.target.tagName !== 'INPUT') {
                paypalRadio.checked = true;
                if (paypalForm) paypalForm.style.display = 'block';
                updatePaymentOptionStyles();
            }
        });

        // Radio button changes
        if (codRadio) codRadio.addEventListener('change', updatePaymentOptionStyles);
        if (paypalRadio) paypalRadio.addEventListener('change', updatePaymentOptionStyles);
    }

    function updatePaymentOptionStyles() {
        if (codOption && paypalOption) {
            if (document.querySelector('input[name="payment-method"]:checked').value === 'cod') {
                codOption.classList.add('selected');
                paypalOption.classList.remove('selected');
                if (paypalForm) paypalForm.style.display = 'none';
            } else {
                codOption.classList.remove('selected');
                paypalOption.classList.add('selected');
                if (paypalForm) paypalForm.style.display = 'block';
            }
        }
    }
}

// Setup address management
function setupAddressManagement() {
    const addressCards = document.getElementById('address-cards');
    const addAddressBtn = document.getElementById('add-address-btn');
    const newAddressForm = document.getElementById('new-address-form');
    const addressForm = document.getElementById('address-form');
    const cancelAddressBtn = document.getElementById('cancel-address-btn');
    const placeOrderBtn = document.getElementById('place-order-btn');

    if (addAddressBtn && newAddressForm) {
        // Show new address form
        addAddressBtn.addEventListener('click', function () {
            newAddressForm.classList.remove('d-none');
            addAddressBtn.classList.add('d-none');
            resetAddressForm();
        });

        // Cancel adding/editing address
        cancelAddressBtn.addEventListener('click', function () {
            newAddressForm.classList.add('d-none');
            addAddressBtn.classList.remove('d-none');
            resetAddressForm();
        });
    }

    if (addressForm) {
        // Submit address form
        addressForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const addressData = {
                id: this.dataset.editingId ? parseInt(this.dataset.editingId) : Date.now(),
                fullName: document.getElementById('full-name').value,
                phone: document.getElementById('phone').value,
                line1: document.getElementById('address-line1').value,
                line2: document.getElementById('address-line2').value,
                city: document.getElementById('city').value,
                state: document.getElementById('state').value,
                zip: document.getElementById('zip').value,
                country: document.getElementById('country').value,
                isDefault: document.getElementById('default-address').checked
            };

            // In a real app, you would save this to your backend
            showToast(this.dataset.editingId ? "Address updated successfully" : "Address added successfully", 'success');

            // Close form and reload addresses
            newAddressForm.classList.add('d-none');
            addAddressBtn.classList.remove('d-none');
            loadAddresses();
        });
    }

    if (placeOrderBtn) {
        // Place order button click
        placeOrderBtn.addEventListener('click', function () {
            // Check if address is selected
            if (!document.querySelector('.address-card.selected')) {
                showToast("Please select a shipping address", 'warning');
                return;
            }

            // Check payment method
            const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

            if (paymentMethod === 'paypal') {
                const email = document.getElementById('paypal-email').value;
                const cardNumber = document.getElementById('card-number').value;
                const expiry = document.getElementById('expiry-date').value;
                const cvv = document.getElementById('cvv').value;

                if (!email || !cardNumber || !expiry || !cvv) {
                    showToast("Please complete all payment details", 'warning');
                    return;
                }
            }

            // Process order
            processOrder();
        });
    }
}

// Load sample addresses
// function loadAddresses() {
//     const addressCards = document.getElementById('address-cards');
//     if (!addressCards) return;

//     // In a real app, this would come from your backend
//     const sampleAddresses = [
//         {
//             id: 1,
//             fullName: "John Doe",
//             phone: "+1 (123) 456-7890",
//             line1: "123 Main St",
//             line2: "Apt 4B",
//             city: "New York",
//             state: "NY",
//             zip: "10001",
//             country: "US",
//             isDefault: true
//         },
//         {
//             id: 2,
//             fullName: "John Doe",
//             phone: "+1 (123) 456-7890",
//             line1: "456 Second Ave",
//             line2: "",
//             city: "Brooklyn",
//             state: "NY",
//             zip: "11201",
//             country: "US",
//             isDefault: false
//         }
//     ];

//     // Clear existing addresses
//     addressCards.innerHTML = '';

//     // Add each address as a card
//     sampleAddresses.forEach(address => {
//         const addressCard = document.createElement('div');
//         addressCard.className = `col-12 address-card ${address.isDefault ? 'selected' : ''}`;
//         addressCard.dataset.id = address.id;
//         addressCard.innerHTML = `
//             <div class="d-flex justify-content-between align-items-start">
//                 <div>
//                     <h5 class="mb-2">${address.fullName}</h5>
//                     <p class="mb-1 text-muted small">${address.line1}${address.line2 ? ', ' + address.line2 : ''}</p>
//                     <p class="mb-1 text-muted small">${address.city}, ${address.state} ${address.zip}</p>
//                     <p class="mb-1 text-muted small">${getCountryName(address.country)}</p>
//                     <p class="mb-0 text-muted small">${address.phone}</p>
//                 </div>
//                 <div>
//                     ${address.isDefault ? '<span class="badge default-badge">Default</span>' : ''}
//                 </div>
//             </div>
//             <div class="mt-3 d-flex justify-content-end gap-2">
//                 <button class="btn btn-sm btn-outline-secondary edit-address" data-id="${address.id}">
//                     <i class="bi bi-pencil"></i> Edit
//                 </button>
//                 ${!address.isDefault ? `
//                 <button class="btn btn-sm btn-outline-danger delete-address" data-id="${address.id}">
//                     <i class="bi bi-trash"></i> Delete
//                 </button>
//                 ` : ''}
//             </div>
//         `;
//         addressCards.appendChild(addressCard);

//         // Add click handler to select address
//         addressCard.addEventListener('click', function(e) {
//             // Don't select if clicking edit/delete buttons
//             if (!e.target.closest('.edit-address') && !e.target.closest('.delete-address')) {
//                 document.querySelectorAll('.address-card').forEach(card => {
//                     card.classList.remove('selected');
//                 });
//                 this.classList.add('selected');
//                 updateCheckoutSummary();
//             }
//         });
//     });

//     // Add event listeners for edit/delete buttons
//     document.querySelectorAll('.edit-address').forEach(btn => {
//         btn.addEventListener('click', function(e) {
//             e.stopPropagation();
//             const addressId = parseInt(this.dataset.id);
//             editAddress(addressId);
//         });
//     });

//     document.querySelectorAll('.delete-address').forEach(btn => {
//         btn.addEventListener('click', function(e) {
//             e.stopPropagation();
//             const addressId = parseInt(this.dataset.id);
//             deleteAddress(addressId);
//         });
//     });
// }








// Get country name from code
// function getCountryName(code) {
//     const countries = {
//         'US': 'United States',
//         'CA': 'Canada',
//         'UK': 'United Kingdom',
//         'PK': 'Pakistan'
//     };
//     return countries[code] || code;
// }

// Edit an existing address
// function editAddress(addressId) {
//     // In a real app, you would fetch this from your backend
//     const addressToEdit = {
//         id: 1,
//         fullName: "John Doe",
//         phone: "+1 (123) 456-7890",
//         line1: "123 Main St",
//         line2: "Apt 4B",
//         city: "New York",
//         state: "NY",
//         zip: "10001",
//         country: "US",
//         isDefault: true
//     };

//     // Populate form with address data
//     document.getElementById('full-name').value = addressToEdit.fullName;
//     document.getElementById('phone').value = addressToEdit.phone;
//     document.getElementById('address-line1').value = addressToEdit.line1;
//     document.getElementById('address-line2').value = addressToEdit.line2;
//     document.getElementById('city').value = addressToEdit.city;
//     document.getElementById('state').value = addressToEdit.state;
//     document.getElementById('zip').value = addressToEdit.zip;
//     document.getElementById('country').value = addressToEdit.country;
//     document.getElementById('default-address').checked = addressToEdit.isDefault;

//     // Set editing mode
//     addressForm.dataset.editingId = addressId;
//     newAddressForm.classList.remove('d-none');
//     addAddressBtn.classList.add('d-none');
// }

// Delete an address
// function deleteAddress(addressId) {
//     // Confirm deletion
//     if (confirm("Are you sure you want to delete this address?")) {
//         showToast("Address deleted successfully", 'success');
//         loadAddresses();
//     }
// }












async function loadAddresses() {
    const addressCards = document.getElementById('address-cards');
    if (!addressCards) return;

    const response = await fetch('/cfcustomer/addresses');
    const addresses = await response.json();

    addressCards.innerHTML = '';

    addresses.forEach(address => {
        const addressCard = document.createElement('div');
        addressCard.className = `col-12 address-card ${address.is_default ? 'selected' : ''}`;
        addressCard.dataset.id = address.id;
        addressCard.innerHTML = `
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h5 class="mb-2">${address.full_name}</h5>
            <p class="mb-1 text-muted small">${address.address_line1}${address.address_line2 ? ', ' + address.address_line2 : ''}</p>
            <p class="mb-1 text-muted small">${address.city}, ${address.state} ${address.zip}</p>
            <p class="mb-1 text-muted small">${getCountryName(address.country)}</p>
            <p class="mb-0 text-muted small">${address.phone}</p>
          
        </div>
        <div>
            ${address.is_default
                ? '<span class="badge bg-success">Default</span>'
                : ''}
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-end gap-2">
        <button class="btn btn-sm btn-outline-secondary edit-address" data-id="${address.id}">
            <i class="bi bi-pencil"></i> Edit
        </button>
        ${!address.is_default
                ? `
            <button class="btn btn-sm btn-outline-danger delete-address" data-id="${address.id}">
                <i class="bi bi-trash"></i> Delete
            </button>
            <form action="/cfcustomer/addresses/${address.id}/set-default" method="POST" style="display:inline;">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-star"></i> Set Default
                </button>
            </form>
            `
                : ''}
    </div>
`;



        addressCards.appendChild(addressCard);

        addressCard.addEventListener('click', function (e) {
            if (!e.target.closest('.edit-address') && !e.target.closest('.delete-address')) {
                document.querySelectorAll('.address-card').forEach(card => card.classList.remove('selected'));
                this.classList.add('selected');
                updateCheckoutSummary();
            }
        });
    });

    addButtonHandlers();
}

function addButtonHandlers() {
    document.querySelectorAll('.edit-address').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const addressId = this.dataset.id;
            editAddress(addressId);
        });
    });

    // document.querySelectorAll('.delete-address').forEach(btn => {
    //     btn.addEventListener('click', async function (e) {
    //         e.stopPropagation();
    //         const addressId = this.dataset.id;
    //         await deleteAddress(addressId);
    //     });
    // });
    document.querySelectorAll('.delete-address').forEach(btn => {
    btn.addEventListener('click', async function (e) {
        e.stopPropagation();
        const addressId = this.dataset.id;

        // Confirm deletion (optional)
        if (!confirm('Are you sure you want to delete this address?')) return;

        const success = await deleteAddress(addressId); // Should return true on success
        if (success) {
            // Remove the entire card from the DOM
            const addressCard = this.closest('.address-card');
            if (addressCard) addressCard.remove();
        }
    });
});

}

// async function deleteAddress(id) {
//     const response = await fetch(`/cfcustomer/addresses/${id}`, {
//         method: 'DELETE',
//         headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
//     });
//     const result = await response.json();
//     if (result.message) {
//         alert(result.message);
//                 location.reload();

//         loadAddresses();
//     }
// }

async function deleteAddress(id) {
    try {
        const response = await fetch(`/cfcustomer/addresses/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        });

        if (response.ok) {
            return true;
        } else {
            console.error('Delete failed');
            return false;
        }
    } catch (error) {
        console.error('Error deleting address:', error);
        return false;
    }
}


function getCountryName(code) {
    const countries = {
        US: 'United States',
        CA: 'Canada',
        PK: 'Pakistan',
        // Add more as needed
    };
    return countries[code] || code;
}




document.getElementById('address-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/customer/addresses/${id}` : '/customer/addresses';

    const response = await fetch(url, {
        method: method,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    });

    const result = await response.json();
    if (result.success || result.id) {
        alert('Address saved successfully.');
        loadAddresses();
    }
});




document.querySelectorAll('.set-default').forEach(btn => {
    btn.addEventListener('click', async function (e) {
        e.stopPropagation();
        const addressId = this.dataset.id;

        try {
            const response = await fetch(`/customer/addresses/${addressId}/toggle-default`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (result.success) {
                showToast(result.message, 'success');
                loadAddresses(); // Reload addresses to update UI
            } else {
                showToast(result.message || 'Failed to update address', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('An error occurred', 'error');
        }
    });
});


















// Reset address form
function resetAddressForm() {
    if (addressForm) {
        addressForm.reset();
        delete addressForm.dataset.editingId;
    }
}

// Process the order
// function processOrder() {
//     const placeOrderBtn = document.getElementById('place-order-btn');
//     if (!placeOrderBtn) return;

//     // Show loading state
//     placeOrderBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
//     placeOrderBtn.disabled = true;

//     // Simulate API call
//     setTimeout(() => {
//         // Success message
//         showToast("Order placed successfully!", 'success');

//         // Clear cart
//         cart = {};
//         currentStock = {};
//         localStorage.removeItem('cart');
//         localStorage.removeItem('stock');
//         updateCartDisplay();

//         // Reset button
//         placeOrderBtn.innerHTML = '<i class="bi bi-shield-lock me-2"></i> Place Order Securely';
//         placeOrderBtn.disabled = false;
//     }, 2000);
// }











async function processOrder() {
    const placeOrderBtn = document.getElementById('place-order-btn');
    if (!placeOrderBtn) return;

    // Validate required fields
    const selectedAddress = document.querySelector('.address-card.selected');
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked');
    // const paymentMethod = 'bank_transfer'; 
    const paymentSlipInput = document.getElementById('payment-slip');

    if (!selectedAddress) {
        showToast("Please select a shipping address", 'warning');
        return;
    }

    if (!paymentMethod) {
        showToast("Please select a payment method", 'warning');
        return;
    }

    if (paymentMethod.value === 'bank_transfer' && !paymentSlipInput.files[0]) {
        showToast("Please upload payment slip for bank transfer", 'warning');
        return;
    }

    // Show loading state
    placeOrderBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
    placeOrderBtn.disabled = true;

    try {
        // Prepare form data
        const formData = new FormData();
        formData.append('payment_method', paymentMethod.value);
        formData.append('shipping_address_id', selectedAddress.dataset.id);
        formData.append('cart', JSON.stringify(Object.values(cart)));

        if (paymentMethod.value === 'bank_transfer' && paymentSlipInput.files[0]) {
            formData.append('payment_slip', paymentSlipInput.files[0]);
        }

        // Submit to Laravel backend
        const response = await fetch('/orders', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Success message
            showToast("Order placed successfully!", 'success');

            // Clear cart
            cart = {};
            currentStock = {};
            localStorage.removeItem('cart');
            localStorage.removeItem('stock');
            updateCartDisplay();

          

            setTimeout(function () {
                window.location.reload();

            }, 2000);
        } else {
            // Show error message from server or default message
            showToast(result.message || "Failed to place order", 'error');
        }
    } catch (error) {
        console.error('Error submitting order:', error);
        showToast("An error occurred while placing your order", 'error');
    } finally {
        // Reset button state
        placeOrderBtn.innerHTML = '<i class="bi bi-shield-lock me-2"></i> Place Order Securely';
        placeOrderBtn.disabled = false;
    }
}

// Update your place order button event listener to use this function
document.getElementById('place-order-btn')?.addEventListener('click', processOrder);















// Show toast notification
function showToast(message, type = 'success') {
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8'
    };

    Toastify({
        text: message,
        duration: 3000,
        // close: true,
        gravity: "top",
        position: "right",
        backgroundColor: colors[type],
        stopOnFocus: true,
        className: "toast-animated",
           style: {
            borderRadius: '12px', // Larger border radius
            marginTop: '30px'    // Note: camelCase for CSS properties in JS
        },
    }).showToast();
}





document.getElementById('place-order-btn').addEventListener('click', async function () {


    console.log('Place Order button clicked');

    const placeOrderBtn = this;
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;
    const paymentSlipInput = document.getElementById('payment-slip');
    const addressId = document.querySelector('.address-card.selected')?.dataset.id;

    // Validate
    if (!addressId) {
        showToast("Please select a shipping address", 'warning');
        return;
    }

    if (paymentMethod === 'bank_transfer' && !paymentSlipInput.files[0]) {
        showToast("Please upload payment slip for bank transfer", 'warning');
        return;
    }

    // Prepare form data
    const formData = new FormData();
    formData.append('payment_method', paymentMethod);
    formData.append('shipping_address_id', addressId);
    formData.append('cart', JSON.stringify(Object.values(cart)));

    if (paymentMethod === 'bank_transfer' && paymentSlipInput.files[0]) {
        formData.append('payment_slip', paymentSlipInput.files[0]);
    }

    // Show loading
    placeOrderBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
    placeOrderBtn.disabled = true;

    try {
        const response = await fetch('/orders', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showToast("Order placed successfully!", 'success');

            // Clear cart
            cart = {};
            currentStock = {};
            localStorage.removeItem('cart');
            localStorage.removeItem('stock');
            updateCartDisplay();

            // Redirect to order confirmation page
            window.location.href = `/orders/${result.order_id}`;
        } else {
            showToast("Failed to place order: " + (result.message || 'Unknown error'), 'error');
        }
    } catch (error) {
        showToast("An error occurred while placing order", 'error');
        console.error('Error:', error);
    } finally {
        placeOrderBtn.innerHTML = '<i class="bi bi-shield-lock me-2"></i> Place Order Securely';
        placeOrderBtn.disabled = false;
    }
});




















// document.addEventListener('DOMContentLoaded', function () {
//     const formState = {
//         commercialPrices: {},
//            roomPrices: {},
    
//         updatePrices(newPrices) {
//             this.commercialPrices = { ...this.commercialPrices, ...newPrices };
//                 this.roomPrices = { ...data.roomPrices };
         
//         }
//     };

//     // AJAX Call using jQuery
//     $.ajax({
//         url: '/prices', // Make sure this route returns JSON
//         method: 'GET',
//         success: function (data) {
//             formState.updatePrices(data);
//         },
//         error: function (xhr, status, error) {
//             console.error('Error fetching prices:', error);
//         }
//     });
// });
