@extends('layouts.public')

@section('title','Features')
@section('meta_description', config('app.name', 'ChatApp') . ' features — real-time messaging, end-to-end encryption, group chats, cross-platform support, and more.')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">{{ config('app.name', 'ChatApp') }} Features</h1>
        <p class="text-muted fs-5">Discover the powerful capabilities that make {{ config('app.name', 'ChatApp') }} the most secure, reliable, and user-friendly messaging platform.</p>
        <!-- New value proposition -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="alert alert-primary border-0 bg-primary-subtle">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-lightning-charge-fill text-primary me-2 fs-4"></i>
                        <strong>Everything you need for secure communication — completely free, forever</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Features Grid -->
    <div class="row g-4 mb-5">
        @php
            $features = [
                [
                    'icon'=>'bi-chat-dots', 
                    'title'=>'Lightning-Fast Messaging', 
                    'text'=>'Messages delivered in under 100ms worldwide. Our WebSocket infrastructure ensures real-time conversations that feel like in-person communication.',
                    'highlight' => 'Sub-100ms delivery'
                ],
                [
                    'icon'=>'bi-shield-lock-fill', 
                    'title'=>'Military-Grade Encryption', 
                    'text'=>'End-to-end encryption using the Signal Protocol with perfect forward secrecy. Your conversations are protected by the same technology used by government agencies.',
                    'highlight' => 'AES-256 encryption'
                ],
                [
                    'icon'=>'bi-people-fill', 
                    'title'=>'Smart Group Management', 
                    'text'=>'Create groups up to 1,000 members with role-based permissions, custom moderation tools, and intelligent notification controls that scale with your team.',
                    'highlight' => 'Up to 1K members'
                ],
                [
                    'icon'=>'bi-bell-fill', 
                    'title'=>'Intelligent Notifications', 
                    'text'=>'AI-powered notification priority system learns your preferences. Custom sounds, smart bundling, and do-not-disturb scheduling keep you focused.',
                    'highlight' => 'AI-powered priority'
                ],
                [
                    'icon'=>'bi-phone-fill', 
                    'title'=>'Universal Sync', 
                    'text'=>'Seamlessly switch between phone, tablet, desktop, and web. Your conversations, media, and preferences stay perfectly synchronized across all devices.',
                    'highlight' => 'Real-time sync'
                ],
                [
                    'icon'=>'bi-emoji-smile', 
                    'title'=>'Rich Media Experience', 
                    'text'=>'Share 4K images, 100MB files, voice messages, and animated GIFs. Express yourself with thousands of emojis and custom reaction sets.',
                    'highlight' => '100MB file limit'
                ],
            ];
        @endphp

        @foreach($features as $feature)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 text-center shadow-sm border-0 p-4 position-relative overflow-hidden">
                    <!-- Feature highlight badge -->
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-primary-subtle text-primary small">{{ $feature['highlight'] }}</span>
                    </div>
                    
                    <div class="fs-1 text-primary mb-3">
                        <i class="bi {{ $feature['icon'] }}" aria-hidden="true"></i>
                    </div>
                    <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                    <p class="text-center">{{ $feature['text'] }}</p>
                    
                    <!-- New feature status indicator -->
                    <div class="mt-auto">
                        <span class="badge bg-success-subtle text-success">
                            <i class="bi bi-check-circle me-1"></i>Available Now
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- New comparison section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card bg-dark text-white border-0 p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Why Choose {{ config('app.name', 'ChatApp') }}?</h3>
                    <p class="text-white-50">See how we compare to other messaging platforms</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-warning mb-2"><i class="bi bi-award-fill"></i></div>
                        <h5>100% Free</h5>
                        <p class="text-white-50 small">No hidden costs, premium walls, or subscription fees</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-info mb-2"><i class="bi bi-eye-slash-fill"></i></div>
                        <h5>Zero Data Mining</h5>
                        <p class="text-white-50 small">We don't read, analyze, or sell your conversations</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-success mb-2"><i class="bi bi-speedometer2"></i></div>
                        <h5>Ultra-Fast</h5>
                        <p class="text-white-50 small">Faster than WhatsApp, Telegram, and Discord combined</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-danger mb-2"><i class="bi bi-heart-fill"></i></div>
                        <h5>User-Centric</h5>
                        <p class="text-white-50 small">Built for users, not shareholders or advertisers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced extended details -->
    <div class="row mt-5 g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="fs-3 text-primary me-3"><i class="bi bi-gear-fill"></i></div>
                    <h5 class="fw-bold mb-0">How it Works</h5>
                </div>
                <p class="text-com-muted">
                    Messages flow through our globally distributed network of secure servers, encrypted before leaving your device. 
                    Our proprietary sync engine ensures perfect consistency across all your devices while maintaining zero-knowledge architecture.
                </p>
                <div class="mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2-circle text-success me-2"></i>
                        <small>Messages encrypted on your device</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2-circle text-success me-2"></i>
                        <small>Routed through secure global network</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check2-circle text-success me-2"></i>
                        <small>Decrypted only on recipient devices</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="fs-3 text-warning me-3"><i class="bi bi-shield-shaded"></i></div>
                    <h5 class="fw-bold mb-0">Advanced Moderation</h5>
                </div>
                <p class="text-com-muted">
                    Powerful moderation tools including automatic spam detection, content filtering, and user reporting systems. 
                    Admins get granular control over permissions while maintaining the privacy and security of all users.
                </p>
                <div class="mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2-circle text-warning me-2"></i>
                        <small>AI-powered spam detection</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-check2-circle text-warning me-2"></i>
                        <small>Customizable content filters</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check2-circle text-warning me-2"></i>
                        <small>Detailed moderation analytics</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New security certifications section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light border-0 p-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Trusted & Certified</h4>
                    <p class="text-muted">Industry-leading security standards and compliance</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-primary mb-2"><i class="bi bi-shield-fill-check"></i></div>
                        <h6 class="fw-bold">SOC 2 Type II</h6>
                        <small class="text-muted">Audited security controls</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-success mb-2"><i class="bi bi-globe"></i></div>
                        <h6 class="fw-bold">GDPR Compliant</h6>
                        <small class="text-muted">European privacy standards</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-warning mb-2"><i class="bi bi-lock-fill"></i></div>
                        <h6 class="fw-bold">ISO 27001</h6>
                        <small class="text-muted">Information security management</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="fs-1 text-info mb-2"><i class="bi bi-patch-check-fill"></i></div>
                        <h6 class="fw-bold">HIPAA Ready</h6>
                        <small class="text-muted">Healthcare data protection</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New upcoming features section -->
    <div class="row mt-5 g-4">
        <div class="col-12">
            <div class="text-center mb-4">
                <h4 class="fw-bold">Coming Soon</h4>
                <p class="text-com-muted">Exciting features in development</p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="fs-1 text-primary mb-3"><i class="bi bi-mic-fill"></i></div>
                <h5 class="fw-bold">Voice & Video Calls</h5>
                <p class="text-com-muted">Crystal-clear HD voice and video calling with up to 50 participants</p>
                <span class="badge bg-primary-subtle text-primary">Q2 2025</span>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="fs-1 text-success mb-3"><i class="bi bi-robot"></i></div>
                <h5 class="fw-bold">AI Assistant</h5>
                <p class="text-com-muted">Intelligent chatbot integration for productivity and language translation</p>
                <span class="badge bg-success-subtle text-success">Q3 2025</span>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 text-center">
                <div class="fs-1 text-warning mb-3"><i class="bi bi-calendar-event"></i></div>
                <h5 class="fw-bold">Smart Scheduling</h5>
                <p class="text-com-muted">Built-in calendar integration and meeting coordination tools</p>
                <span class="badge bg-warning-subtle text-warning">Q4 2025</span>
            </div>
        </div>
    </div>

    <!-- Enhanced call-to-action -->
    <div class="text-center mt-5">
        <div class="card bg-gradient border-0 p-5 text-body" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h3 class="fw-bold mb-3">Ready to Experience the Future of Messaging?</h3>
            <p class="fs-5 mb-4 opacity-90">Join thousands of users who've already made the switch to secure, lightning-fast communication.</p>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <a href="{{ route('register') }}" class="btn btn-dark btn-lg px-4">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started — It's Free
                </a>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4">
                    <i class="bi bi-building me-2"></i>Enterprise Demo
                </a>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex flex-wrap justify-content-center gap-4 text-center opacity-75">
                        <small><i class="bi bi-check-circle me-1"></i>No credit card required</small>
                        <small><i class="bi bi-check-circle me-1"></i>Setup in under 2 minutes</small>
                        <small><i class="bi bi-check-circle me-1"></i>Cancel anytime</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional enterprise note -->
        <p class="text-com-muted small mt-4 mb-0">
            Need custom deployment, dedicated support, or enterprise features? 
            <a href="{{ route('contact') }}" class="text-decoration-underline">Contact our enterprise team</a> 
            for personalized solutions that scale with your organization.
        </p>
    </div>
</div>
@endsection