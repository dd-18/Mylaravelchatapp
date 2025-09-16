@extends('layouts.public')

@section('title', 'Register')
@section('meta_description', 'Join ' . config('app.name', 'ChatApp') . ' - Create your account and start secure messaging today.')

@section('content')
    <!-- Registration Section -->
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

        <!-- Registration Card -->
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-card card border-0 shadow-lg p-4 p-md-5" data-aos="fade-up">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="auth-icon mb-3">
                                <div class="icon-wrapper bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-plus-fill text-primary fs-1"></i>
                                </div>
                            </div>
                            <h2 class="fw-bold text-dark mb-2">Create Your Account</h2>
                            <p class="text-muted">Join {{ config('app.name', 'ChatApp') }} and start secure messaging</p>
                            
                            <!-- Trust Indicators -->
                            <div class="trust-badges d-flex justify-content-center gap-3 mt-3 mb-2">
                                <div class="trust-badge">
                                    <i class="bi bi-shield-check text-success me-1"></i>
                                    <small>Secure</small>
                                </div>
                                <div class="trust-badge">
                                    <i class="bi bi-lightning-charge text-warning me-1"></i>
                                    <small>Fast Setup</small>
                                </div>
                                <div class="trust-badge">
                                    <i class="bi bi-check-circle text-info me-1"></i>
                                    <small>Free Trial</small>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="auth-form">
                            @csrf
                            
                            <!-- Full Name -->
                            <div class="form-floating mb-3" data-aos="fade-up" data-aos-delay="100">
                                <input type="text" 
                                       name="name" 
                                       class="form-control auth-input @error('name') is-invalid @enderror"
                                       id="name"
                                       value="{{ old('name') }}" 
                                       required 
                                       placeholder="Full Name">
                                <label for="name">
                                    <i class="bi bi-person me-2"></i>Full Name
                                </label>
                                @error('name') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-floating mb-3" data-aos="fade-up" data-aos-delay="150">
                                <input type="email" 
                                       name="email" 
                                       class="form-control auth-input @error('email') is-invalid @enderror"
                                       id="email"
                                       value="{{ old('email') }}" 
                                       required 
                                       placeholder="Email Address">
                                <label for="email">
                                    <i class="bi bi-envelope me-2"></i>Email Address
                                </label>
                                @error('email') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3 position-relative" data-aos="fade-up" data-aos-delay="200">
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
                                <div class="password-strength mt-2">
                                    <div class="strength-bar">
                                        <div class="strength-fill"></div>
                                    </div>
                                    <small class="strength-text text-muted">Password strength</small>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-floating mb-3 position-relative" data-aos="fade-up" data-aos-delay="250">
                                <input type="password" 
                                       name="password_confirmation" 
                                       class="form-control auth-input"
                                       id="password_confirmation"
                                       required 
                                       placeholder="Confirm Password">
                                <label for="password_confirmation">
                                    <i class="bi bi-shield-check me-2"></i>Confirm Password
                                </label>
                                <button type="button" class="btn-toggle-password" data-target="#password_confirmation">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>

                            <!-- Profile Picture -->
                            <div class="mb-4" data-aos="fade-up" data-aos-delay="300">
                                <label class="form-label fw-medium">
                                    <i class="bi bi-camera me-2"></i>Profile Picture <small class="text-muted">(Optional)</small>
                                </label>
                                <div class="file-upload-wrapper">
                                    <input type="file" 
                                           name="user_image" 
                                           class="form-control file-input"
                                           id="user_image"
                                           accept="image/*">
                                    <div class="file-upload-display">
                                        <i class="bi bi-cloud-upload text-primary fs-3 mb-2"></i>
                                        <p class="mb-0">Click to upload or drag & drop</p>
                                        <small class="text-muted">PNG, JPG up to 5MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms & Privacy -->
                            <div class="mb-4" data-aos="fade-up" data-aos-delay="350">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted small" for="terms">
                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and 
                                        <a href="#" class="text-primary">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3" data-aos="fade-up" data-aos-delay="400">
                                <button type="submit" class="btn btn-primary btn-lg auth-submit">
                                    <i class="bi bi-rocket-takeoff me-2"></i>
                                    Create Account
                                    <div class="btn-shine"></div>
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center" data-aos="fade-up" data-aos-delay="450">
                                <p class="text-muted mb-0">
                                    Already have an account? 
                                    <a href="{{ route('login') }}" class="text-primary fw-medium text-decoration-none">
                                        Sign in
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </p>
                            </div>
                        </form>
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

        /* Trust Badges */
        .trust-badge {
            background: rgba(var(--bs-success-rgb), 0.1);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            color: var(--bs-dark);
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

        /* Password Strength */
        .password-strength {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-strength.show {
            opacity: 1;
        }

        .strength-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; }
        .strength-fair { background: #fd7e14; }
        .strength-good { background: #198754; }
        .strength-strong { background: #20c997; }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            border: 2px dashed rgba(13, 110, 253, 0.3);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: rgba(13, 110, 253, 0.02);
            transition: all 0.3s ease;
        }

        .file-upload-wrapper:hover {
            border-color: var(--bs-primary);
            background: rgba(13, 110, 253, 0.05);
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
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
    </style>
@endpush

@push('scripts')
    <!-- AOS (Animate on Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true
        });

        // Password Toggle Functionality
        document.querySelectorAll('.btn-toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const target = document.querySelector(toggle.getAttribute('data-target'));
                const icon = toggle.querySelector('i');
                
                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    target.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            });
        });

        // Password Strength Checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.querySelector('.strength-fill');
        const strengthText = document.querySelector('.strength-text');
        const strengthContainer = document.querySelector('.password-strength');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            
            if (password.length > 0) {
                strengthContainer.classList.add('show');
                updateStrengthBar(strength);
            } else {
                strengthContainer.classList.remove('show');
            }
        });

        function checkPasswordStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            return score;
        }

        function updateStrengthBar(strength) {
            const percentage = (strength / 5) * 100;
            strengthBar.style.width = percentage + '%';
            
            strengthBar.className = 'strength-fill';
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Weak password';
                strengthText.className = 'strength-text text-danger';
            } else if (strength <= 3) {
                strengthBar.classList.add('strength-fair');
                strengthText.textContent = 'Fair password';
                strengthText.className = 'strength-text text-warning';
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-good');
                strengthText.textContent = 'Good password';
                strengthText.className = 'strength-text text-success';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Strong password';
                strengthText.className = 'strength-text text-success';
            }
        }

        // File Upload Enhancement
        const fileInput = document.getElementById('user_image');
        const fileUploadDisplay = document.querySelector('.file-upload-display');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                fileUploadDisplay.innerHTML = `
                    <i class="bi bi-check-circle text-success fs-3 mb-2"></i>
                    <p class="mb-0 fw-medium">${fileName}</p>
                    <small class="text-muted">File selected successfully</small>
                `;
            }
        });

        // Form Animation Delays
        document.addEventListener('DOMContentLoaded', function() {
            const formElements = document.querySelectorAll('.auth-form > div');
            formElements.forEach((element, index) => {
                element.style.animationDelay = (index * 0.1) + 's';
            });
        });
    </script>
@endpush