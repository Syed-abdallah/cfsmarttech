<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CF Smart Technologies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <style>
        body{
                font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>


    @include('frontend.layout.marque')

    @include('frontend.layout.navbar')

    @yield('content')


    @include('frontend.layout.footer')


    <script>
        const isLoggedIn = {{ Auth::guard('customer')->check() ? 'true' : 'false' }};
        setupCheckoutPage();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/script.js') }}"></script>
    <script src="{{ asset('frontend/calscript.js') }}"></script>


    <script>
        AOS.init({
            once: false // ✅ this must be *inside* the object
        });
    </script>
    <script>
        const cards = document.querySelectorAll('.product-card');
        let current = 3;

        function activate(idx) {
            // Toggle active class
            cards.forEach(c => c.classList.remove('active'));
            const card = cards[idx];
            card.classList.add('active');

            // Update hero image & text from data-attributes
            const heroImg = document.getElementById('hero-img');
            const heroText = document.getElementById('hero-text');
            heroImg.src = card.getAttribute('data-hero-img');
            heroText.textContent = card.getAttribute('data-hero-text');
        }

        // Auto-rotate
        setInterval(() => {
            current = (current + 1) % cards.length;
            activate(current);
        }, 6500);

        // Hover to select
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                current = +card.dataset.index;
                activate(current);
            });
        });

        // Initialize on load
        activate(current);
    </script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const card = document.getElementById("small-card");
        const closeBtn = document.querySelector(".small-card-close");

        // Check if it was previously dismissed
        const dismissed = localStorage.getItem("cardDismissed");

        if (dismissed === "true") {
            card.style.display = "none";
        }

        closeBtn.addEventListener("click", function () {
            card.style.display = "none";
            localStorage.setItem("cardDismissed", "true");
        });
    });
</script>

</body>

</html>
