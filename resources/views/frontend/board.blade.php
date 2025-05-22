@extends('frontend.layout.layout')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        position: relative;
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

    /* SVG Pattern Background Styles */
   .pattern-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2; /* Changed from -1 to -2 to ensure it stays behind borders */
        opacity: 0.1;
    }

    .border-animation {
        position: fixed;
        pointer-events: none;
        z-index: -1; /* Changed from 1000 to -1 to be behind content but above background */
    }

    .content-wrapper {
        padding: 4rem;
        position: relative;
        z-index: 1; /* Content stays above everything */
    }
    /* CLIMAX History Page Styles */
    .history-page {
        font-family: 'Times New Roman', serif;
        background-color: #f5f5f5;
        padding: 0;
        position: relative;
        min-height: 100vh;
        overflow-x: hidden;
    }
    
    .border-animation {
        position: fixed;
        pointer-events: none;
        z-index: 1000;
    }
    #top-border, #bottom-border {
        width: 100%;
        height: 20px;
        left: 0;
    }
    #top-border {
        top: 0;
    }
    #bottom-border {
        bottom: 0;
    }
    #left-border, #right-border {
        height: 100%;
        width: 20px;
        top: 0;
    }
    #left-border {
        left: 0;
    }
    #right-border {
        right: 0;
    }
    
    .content-wrapper {
        padding: 4rem;
        position: relative;
        z-index: 1;
    }
    
    .climax-title {
        font-size: 3.5rem;
        font-weight: bold;
        margin: 1.5rem 0;
        color: #2c3e50;
        text-transform: uppercase;
        position: relative;
    }
    

</style>

<!-- SVG Patterns (hidden) -->
<svg width="0" height="0" style="position: absolute;">
    <!-- Dot pattern -->
    <pattern id="subtle-dots" width="20" height="20" patternUnits="userSpaceOnUse">
        <circle cx="10" cy="10" r="1" fill="#2c3e50" fill-opacity="0.1"/>
    </pattern>
    
    <!-- Diagonal lines pattern -->
    <pattern id="diagonal-lines" width="10" height="10" patternUnits="userSpaceOnUse">
        <path d="M-1,1 l2,-2 M0,10 l10,-10 M9,11 l2,-2" stroke="#2c3e50" stroke-width="0.5" stroke-opacity="0.1"/>
    </pattern>
    
    <!-- Geometric triangle pattern -->
    <pattern id="geometric-triangles" width="20" height="20" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
        <polygon points="10,0 20,20 0,20" fill="none" stroke="#2c3e50" stroke-width="0.5" stroke-opacity="0.1"/>
    </pattern>
</svg>

<!-- Pattern Background (can be placed anywhere in your layout) -->
<svg class="pattern-bg" viewBox="0 0 100 100" preserveAspectRatio="none">
    <rect width="100%" height="100%" fill="url(#geometric-triangles)"/>
</svg>

<!-- CLIMAX History Page Content -->
<div class="history-page">
    <!-- Animated SVG borders -->
    <svg class="border-animation" id="top-border" viewBox="0 0 1200 20" preserveAspectRatio="none">
        <path d="M0,10 L1200,10" stroke="#2c3e50" stroke-width="2" stroke-dasharray="10,5" fill="none">
            <animate attributeName="stroke-dashoffset" from="15" to="0" dur="5s" repeatCount="indefinite"/>
        </path>
    </svg>
    
    <svg class="border-animation" id="right-border" viewBox="0 0 20 800" preserveAspectRatio="none">
        <path d="M10,0 L10,800" stroke="#2c3e50" stroke-width="2" stroke-dasharray="10,5" fill="none">
            <animate attributeName="stroke-dashoffset" from="15" to="0" dur="5s" repeatCount="indefinite"/>
        </path>
    </svg>
    
    <svg class="border-animation" id="bottom-border" viewBox="0 0 1200 20" preserveAspectRatio="none">
        <path d="M0,10 L1200,10" stroke="#2c3e50" stroke-width="2" stroke-dasharray="10,5" fill="none">
            <animate attributeName="stroke-dashoffset" from="15" to="0" dur="5s" repeatCount="indefinite"/>
        </path>
    </svg>
    
    <svg class="border-animation" id="left-border" viewBox="0 0 20 800" preserveAspectRatio="none">
        <path d="M10,0 L10,800" stroke="#2c3e50" stroke-width="2" stroke-dasharray="10,5" fill="none">
            <animate attributeName="stroke-dashoffset" from="15" to="0" dur="5s" repeatCount="indefinite"/>
        </path>
    </svg>

    <div class="content-wrapper">
        <div class="container">
            <div class="header text-center mb-5">
                <h1 style="letter-spacing: 5px;">OUR</h1>
                <h2 style="text-decoration: underline; font-weight: 300;">HISTORY</h2>
            </div>
            
            <div class="history-section text-center my-5">
                <h3>FOUNDER OF</h3>
                <div class="climax-title">CLIMAX</div>
                <div class="climax-title">CLIMAX</div>
                <div class="climax-title">CLIMAX</div>
                <h3>CHAIRMAN</h3>
            </div>
            
            <div class="company-info text-center mt-5">
                <h4>FICO IN TECH (PVT) LTD</h4>
                <p class="mt-3">M. To a-bear content the journey we both by founder of CLIMAX and</p>
                <p>fICO</p>
            </div>
        </div>
    </div>
    

</div>

<!-- Bootstrap 5.3 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection