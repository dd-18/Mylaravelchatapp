@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --gray-50: #f9fafb;
        --gray-100: #f1f5f9;
        --gray-300: #cbd5e1;
        --gray-600: #475569;
        --gray-700: #374151;
        --red-500: #ef4444;
        --green-500: #10b981;
        --white: #ffffff;
        --border: #e5e7eb;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        position: relative;
    }

    .auth-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        pointer-events: none;
    }

    .auth-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: var(--shadow);
        width: 100%;
        max-width: 420px;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .auth-header {
        text-align: center;
        padding: 2.5rem 2rem 0;
    }

    .auth-logo {
        width: 60px;
        height: 60px;
        background: var(--primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.5rem;
    }

    .auth-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-700);
        margin: 0 0 0.5rem;
    }

    .auth-subtitle {
        color: var(--gray-600);
        margin: 0 0 2rem;
        font-size: 1rem;
    }

    .auth-body {
        padding: 0 2rem 2.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid var(--gray-300);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.2s ease;
        background: var(--white);
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--red-500);
    }

    .form-control.is-valid {
        border-color: var(--green-500);
    }

    .invalid-feedback {
        color: var(--red-500);
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1.5rem 0;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin: 0;
        cursor: pointer;
        accent-color: var(--primary);
    }

    .form-check-label {
        color: var(--gray-600);
        cursor: pointer;
        font-size: 0.95rem;
        user-select: none;
    }

    .btn-primary {
        width: 100%;
        padding: 0.875rem 1.5rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-bottom: 1.5rem;
        font-family: inherit;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .divider {
        text-align: center;
        margin: 1.5rem 0;
        position: relative;
        color: var(--gray-600);
        font-size: 0.875rem;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--gray-300);
    }

    .divider span {
        background: var(--white);
        padding: 0 1rem;
        position: relative;
    }

    .text-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .text-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .text-center {
        text-align: center;
    }

    .loading-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 0.5rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 480px) {
        .auth-container {
            padding: 0;
        }
        
        .auth-card {
            border-radius: 0;
            min-height: 100vh;
            max-width: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .auth-header {
            padding: 2rem 1.5rem 0;
        }
        
        .auth-body {
            padding: 0 1.5rem 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-chat-dots"></i>
            </div>
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to your ChatApp account</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="email" 
                        autofocus
                        placeholder="Enter your email"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="remember">
                        Remember me for 30 days
                    </label>
                </div>

                <button type="submit" class="btn-primary" id="loginBtn">
                    Sign In
                </button>

                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="text-link" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </div>
                @endif
            </form>

            @if (Route::has('register'))
                <div class="divider">
                    <span>New to ChatApp?</span>
                </div>
                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-link">
                        Create a free account
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const originalText = loginBtn.textContent;

    form.addEventListener('submit', function(e) {
        loginBtn.disabled = true;
        loginBtn.innerHTML = '<div class="loading-spinner"></div>Signing in...';
        
        setTimeout(() => {
            loginBtn.disabled = false;
            loginBtn.textContent = originalText;
        }, 5000);
    });

    // Form validation feedback
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value && this.validity.valid) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                if (this.validity.valid) {
                    this.classList.remove('is-invalid');
                }
            }
        });
    });
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
