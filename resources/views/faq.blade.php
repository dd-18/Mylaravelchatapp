@extends('layouts.public')

@section('title','FAQ')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Frequently Asked Questions</h1>
        <p class="text-muted">Find answers to the most common questions about ChatApp.</p>
    </div>

    <div class="accordion" id="faqAccordion">
        @php
            $faqs = [
                ['q'=>'Is ChatApp free to use?','a'=>'Yes! ChatApp is 100% free with all core features available to every user.'],
                ['q'=>'Are my chats encrypted?','a'=>'Absolutely. All messages use end-to-end encryption for maximum privacy.'],
                ['q'=>'Can I use ChatApp on multiple devices?','a'=>'Yes, ChatApp works on desktop, mobile, and tablet devices.'],
                ['q'=>'Do you store my messages?','a'=>'No, messages are encrypted and securely stored only as long as needed.'],
                ['q'=>'Can I report inappropriate content?','a'=>'Yes, admins can moderate chats and ensure a safe community.'],
            ];
        @endphp

        @foreach($faqs as $i => $faq)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $i }}">
                <button class="accordion-button {{ $i>0?'collapsed':'' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}">
                    {{ $faq['q'] }}
                </button>
            </h2>
            <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i==0?'show':'' }}" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    {{ $faq['a'] }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
