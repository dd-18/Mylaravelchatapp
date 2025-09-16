@extends('layouts.public')

@section('title', 'Login')
@section('meta_description', 'Sign in to ' . config('app.name', 'ChatApp') . ' - Access your secure messaging account.')

@section('content')
    <!-- Login Section -->
    <section class="auth-section d-flex align-items-center justify-content-center position-relative overflow-hidden" 
             style="min-height: 100vh; background: linear-gradient(135deg, #0d6efd, #0b5ed7);">
        
        <!-- Background Elements -->
        <div class="auth-bg position-absolute top-0 start-0 w-100 h-100" aria-hidden="true">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>
        </div>

        <!-- Login Card -->
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" data-aos="fade-up">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="auth-icon mb-3">
                                <div class="icon-wrapper bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <i class="bi bi-chat-dots-fill text-primary fs-1"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark mb-2">Welcome Back!</h2>
                            <p class="text-muted">Sign in to continue your conversations</p>
                            
                            <!-- Quick Stats -->
                            <div class="welcome-stats d-flex justify-content-center gap-4 mt-3 mb-2">
                                <div class="stat-item text-center">
                                    <div class="fw-bold text-primary">10k+</div>
                                    <small class="text-muted">Users</small>
                                </div>
                                <div class="stat-item text-center">
                                    <div class="fw-bold text-success">99.9%</div>
                                    <small class="text-muted">Uptime</small>
                                </div>
                                <div class="stat-item text-center">
                                    <div class="fw-bold text-info">50ms</div>
                                    <small class="text-muted">Speed</small>
                                </div>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="auth-form">
                            @csrf
                            
                            <!-- Email -->
                            <div class="form-floating mb-3" data-aos="fade-up" data-aos-delay="100">
                                <input type="email" 
                                       name="email" 
                                       class="form-control auth-input @error('email') is-invalid @enderror"
                                       id="email"
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus
                                       placeholder="Email Address">
                                <label for="email">
                                    <i class="bi bi-envelope me-2"></i>Email Address
                                </label>
                                @error('email') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3 position-relative" data-aos="fade-up" data-aos-delay="150">
                                <input type="password" 
                                       name="password" 
                                       class="form-control auth-input @error('password') is-invalid @enderror"
                                       id="password"
                                       required 
                                       placeholder="Password">
                                <label for="password">
                                    <i class="bi bi-lock me-2"></i>Password
                                </label>
                                <button type="button" class="btn-toggle-password" data-target="#password">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                                @error('password') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up" data-aos-delay="200">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label text-muted small" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-primary text-decoration-none small fw-medium">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-4" data-aos="fade-up" data-aos-delay="250">
                                <button type="submit" class="btn btn-primary btn-lg auth-submit">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Sign In
                                    <div class="btn-shine"></div>
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="divider text-center mb-4" data-aos="fade-up" data-aos-delay="300">
                                <span class="divider-text bg-white px-3 text-muted small">New to {{ config('app.name') }}?</span>
                            </div>

                            <!-- Register Link -->
                            <div class="d-grid" data-aos="fade-up" data-aos-delay="350">
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg auth-secondary">
                                    <i class="bi bi-person-plus me-2"></i>
                                    Create Account
                                </a>
                            </div>
                        </form>

                        <!-- Error Display for Blocked Users -->
                        @if(session('errors') && session('errors')->has('email'))
                            <div class="alert alert-danger mt-3 alert-modern" data-aos="shake">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ session('errors')->first('email') }}
                            </div>
                        @endif

                        <!-- Security Notice -->
                        <div class="security-notice text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="d-flex justify-content-center align-items-center gap-2 text-muted small">
                                <i class="bi bi-shield-lock text-success"></i>
                                <span>Secured with 256-bit encryption</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Auth Section Background */
        .auth-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 50%, #6f42c1 100%);
            position: relative;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape-4 {
            width: 40px;
            height: 40px;
            top: 30%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Auth Card */
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Auth Icon */
        .icon-wrapper {
            width: 80px;
            height: 80px;
            position: relative;
        }

        .icon-wrapper::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, var(--bs-primary), var(--bs-info));
            border-radius: 50%;
            z-index: -1;
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        /* Welcome Stats */
        .welcome-stats .stat-item {
            background: rgba(var(--bs-primary-rgb), 0.1);
            padding: 8px 12px;
            border-radius: 12px;
            min-width: 60px;
        }

        /* Form Inputs */
        .auth-input {
            border: 2px solid rgba(13, 110, 253, 0.1);
            border-radius: 12px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .auth-input:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            background: white;
        }

        .form-floating label {
            color: var(--bs-gray-600);
            font-weight: 500;
        }

        /* Password Toggle */
        .btn-toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--bs-gray-500);
            font-size: 1.1rem;
            padding: 5px;
            border-radius: 4px;
            transition: color 0.2s ease;
            z-index: 10;
        }

        .btn-toggle-password:hover {
            color: var(--bs-primary);
        }

        /* Submit Button */
        .auth-submit {
            position: relative;
            overflow: hidden;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
            transition: all 0.3s ease;
        }

        .auth-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
        }

        /* Secondary Button */
        .auth-secondary {
            border: 2px solid var(--bs-primary);
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .auth-secondary:hover {
            background: var(--bs-primary);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .auth-submit:hover .btn-shine {
            left: 100%;
        }

        /* Divider */
        .divider {
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(13, 110, 253, 0.2), transparent);
        }

        .divider-text {
            position: relative;
            z-index: 1;
        }

        /* Alert Modern */
        .alert-modern {
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
            border-left: 4px solid var(--bs-danger);
        }

        /* Security Notice */
        .security-notice {
            padding: 12px;
            background: rgba(25, 135, 84, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(25, 135, 84, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-section {
                padding: 2rem 0;
            }
            
            .auth-card {
                margin: 1rem;
                padding: 2rem 1.5rem !important;
            }
            
            .icon-wrapper {
                width: 60px;
                height: 60px;
            }

            .welcome-stats {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            .welcome-stats .stat-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: left;
            }
        }

        /* Loading State */
        .auth-submit.loading {
            pointer-events: none;
        }

        .auth-submit.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-form > div {
            animation: slideInUp 0.6s ease forwards;
        }

        /* Focus States */
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Hover Effects */
        .auth-card {
            transition: transform 0.3s ease;
        }

        .auth-section:hover .auth-card {
            transform: translateY(-5px);
        }
    </style>
@endpush