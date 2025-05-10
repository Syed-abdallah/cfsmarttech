<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Login Page</title>
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
        
        .login-form {
            width: 85%;
            max-width: 450px;
            padding: 2.5rem;
            border-radius: 20px;
            /* background: rgba(255, 255, 255, 0.9); */
            /* backdrop-filter: blur(var(--glass-blur));
            -webkit-backdrop-filter: blur(var(--glass-blur)); */
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            z-index: 2;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-form:hover {
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
        
        .btn-login {
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
        
        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .btn-login::after {
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
        
        .btn-login:hover::after {
            left: 100%;
        }
        
        .image-section {
    background: url('frontend/images/p14.jpg') center/cover no-repeat;
    position: relative;
    width: 100%;
    max-width: 677px; /* Maximum width */
    height: 650px; /* Fixed height */
}
        
        /* .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(125deg, rgba(46, 46, 53, 0.85) 0%, rgba(79, 70, 229, 0.9) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 3rem;
            text-align: center;
        } */
        
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
        .social-login .btn {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 8px;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.1);
            color: rgb(41, 19, 19);
            border: 1px solid rgba(22, 27, 27, 0.2);
        }
        
        .social-login .btn:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
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
            /* backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px); */
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
            
            .login-form {
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
                
                <div class="login-form">
                    <div class="text-center ">
                        <img src="{{asset('frontend/images/logo1.png')}}" alt="" class="mb-3" style="width: 100px; height: 100px;">
                        {{-- <h2 class="fw-bold mb-2">Welcome Back</h2>
                        <p class="text-muted">Enter your details to access your account</p> --}}
                    </div>
                    
                    <!-- Social Login Buttons -->
                  
                    
                    <!-- Divider -->
                    <div class="divider">
                        <span class="divider-text">CF Smart Technologies</span>
                    </div>
                    <h3 class="font-bold text-center">CF Smart Customer</h3>
                    @if(session('status'))
                    <div style="color: green; margin-bottom: 1rem;">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('cfcustomer.login') }}">
                    @csrf
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id="email" placeholder="YourEmail@gmail.com"  name="email" value="{{ old('email') }}" autofocus required>
                            <label for="email" class="floating-label">Email address</label>
                            @if($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="current-password" required>
                            <label for="password" class="floating-label">Password</label>
                            @if($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" id="remember_me" type="checkbox" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            {{-- <a href="#" class="text-decoration-none text-primary">Forgot password?</a> --}}
                            @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('cfcustomer.password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-login w-100 mb-3">Sign In</button>
                        <p class="text-center mt-3">Don't have an account? <a href="/register" class="text-decoration-none fw-bold text-primary">Sign up</a></p>
                    </form>
                    <div class="social-login text-center mb-4">
                        <button class="btn">
                            <i class="fab fa-google"></i>
                        </button>
                        <button class="btn">
                            <i class="fab fa-apple"></i>
                        </button>
                        <button class="btn">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Image Section -->
            <div class="col-lg-6 col-md-12 image-section p-0 d-none d-lg-block">
                <div class="image-overlay">
                    <div class="mb-5">
                        {{-- <h1 class="display-4 fw-bold mb-3">Unlock New Possibilities</h1> --}}
                        {{-- <p class="lead mb-4 opacity-75">Join thousands of satisfied users experiencing our premium platform</p> --}}
                    </div> 
                    
                 <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="feature-card">
                                <h3>10K+</h3>
                                <p>Active Users</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <h3>99.9%</h3>
                                <p>Uptime</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <h3>24/7</h3>
                                <p>Support</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="feature-card">
                                <h3>100+</h3>
                                <p>Features</p>
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
        // Add ripple effect to login button
        document.querySelector('.btn-login').addEventListener('click', function(e) {
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
    </script>
</body>
</html>