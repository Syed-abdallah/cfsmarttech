

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration | CF Smart Technologies</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --glass-blur: 12px;
        }
        html , body{
            overflow: hidden;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .split-container {
            height: 100vh;
        }
        
        .form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .form-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.1);
            top: -100px;
            left: -100px;
            z-index: 1;
        }
        
        .form-section::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.1);
            bottom: -50px;
            right: -50px;
            z-index: 1;
        }
        
        .register-form {
            width: 85%;
            max-width: 450px;
            padding: 2.5rem;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            z-index: 2;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
        }
        
        .register-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .form-control {
            padding: 14px 20px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.8);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            background: white;
        }
        
        .input-group-text {
            background: transparent;
            border-right: none;
        }
        
        .form-floating>.form-control:not(:placeholder-shown)~label {
            transform: scale(0.85) translateY(-1.5rem) translateX(0.15rem);
            color: var(--primary-color);
        }
        
        .btn-register {
            background-color: var(--primary-color);
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-register:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .btn-register::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(30deg);
            transition: all 0.3s;
        }
        
        .btn-register:hover::after {
            left: 100%;
        }
        
        .image-section {
            background: url('frontend/images/p14.jpg') center/cover no-repeat;
            position: relative;
            width: 100%;
            max-width: 677px;
            height: 650px;
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(125deg, rgba(46, 46, 53, 0.7) 0%, rgba(79, 70, 229, 0.75) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 3rem;
            text-align: center;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .divider-text {
            padding: 0 15px;
            color: #6c757d;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        .floating-label {
            color: #6c757d;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin: 10px;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.25);
        }
        
        .feature-card h3 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .feature-card p {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 992px) {
            .split-container {
                flex-direction: column;
                height: auto;
            }
            
            .form-section, .image-section {
                width: 100% !important;
                min-height: 100vh;
            }
            
            .image-section {
                min-height: 400px;
            }
            
            .register-form {
                margin: 2rem 0;
                width: 90%;
            }
        }
        
        /* Animated background elements */
        .bg-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(95, 97, 231, 0.05);
            z-index: 0;
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            60% { transform: translateY(-37px); }
        }
        
        .floating {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="container-fluid split-container p-0">
        <div class="row g-0 h-100">
            <!-- Form Section -->
            <div class="col-lg-6 col-md-12 form-section p-0 position-relative">
                <!-- Animated background elements -->
                <div class="bg-element" style="width: 150px; height: 150px; top: 20%; left: 10%;"></div>
                <div class="bg-element floating" style="width: 80px; height: 80px; top: 60%; left: 15%; animation-delay: 1s;"></div>
                <div class="bg-element floating" style="width: 100px; height: 100px; top: 30%; right: 10%; animation-delay: 2s;"></div>
                
                <div class="register-form">
                    <div class="text-center">
                        <img src="{{asset('frontend/images/logo1.png')}}" alt="" class="mb-3" style="width: 100px; height: 100px;">
                    
                        <p class="text-muted">Create your admin account</p>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('cfcustomer.register') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                            <label for="name" class="floating-label">Full Name</label>
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        
                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                            <label for="email" class="floating-label">Email Address</label>
                            @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        
                        <!-- Password -->
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                            <label for="password" class="floating-label">Password</label>
                            @if($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        
                        <!-- Confirm Password -->
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password_confirmation" class="floating-label">Confirm Password</label>
                        </div>
                        
                        <!-- Admin Secret Key (if needed) -->
                        {{-- <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="admin_key" name="admin_key" placeholder="Admin Secret Key" required>
                            <label for="admin_key" class="floating-label">Admin Secret Key</label>
                            <small class="text-muted">Required for admin registration</small>
                            @if($errors->has('admin_key'))
                                <div class="error">{{ $errors->first('admin_key') }}</div>
                            @endif
                        </div> --}}
                        
                        <button type="submit" class="btn btn-primary btn-register w-100 mb-3">Register</button>
                        
                        <p class="text-center mt-3">Already have an account? 
                            <a href="{{ url('login') }}" class="text-decoration-none fw-bold text-primary">Sign in</a>
                        </p>
                    </form>
                </div>
            </div>
            
            <!-- Image Section -->
            <div class="col-lg-6 col-md-12 image-section p-0 d-none d-lg-block">
                <div class="image-overlay">
                    <div class="mb-5">
                        {{-- <h1 class="display-4 fw-bold mb-3">Admin Dashboard Access</h1> --}}
                        <p class="lead mb-4 opacity-75">Register for Authorize Yourself</p>
                    </div> 
                    
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="feature-card">
                                <i class="fas fa-shield-alt fa-2x mb-3"></i>
                                <h3>Secure</h3>
                                <p>Enterprise-grade security</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <i class="fas fa-tachometer-alt fa-2x mb-3"></i>
                                <h3>Powerful</h3>
                                <p>Full system control</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <i class="fas fa-chart-line fa-2x mb-3"></i>
                                <h3>Analytics</h3>
                                <p>Detailed insights</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <i class="fas fa-users-cog fa-2x mb-3"></i>
                                <h3>Management</h3>
                                <p>User & system controls</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add ripple effect to register button
        document.querySelector('.btn-register').addEventListener('click', function(e) {
            let x = e.clientX - e.target.getBoundingClientRect().left;
            let y = e.clientY - e.target.getBoundingClientRect().top;
            
            let ripple = document.createElement('span');
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 1000);
        });
        
        // Password strength indicator (optional)
        document.getElementById('password').addEventListener('input', function() {
            let password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            // You can add visual feedback for password strength here
        });
    </script>
</body>
</html>