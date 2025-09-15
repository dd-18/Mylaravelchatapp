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
            <p class="text-muted">Find concise answers to the most common questions about
                {{ config('app.name', 'ChatApp') }}.</p>
        </div>

        <div class="accordion" id="faqAccordion">
            @php
                $appName = config('app.name', 'ChatApp');
                $faqs = [
                    [
                        'q' => "Is {$appName} free to use?",
                        'a' => "Yes! {$appName} offers a fully functional free tier with essential features available to every user. We may offer paid plans with advanced team features in the future.",
                    ],
                    [
                        'q' => 'Are my chats encrypted?',
                        'a' =>
                            'Yes. Messages are protected with end-to-end encryption so only the participants can read them.',
                    ],
                    [
                        'q' => "Can I use {$appName} on multiple devices?",
                        'a' =>
                            'Yes — you can sign in across your phone, tablet, and desktop. We keep your sessions secure and synchronized.',
                    ],
                    [
                        'q' => 'Do you store my messages?',
                        'a' =>
                            'We keep messages encrypted. Where server-side storage is necessary (e.g., message synchronization), plaintext data is not retained beyond what is required for delivery and sync.',
                    ],
                    [
                        'q' => 'Can I report inappropriate content?',
                        'a' =>
                            'Yes — report tools are available for users and admins to flag content; moderators can review and take action when necessary.',
                    ],
                    [
                        'q' => 'How do I request account deletion?',
                        'a' =>
                            'To delete your account and associated data, contact support via the Contact page and select "Account deletion". We will guide you through the process.',
                    ],
                    [
                        'q' => 'Does {{ $appName }} support file sharing?',
                        'a' =>
                            'Yes — you can send images, documents, and common file types. Large file uploads may be restricted depending on server limits.',
                    ],
                    [
                        'q' => 'How can I get support?',
                        'a' =>
                            'For general support, use the Contact form. For urgent enterprise issues, indicate "Sales / Partnerships" or include priority details in your message.',
                    ],
                    [
                        'q' => "Is {$appName} free to use?",
                        'a' => "Absolutely! {$appName} offers all core features at no cost. Premium plans with advanced tools are optional.",
                    ],
                    [
                        'q' => 'How secure are my messages?',
                        'a' => 'All conversations are protected with state-of-the-art end-to-end encryption.',
                    ],
                    [
                        'q' => "Can I access {$appName} on multiple devices?",
                        'a' => 'Yes — sign in from phone, tablet, or computer and your chats stay synced.',
                    ],
                    [
                        'q' => 'Do you store my messages forever?',
                        'a' => 'No, we only retain encrypted messages as long as required for delivery or compliance.',
                    ],
                    [
                        'q' => 'How do I report abuse or spam?',
                        'a' => 'Use the in-chat report tool or contact support — our moderation team acts quickly.',
                    ],
                ];
            @endphp

            @foreach ($faqs as $i => $faq)
                <div class="accordion-item">
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

        <div class="text-center mt-5">
            <p class="text-muted">Still can’t find what you’re looking for?</p>
            <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Support</a>
        </div>

    </div>
@endsection
