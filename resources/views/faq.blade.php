@extends('layouts.public')

@section('title', 'FAQ')
@section('meta_description',
    'Frequently Asked Questions about ' .
    config('app.name', 'ChatApp') .
    ' — privacy,
    security, features, and support.')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Frequently Asked Questions</h1>
            <p class="text-muted">Find comprehensive answers to the most common questions about
                {{ config('app.name', 'ChatApp') }}.</p>
            <!-- New quick stats -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="d-flex flex-wrap justify-content-center gap-4 text-center">
                        <div class="badge bg-light text-dark p-2">
                            <i class="bi bi-people me-1"></i>
                            50,000+ Active Users
                        </div>
                        <div class="badge bg-light text-dark p-2">
                            <i class="bi bi-shield-check me-1"></i>
                            99.9% Uptime
                        </div>
                        <div class="badge bg-light text-dark p-2">
                            <i class="bi bi-award me-1"></i>
                            5-Star Rated
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New category navigation -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="card bg-light border-0 p-3">
                    <div class="text-center">
                        <small class="text-muted fw-bold">QUICK NAVIGATION</small>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                            <a href="#pricing" class="btn btn-sm btn-outline-primary">💰 Pricing</a>
                            <a href="#security" class="btn btn-sm btn-outline-primary">🔒 Security</a>
                            <a href="#features" class="btn btn-sm btn-outline-primary">⚡ Features</a>
                            <a href="#support" class="btn btn-sm btn-outline-primary">🎧 Support</a>
                            <a href="#technical" class="btn btn-sm btn-outline-primary">⚙️ Technical</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion" id="faqAccordion">
            @php
                $appName = config('app.name', 'ChatApp');
                $faqs = [
                    // Pricing Section
                    [
                        'q' => "💰 Is {$appName} completely free to use?",
                        'a' => "Absolutely! {$appName} offers a robust free tier with all essential messaging features. This includes unlimited messages, group chats, file sharing, and end-to-end encryption. We believe secure communication should be accessible to everyone. Premium plans with advanced team management and enterprise features will be available in the future for organizations with specialized needs.",
                        'category' => 'pricing'
                    ],
                    [
                        'q' => "💳 Will you ever charge for basic features?",
                        'a' => "Never! Core messaging, encryption, and personal use features will always remain free. Any future premium features will be additional capabilities like advanced analytics, large file storage, or enterprise administration tools.",
                        'category' => 'pricing'
                    ],
                    
                    // Security Section
                    [
                        'q' => '🔒 How secure are my messages and data?',
                        'a' => 'Security is our top priority. All messages are protected with military-grade end-to-end encryption (AES-256), meaning only you and your intended recipients can read them. We use the Signal Protocol for key exchange and perfect forward secrecy. Even we cannot access your message content.',
                        'category' => 'security'
                    ],
                    [
                        'q' => '🏢 Do you store my messages permanently?',
                        'a' => 'We prioritize your privacy. Messages are encrypted and stored only as long as necessary for delivery and synchronization across your devices. You have full control over your data and can delete messages or your entire account at any time. We comply with GDPR and other privacy regulations.',
                        'category' => 'security'
                    ],
                    [
                        'q' => '👁️ Can government agencies access my chats?',
                        'a' => 'Due to our end-to-end encryption architecture, we technically cannot access the content of your messages, even if requested. We only store encrypted data and do not have the keys to decrypt your conversations.',
                        'category' => 'security'
                    ],
                    
                    // Features Section
                    [
                        'q' => "📱 Can I use {$appName} on multiple devices simultaneously?",
                        'a' => 'Yes! Sign in from your phone, tablet, laptop, and desktop — your chats stay perfectly synchronized in real-time. Messages, read receipts, and media are seamlessly synced across all your devices with zero setup required.',
                        'category' => 'features'
                    ],
                    [
                        'q' => "📎 What file types can I share on {$appName}?",
                        'a' => 'You can share images (JPG, PNG, GIF, WebP), documents (PDF, DOC, XLS, PPT), archives (ZIP, RAR), code files, and more. Individual files up to 100MB are supported, with higher limits for premium users. All shared files are encrypted end-to-end.',
                        'category' => 'features'
                    ],
                    [
                        'q' => '👥 How large can group chats be?',
                        'a' => 'Free accounts support groups up to 100 members, which is perfect for most teams and communities. Enterprise accounts can have groups with up to 1,000 members with advanced moderation tools and admin controls.',
                        'category' => 'features'
                    ],
                    [
                        'q' => '🔔 Can I customize notifications for different chats?',
                        'a' => 'Absolutely! Set custom notification sounds, vibration patterns, and priority levels for individual contacts and groups. You can mute conversations, set do-not-disturb hours, and create notification schedules that fit your lifestyle.',
                        'category' => 'features'
                    ],
                    
                    // Support Section
                    [
                        'q' => '🚨 How do I report inappropriate content or harassment?',
                        'a' => 'We take safety seriously. Use the built-in report button in any chat, or contact our moderation team directly. Reports are reviewed within 2 hours, and we take swift action against violations of our community guidelines. Your safety and comfort are paramount.',
                        'category' => 'support'
                    ],
                    [
                        'q' => '🎧 How quickly does your support team respond?',
                        'a' => 'Most support requests are answered within 2-4 hours during business days. Critical security or technical issues are prioritized and often resolved within 1 hour. Our support team consists of real humans who understand the product inside and out.',
                        'category' => 'support'
                    ],
                    [
                        'q' => '🗑️ How do I permanently delete my account?',
                        'a' => 'Account deletion is straightforward and complete. Contact support with your deletion request, and we will permanently remove all your data within 30 days. This includes messages, files, profile information, and all associated metadata. The process is irreversible and thorough.',
                        'category' => 'support'
                    ],
                    
                    // Technical Section
                    [
                        'q' => '⚙️ What happens if I lose my device?',
                        'a' => 'Your messages remain secure! Log in from a new device using your credentials, and your chat history will sync automatically. You can also remotely log out of lost devices from your account settings. All data remains encrypted and inaccessible to anyone who finds your device.',
                        'category' => 'technical'
                    ],
                    [
                        'q' => '🌐 Does the app work offline?',
                        'a' => 'You can read your message history offline, but sending and receiving new messages requires an internet connection. The app intelligently queues outgoing messages when offline and delivers them automatically once connectivity is restored.',
                        'category' => 'technical'
                    ],
                    [
                        'q' => '🔄 How do you handle app updates?',
                        'a' => 'Updates are seamless and automatic on most platforms. We focus on maintaining backward compatibility, so you never lose access to your chats during updates. New features are rolled out gradually to ensure stability.',
                        'category' => 'technical'
                    ]
                ];
            @endphp

            @foreach ($faqs as $i => $faq)
                <div class="accordion-item" id="{{ $faq['category'] ?? '' }}">
                    <h2 class="accordion-header" id="heading{{ $i }}">
                        <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}"
                            aria-expanded="{{ $i == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $i }}">
                            {{ $faq['q'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced call-to-action section -->
        <div class="text-center mt-5">
            <div class="card bg-primary text-white border-0 p-4">
                <h4 class="fw-bold mb-3">Still can't find what you're looking for?</h4>
                <p class="mb-3">Our support team is standing by to provide personalized assistance</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-chat-dots me-2"></i>Contact Support
                    </a>
                    <a href="mailto:help@chatapp.test" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-envelope me-2"></i>Email Us
                    </a>
                </div>
                <small class="mt-3 opacity-75">Average response time: 2-4 hours</small>
            </div>
        </div>
        
        <!-- New helpful resources section -->
        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="fs-1 text-primary mb-3"><i class="bi bi-book"></i></div>
                    <h5>User Guide</h5>
                    <p class="text-muted small">Comprehensive tutorials and best practices</p>
                    <a href="#" class="btn btn-sm btn-outline-primary">Learn More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="fs-1 text-success mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5>Security Center</h5>
                    <p class="text-muted small">In-depth security and privacy information</p>
                    <a href="#" class="btn btn-sm btn-outline-success">View Details</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="fs-1 text-warning mb-3"><i class="bi bi-people"></i></div>
                    <h5>Community</h5>
                    <p class="text-muted small">Connect with other users and share tips</p>
                    <a href="#" class="btn btn-sm btn-outline-warning">Join Community</a>
                </div>
            </div>
        </div>

    </div>
@endsection