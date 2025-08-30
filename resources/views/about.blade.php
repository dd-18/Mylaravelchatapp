@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="about-hero">
        <h1>About ChatApp</h1>
        <p>
            ChatApp is a modern, secure, and real-time messaging platform built with Laravel, MySQL, and Socket.io.
            Connect with friends, share images, emojis, and chat seamlessly anywhere, anytime.
        </p>
    </div>

    <!-- Features Section -->
    <div class="row g-4 about-features mb-5">
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Real-Time Messaging</h5>
                <p class="card-text">Send and receive messages instantly with Socket.io and Laravel Echo for real-time updates.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Online/Offline Status</h5>
                <p class="card-text">Know when your friends are online or offline with real-time status updates.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Typing Indicator</h5>
                <p class="card-text">See when someone is typing, making conversations interactive and engaging.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Emojis & Images</h5>
                <p class="card-text">Express yourself with emojis and share images directly in chat.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Profile Management</h5>
                <p class="card-text">Edit your profile, change avatars, and personalize your chat experience easily.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 h-100 shadow-sm">
                <h5 class="card-title fw-bold">Admin Panel</h5>
                <p class="card-text">Admins can monitor messages, delete inappropriate content, and manage users safely.</p>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-3">Our Mission</h2>
        <p class="text-muted">
            Our mission is to create a secure, responsive, and enjoyable messaging platform for everyone.
            We connect people globally while ensuring privacy, ease of use, and real-time communication.
        </p>
    </div>

    <!-- Call-to-Action -->
    <div class="text-center">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg shadow">
            Join ChatApp Today
        </a>
    </div>
</div>
@endsection
