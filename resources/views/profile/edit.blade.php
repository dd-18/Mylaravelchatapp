@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #2563eb;
        --gray-50: #f9fafb;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --white: #ffffff;
        --green-500: #10b981;
        --red-500: #ef4444;
        --border: #e5e7eb;
        --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    body {
        background: var(--gray-50);
        font-family: 'Inter', sans-serif;
        color: var(--gray-800);
    }

    .profile-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .profile-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        padding: 2.5rem;
        width: 100%;
        max-width: 500px;
    }

    .profile-title {
        font-size: 1.75rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        color: var(--gray-800);
    }

    .profile-image-section {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--border);
        margin-bottom: 1rem;
        transition: border-color 0.2s ease;
    }

    .profile-image-section:hover .profile-image {
        border-color: var(--primary);
    }

    .file-upload-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
        max-width: 300px;
    }

    .file-upload-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px dashed var(--border);
        border-radius: 10px;
        background: var(--gray-100);
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    .file-upload-custom:hover {
        border-color: var(--primary);
        background: var(--white);
        color: var(--primary);
    }

    .file-upload-custom input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.2s ease;
        background: var(--white);
        color: var(--gray-800);
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

    .invalid-feedback {
        color: var(--red-500);
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--green-500);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .btn-close {
        opacity: 0.7;
    }

    .btn-close:hover {
        opacity: 1;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.875rem 1.5rem;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        border: none;
        font-family: inherit;
        min-width: 120px;
    }

    .btn-primary {
        background: var(--primary);
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        color: var(--white);
        text-decoration: none;
    }

    .btn-outline-secondary {
        background: transparent;
        color: var(--gray-600);
        border: 2px solid var(--border);
    }

    .btn-outline-secondary:hover {
        background: var(--gray-100);
        color: var(--gray-800);
        border-color: var(--gray-300);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .password-hint {
        font-size: 0.8rem;
        color: var(--gray-500);
        font-weight: 400;
    }

    .selected-file {
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--green-500);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .profile-container {
            padding: 1rem;
        }

        .profile-card {
            padding: 2rem 1.5rem;
        }

        .profile-title {
            font-size: 1.5rem;
        }

        .profile-image {
            width: 100px;
            height: 100px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <h3 class="profile-title">Edit Profile</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
            @csrf

            <!-- Profile Image Section -->
            <div class="profile-image-section">
                <img src="{{ Auth::user()->user_image 
                    ? asset('storage/users/' . Auth::user()->user_image) 
                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="Profile Picture" 
                    class="profile-image"
                    id="profileImagePreview">

                <div class="file-upload-wrapper">
                    <label class="file-upload-custom">
                        <i class="fa fa-camera me-2"></i>Change Profile Picture
                        <input type="file" 
                               name="user_image" 
                               class="@error('user_image') is-invalid @enderror"
                               accept="image/*"
                               id="profileImageInput">
                    </label>
                    <div class="selected-file" id="selectedFileName" style="display: none;"></div>
                    @error('user_image')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Name Field -->
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" 
                       name="name" 
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', Auth::user()->name) }}" 
                       required
                       placeholder="Enter your full name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', Auth::user()->email) }}" 
                       required
                       placeholder="Enter your email address">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">
                    New Password
                    <span class="password-hint">(leave blank to keep current password)</span>
                </label>
                <input type="password" 
                       name="password" 
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter new password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation"
                       class="form-control"
                       placeholder="Confirm new password">
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i>
                    Back to Chat
                </a>
                <button type="submit" class="btn btn-primary" id="saveBtn">
                    <i class="fa fa-save"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImagePreview = document.getElementById('profileImagePreview');
    const selectedFileName = document.getElementById('selectedFileName');
    const form = document.getElementById('profileForm');
    const saveBtn = document.getElementById('saveBtn');
    const originalBtnText = saveBtn.innerHTML;

    // Image preview functionality
    profileImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
            
            // Show selected filename
            selectedFileName.textContent = `Selected: ${file.name}`;
            selectedFileName.style.display = 'block';
        } else {
            selectedFileName.style.display = 'none';
        }
    });

    // Form submission handler
    form.addEventListener('submit', function(e) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Saving...';
        
        // Reset button after 10 seconds if form doesn't redirect
        setTimeout(() => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalBtnText;
        }, 10000);
    });

    // Form validation feedback
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value && this.validity.valid) {
                this.style.borderColor = 'var(--green-500)';
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                if (this.validity.valid) {
                    this.classList.remove('is-invalid');
                    this.style.borderColor = 'var(--border)';
                }
            }
        });
    });

    // Password confirmation validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');

    function validatePasswords() {
        if (confirmPassword.value && password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
            confirmPassword.style.borderColor = 'var(--red-500)';
        } else {
            confirmPassword.setCustomValidity('');
            if (confirmPassword.value && password.value === confirmPassword.value) {
                confirmPassword.style.borderColor = 'var(--green-500)';
            } else {
                confirmPassword.style.borderColor = 'var(--border)';
            }
        }
    }

    password.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);
});
</script>
@endsection
