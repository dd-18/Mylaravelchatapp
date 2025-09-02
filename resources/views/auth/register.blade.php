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
        max-width: 480px;
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

    .password-requirements {
        font-size: 0.8rem;
        color: var(--gray-600);
        margin-top: 0.25rem;
    }

    .file-upload-area {
        border: 2px dashed var(--gray-300);
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
        background: var(--gray-50);
    }

    .file-upload-area:hover {
        border-color: var(--primary);
        background: var(--white);
    }

    .file-upload-area.dragover {
        border-color: var(--primary);
        background: rgba(59, 130, 246, 0.05);
    }

    .file-upload-icon {
        font-size: 2rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .file-upload-text {
        color: var(--gray-600);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .file-upload-subtext {
        color: var(--gray-600);
        font-size: 0.8rem;
    }

    .file-selected {
        color: var(--green-500);
        font-weight: 500;
        margin-top: 0.5rem;
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
        }
        
        .auth-header {
            padding: 2rem 1.5rem 0;
        }
        
        .auth-body {
            padding: 0 1.5rem 2rem;
            flex: 1;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-person-plus"></i>
            </div>
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-subtitle">Join ChatApp and start messaging</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input 
                        id="name" 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autocomplete="name" 
                        autofocus
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Enter your email address"
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
                        autocomplete="new-password"
                        placeholder="Create a strong password"
                    >
                    <div class="password-requirements">
                        Must be at least 8 characters long
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input 
                        id="password-confirm" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Profile Picture (Optional)</label>
                    <div class="file-upload-area" onclick="document.getElementById('user_image').click()">
                        <div class="file-upload-icon">
                            <i class="bi bi-camera"></i>
                        </div>
                        <div class="file-upload-text">Click to upload your photo</div>
                        <div class="file-upload-subtext">JPG, PNG or GIF (max. 2MB)</div>
                        <div class="file-selected" id="fileSelected" style="display: none;"></div>
                        <input 
                            id="user_image" 
                            type="file" 
                            class="@error('user_image') is-invalid @enderror" 
                            name="user_image" 
                            accept="image/*"
                            style="display: none;"
                        >
                    </div>
                    @error('user_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary" id="registerBtn">
                    Create Account
                </button>
            </form>

            @if (Route::has('login'))
                <div class="divider">
                    <span>Already have an account?</span>
                </div>
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-link">
                        Sign in here
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');
    const originalText = registerBtn.textContent;
    const fileInput = document.getElementById('user_image');
    const fileSelected = document.getElementById('fileSelected');
    const uploadArea = document.querySelector('.file-upload-area');

    // Form submission
    form.addEventListener('submit', function(e) {
        registerBtn.disabled = true;
        registerBtn.innerHTML = '<div class="loading-spinner"></div>Creating account...';
        
        setTimeout(() => {
            registerBtn.disabled = false;
            registerBtn.textContent = originalText;
        }, 5000);
    });

    // File upload handling
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileSelected.textContent = `Selected: ${file.name}`;
            fileSelected.style.display = 'block';
        } else {
            fileSelected.style.display = 'none';
        }
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            const file = files[0];
            fileSelected.textContent = `Selected: ${file.name}`;
            fileSelected.style.display = 'block';
        }
    });

    // Form validation
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

    // Password confirmation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password-confirm');

    function validatePasswords() {
        if (confirmPassword.value && password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
            confirmPassword.classList.add('is-invalid');
            confirmPassword.classList.remove('is-valid');
        } else if (confirmPassword.value) {
            confirmPassword.setCustomValidity('');
            confirmPassword.classList.add('is-valid');
            confirmPassword.classList.remove('is-invalid');
        }
    }

    password.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);
});
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
