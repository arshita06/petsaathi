@extends('layouts.root')

@section('title', 'Contact | PetSaathi')

@section('content')
    @php
        $channels = [
            [
                'icon' => '📞',
                'label' => 'Call us',
                'value' => '+91 98765 43210',
                'href' => 'tel:+919876543210',
                'note' => 'Mon–Sat, 9am – 8pm',
                'tone' => '',
            ],
            [
                'icon' => '💬',
                'label' => 'Live chat',
                'value' => 'Chat with support',
                'href' => '#contact-form',
                'note' => 'Typical reply in 5 min',
                'tone' => 'accent',
            ],
            [
                'icon' => '✉️',
                'label' => 'Email us',
                'value' => 'support@petsaathi.com',
                'href' => 'mailto:support@petsaathi.com',
                'note' => 'We answer within 24 hrs',
                'tone' => 'pink',
            ],
            [
                'icon' => '📍',
                'label' => 'Visit us',
                'value' => 'Delhi, India',
                'href' => '#visit-us',
                'note' => 'Open for pickups',
                'tone' => 'warm',
            ],
        ];

        // $topics comes from ContactController::TOPICS so the dropdown and the
        // store() validation can never drift apart.

        $hours = [
            ['day' => 'Monday – Friday', 'time' => '9:00 am – 8:00 pm', 'open' => true],
            ['day' => 'Saturday', 'time' => '10:00 am – 6:00 pm', 'open' => true],
            ['day' => 'Sunday', 'time' => 'Email support only', 'open' => false],
        ];

        $promises = [
            ['icon' => '⚡', 'text' => 'A real person replies — never a bot loop.'],
            ['icon' => '🩺', 'text' => 'Product questions checked with our vet panel.'],
            ['icon' => '↩️', 'text' => 'Returns sorted within one working day.'],
        ];

        $faqs = [
            ['q' => 'How fast is delivery?', 'a' => 'Orders placed before 2pm are dispatched the same day. Selected cities get same-day delivery; everywhere else it is 2–4 working days.'],
            ['q' => 'Can I change or cancel an order?', 'a' => 'Yes — as long as it has not been dispatched. Message us with your order number and we will update it right away.'],
            ['q' => 'Are your products genuine?', 'a' => 'Every item is sourced directly from the brand or an authorised distributor, and our vet panel reviews the range before it goes on the shelf.'],
            ['q' => 'My pet reacted badly to a product. What now?', 'a' => 'Stop using it and contact us immediately with a photo of the batch code. We will arrange a free return and help you find a safer alternative.'],
        ];
    @endphp

    {{-- ---------- Hero ---------- --}}
    <section class="contact-hero">
        <span class="contact-paw cp1">🐾</span>
        <span class="contact-paw cp2">🐾</span>
        <span class="contact-paw cp3">🦴</span>
        <span class="contact-paw cp4">♡</span>

        <div class="container position-relative">
            <div class="contact-hero-inner reveal">
                <span class="pill">💬 We’d love to help</span>
                <h1 class="contact-title mt-3">
                    Questions about your pet?
                    <span class="gradient-text">Let’s talk.</span>
                </h1>
                <p class="contact-lead">
                    Order updates, food advice, a second opinion on a grooming kit — whatever it is,
                    our support team answers like a fellow pet parent, not a script.
                </p>
                <div class="contact-hero-meta">
                    <span class="status-dot" aria-hidden="true"></span>
                    <strong>Support is online now</strong>
                    <span class="text-muted">· average reply in under 5 minutes</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ---------- Channel cards ---------- --}}
    <section class="container contact-channels">
        <div class="row g-3 g-md-4">
            @foreach ($channels as $c)
                <div class="col-6 col-lg-3">
                    <a href="{{ $c['href'] }}" class="channel-card reveal">
                        <span class="channel-icon {{ $c['tone'] }}">{{ $c['icon'] }}</span>
                        <span class="channel-label">{{ $c['label'] }}</span>
                        <span class="channel-value">{{ $c['value'] }}</span>
                        <span class="channel-note">{{ $c['note'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ---------- Form + aside ---------- --}}
    <section class="container contact-section" id="contact-form">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="contact-form-card reveal">
                    <span class="form-deco" aria-hidden="true">🐾</span>
                    <h2 class="contact-form-title">Send us a message</h2>
                    <p class="contact-form-sub">
                        Fill in a few details and we’ll get back to you by email. Fields marked
                        <span class="req">*</span> are required.
                    </p>

                    @if (session('contact_success'))
                        <div class="auth-alert auth-alert-success" role="status">
                            <span>✅</span>
                            <span>{{ session('contact_success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="auth-alert auth-alert-error" role="alert">
                            <span>⚠️</span>
                            <span>Please check the highlighted fields and try again.</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="c-name">Your name <span class="req">*</span></label>
                                    <span class="field-icon">👤</span>
                                    <input class="form-control @error('name') is-invalid @enderror" id="c-name"
                                        name="name" value="{{ old('name') }}" placeholder="Priya Sharma" required>
                                    @error('name')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="c-email">Email address <span
                                            class="req">*</span></label>
                                    <span class="field-icon">✉️</span>
                                    <input class="form-control @error('email') is-invalid @enderror" id="c-email"
                                        name="email" type="email" value="{{ old('email') }}"
                                        placeholder="you@example.com" required>
                                    @error('email')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="c-phone">Phone <span
                                            class="opt">(optional)</span></label>
                                    <span class="field-icon">📱</span>
                                    <input class="form-control @error('phone') is-invalid @enderror" id="c-phone"
                                        name="phone" type="tel" value="{{ old('phone') }}"
                                        placeholder="+91 00000 00000">
                                    @error('phone')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="c-topic">What is it about? <span
                                        class="req">*</span></label>
                                <select class="form-select @error('topic') is-invalid @enderror" id="c-topic"
                                    name="topic" required>
                                    <option value="" disabled {{ old('topic') ? '' : 'selected' }}>
                                        Select a topic…
                                    </option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic }}" @selected(old('topic') === $topic)>{{ $topic }}</option>
                                    @endforeach
                                </select>
                                @error('topic')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="c-message">Your message <span
                                        class="req">*</span></label>
                                <textarea class="form-control contact-textarea @error('message') is-invalid @enderror" id="c-message" name="message"
                                    rows="5" required
                                    placeholder="Tell us about your pet and what you need — breed, age and anything you have already tried helps us answer faster.">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="c-consent" name="subscribed"
                                        value="1" @checked(old('subscribed'))>
                                    <label class="form-check-label" for="c-consent">
                                        Keep me posted about offers and pet care tips.
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="contact-submit-row">
                                    <button type="submit" class="btn btn-main">Send Message <span
                                            class="cta-arrow">→</span></button>
                                    <small class="text-muted">We never share your details. Promise. 🐾</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="contact-aside">
                    <div class="aside-card reveal">
                        <h3 class="aside-title">🕒 Support hours</h3>
                        <ul class="hours-list">
                            @foreach ($hours as $h)
                                <li>
                                    <span class="hours-day">{{ $h['day'] }}</span>
                                    <span class="hours-time {{ $h['open'] ? '' : 'muted' }}">{{ $h['time'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="hours-foot">Festive weeks may run shorter — we always post updates on the banner above.</p>
                    </div>

                    <div class="aside-card reveal">
                        <h3 class="aside-title">💜 What you can expect</h3>
                        <ul class="promise-list">
                            @foreach ($promises as $p)
                                <li>
                                    <span class="promise-icon">{{ $p['icon'] }}</span>
                                    <span>{{ $p['text'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="aside-card aside-social reveal">
                        <h3 class="aside-title">🐶 Say hi elsewhere</h3>
                        <p class="text-muted small mb-3">We post care tips, new arrivals and far too many puppy photos.</p>
                        <div class="social-row">
                            <a href="#" class="social-btn" aria-label="Facebook">f</a>
                            <a href="#" class="social-btn" aria-label="LinkedIn">in</a>
                            <a href="#" class="social-btn" aria-label="YouTube">▶</a>
                            <a href="{{ route('faq') }}" class="social-btn wide">Read the FAQ →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ---------- Visit us ---------- --}}
    <section class="container contact-section" id="visit-us">
        <div class="visit-panel reveal">
            <span class="visit-deco vd1">🐾</span>
            <span class="visit-deco vd2">🦴</span>
            <div class="row g-4 g-lg-5 align-items-center position-relative">
                <div class="col-lg-6">
                    <span class="pill">📍 Visit Us</span>
                    <h2 class="section-title visit-title mt-3">Drop by the
                        <span class="gradient-text">PetSaathi counter</span>
                    </h2>
                    <p class="text-muted">
                        Prefer to pick up your order, or want a hand choosing the right food? Our counter is open
                        through the week — bring the pet along, we insist.
                    </p>
                    <ul class="visit-list">
                        <li><span class="soft-icon">🏬</span>
                            <div><strong>PetSaathi Store</strong><small>Connaught Place, New Delhi, 110001</small></div>
                        </li>
                        <li><span class="soft-icon">🅿️</span>
                            <div><strong>Free parking</strong><small>Two hours, right outside the entrance</small></div>
                        </li>
                        <li><span class="soft-icon">🦮</span>
                            <div><strong>Pets welcome</strong><small>Water bowls and treats always ready</small></div>
                        </li>
                    </ul>
                    <a href="https://www.google.com/maps/search/?api=1&query=Connaught+Place+New+Delhi" target="_blank"
                        rel="noopener" class="btn btn-main mt-2">Get Directions <span class="cta-arrow">→</span></a>
                </div>
                <div class="col-lg-6">
                    <div class="map-card">
                        <div class="map-grid" aria-hidden="true"></div>
                        <span class="map-route" aria-hidden="true"></span>
                        <div class="map-pin">
                            <span class="map-pin-dot">🐾</span>
                            <span class="map-pin-pulse" aria-hidden="true"></span>
                        </div>
                        <div class="map-plate">
                            <strong>PetSaathi Store</strong>
                            <small>Connaught Place · New Delhi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ---------- Quick FAQ ---------- --}}
    <section class="container contact-section contact-section-last">
        <div class="contact-head reveal">
            {{-- <span class="pill">❓ Before You Write</span> --}}
            <h2 class="section-title mt-3">Quick answers to the
                <span class="gradient-text">usual questions</span>
            </h2>
            <p class="contact-sub">Still stuck? The form above reaches a real person.</p>
        </div>

        <div class="accordion contact-faq reveal" id="contactFaq">
            @foreach ($faqs as $i => $faq)
                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button {{ $i === 0 ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#cfaq{{ $i }}"
                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            {{ $faq['q'] }}
                        </button>
                    </h3>
                    <div id="cfaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                        data-bs-parent="#contactFaq">
                        <div class="accordion-body">{{ $faq['a'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="text-center mt-4 reveal">
            <a href="{{ route('faq') }}" class="btn btn-soft">See all FAQs</a>
        </div> --}}
    </section>
@endsection
