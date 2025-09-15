@extends('layouts.public')

@section('title','Features')
@section('meta_description', config('app.name', 'ChatApp') . ' features — real-time messaging, end-to-end encryption, group chats, cross-platform support, and more.')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">{{ config('app.name', 'ChatApp') }} Features</h1>
        <p class="text-muted fs-5">Explore the capabilities that make {{ config('app.name', 'ChatApp') }} a reliable, secure, and modern messaging platform.</p>
    </div>

    <div class="row g-4">
        @php
            $features = [
                ['icon'=>'bi-chat-dots','title'=>'Real-Time Messaging','text'=>'Fast, reliable delivery powered by WebSockets for near-instant conversations.'],
                ['icon'=>'bi-shield-lock-fill','title'=>'End-to-End Encryption','text'=>'Encrypts messages so only intended recipients can read them. Keys are managed with best practices.'],
                ['icon'=>'bi-people-fill','title'=>'Group & Team Chats','text'=>'Create channels and groups with roles and simple management tools for teams of any size.'],
                ['icon'=>'bi-bell-fill','title'=>'Smart Notifications','text'=>'Context-aware notifications and typing indicators that reduce noise and keep you informed.'],
                ['icon'=>'bi-phone-fill','title'=>'Cross-Platform','text'=>'Native-like experience across desktop and mobile — keep conversations in sync.'],
                ['icon'=>'bi-emoji-smile','title'=>'Emojis & Media','text'=>'Rich media support including images, file attachments, and expressive emoji reactions.'],
            ];
        @endphp

        @foreach($features as $feature)
            <div class="col-md-4">
                <div class="card h-100 text-center shadow-sm border-0 p-4">
                    <div class="fs-1 text-primary mb-3"><i class="bi {{ $feature['icon'] }}" aria-hidden="true"></i></div>
                    <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                    <p class="text-muted">{{ $feature['text'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Extended details (non-breaking layout) -->
    <div class="row mt-5 g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold">How it works</h5>
                <p class="text-muted mb-0">
                    Messages flow through secure channels and are routed in real-time using socket connections. Our sync mechanism ensures messages and read states remain consistent across your devices.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold">Admin & Moderation</h5>
                <p class="text-muted mb-0">
                    Admins have access to moderation tools and user management features to ensure community guidelines are upheld while enabling healthy conversations.
                </p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started — It’s Free</a>
        <p class="text-muted small mt-3 mb-0">For custom deployments and enterprise support, reach out via the Contact page.</p>
    </div>
</div>
@endsection
