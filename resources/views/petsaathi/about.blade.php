@extends('layouts.root')

@section('title', 'About Us | PetSaathi')

@section('content')
    @php
        // The little tile cluster that replaces the old flat illustration.
        // Live pet types from the database lead, then a few evergreen ones so
        // the 3x3 grid always fills out nicely.
        $clusterTiles = collect($petTypes)
            ->pluck('icon')
            ->merge(['🦴', '🧸', '🐾', '🩺', '🧶', '🎾', '🐰', '💜'])
            ->unique()
            ->take(9)
            ->values();

        $story = [
            ['icon' => '🌱', 'title' => 'It started with one rescue pup', 'text' => 'A late-night hunt for the right puppy food turned into a simple question: why is shopping for a pet so complicated?'],
            ['icon' => '🔍', 'title' => 'We asked the experts', 'text' => 'Vets, groomers and very opinionated pet parents helped us decide what deserved a place on our shelves.'],
            ['icon' => '🛍️', 'title' => 'PetSaathi opened its doors', 'text' => 'Food, toys, grooming, healthcare and accessories — curated, honestly priced and easy to browse.'],
            ['icon' => '💜', 'title' => 'And we are still going', 'text' => 'Every order teaches us something new about what pets need. We keep listening, and keep improving.'],
        ];

        $values = [
            ['icon' => '🩺', 'title' => 'Vet-Checked', 'text' => 'Practising vets review our range before anything reaches your pet.'],
            ['icon' => '🌿', 'title' => 'Honest Ingredients', 'text' => 'Clear labels, no filler claims — you always know what is inside.'],
            ['icon' => '🚚', 'title' => 'Quick & Careful', 'text' => 'Packed the same day and handled gently, right to your doorstep.'],
            ['icon' => '🤝', 'title' => 'Here When You Need Us', 'text' => 'Real people on chat and call, seven days a week.'],
        ];
    @endphp

    <main>
        {{-- ---------- Hero ---------- --}}
        <section class="about-hero">
            <span class="paw-deco" style="left:5%;top:18%;font-size:46px">🐾</span>
            <span class="paw-deco" style="left:92%;top:14%;font-size:34px;animation-delay:1.2s">🐾</span>
            <span class="paw-deco" style="left:47%;top:82%;font-size:30px;animation-delay:2s">🐾</span>

            <div class="container position-relative">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 reveal">
                        <span class="pill">🐾 About PetSaathi</span>
                        <h1 class="about-title mt-3">
                            Made by pet parents,<br>
                            <span class="gradient-text">for pet parents.</span>
                        </h1>
                        <p class="about-lead mt-3">
                            We bring premium food, toys, grooming, healthcare and accessories together in one
                            calm, easy shopping journey — so you can spend less time searching and more time
                            with the little one who is already asleep on your laptop.
                        </p>
                        <div class="d-flex gap-3 flex-wrap mt-4">
                            <a href="{{ route('shop') }}" class="btn btn-main">Explore the Shop →</a>
                            <a href="{{ route('contact') }}" class="btn btn-soft">💬 Talk to Us</a>
                        </div>

                        <div class="about-chips mt-4">
                            <span class="about-chip">🩺 Vet-approved range</span>
                            <span class="about-chip">🚚 Fast delivery</span>
                            <span class="about-chip">↩️ 30-day returns</span>
                        </div>
                    </div>

                    <div class="col-lg-6 reveal">
                        <div class="pet-cluster-wrap">
                            <span class="pet-cluster-glow" aria-hidden="true"></span>
                            <div class="pet-cluster" aria-hidden="true">
                                @foreach ($clusterTiles as $i => $icon)
                                    <div class="pet-tile {{ ['', 'accent', '', '', 'pink', '', '', 'warm', ''][$i] ?? '' }}">
                                        {{ $icon }}
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div class="cluster-badge">
                                <span class="cluster-badge-icon">💜</span>
                                <div>
                                    <strong>25,000+</strong>
                                    <small>happy pet parents</small>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ---------- Numbers ---------- --}}
        <section class="container my-5">
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4 h-100 reveal">
                        <div class="stat-emoji">🏡</div>
                        <h2 class="count gradient-text mb-1" data-count="{{ $stats['customers'] }}">0</h2>
                        <p class="text-muted mb-0">Happy Homes</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4 h-100 reveal">
                        <div class="stat-emoji">🛍️</div>
                        <h2 class="count gradient-text mb-1" data-count="{{ $stats['products'] }}">0</h2>
                        <p class="text-muted mb-0">Curated Products</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4 h-100 reveal">
                        <div class="stat-emoji">🧺</div>
                        <h2 class="count gradient-text mb-1" data-count="{{ $stats['ranges'] }}">0</h2>
                        <p class="text-muted mb-0">Care Ranges</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="glass-card p-4 h-100 reveal">
                        <div class="stat-emoji">🎧</div>
                        <h2 class="count gradient-text mb-1" data-count="24">0</h2>
                        <p class="text-muted mb-0">Hour Support</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ---------- Story ---------- --}}
        <section class="container my-5 py-3">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 reveal">
                    <span class="pill">📖 Our Story</span>
                    <h2 class="section-title mt-3">From one hungry puppy to
                        <span class="gradient-text">a whole shop</span>
                    </h2>
                    <p class="text-muted">
                        PetSaathi did not start in a boardroom. It started at 11pm, on a shopping site that made
                        buying pet food feel like homework. We thought pet parents deserved better — so we built it.
                    </p>
                    <a href="{{ route('shop') }}" class="btn btn-soft mt-2">See What We Stock</a>
                </div>
                <div class="col-lg-7 reveal">
                    <div class="glass-card p-4 p-md-5">
                        @foreach ($story as $step)
                            <div class="story-step">
                                <div class="story-icon">{{ $step['icon'] }}</div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $step['title'] }}</h6>
                                    <p class="text-muted small mb-0">{{ $step['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ---------- Values ---------- --}}
        <section class="container my-5 py-3">
            <div class="text-center mb-5">
                <span class="pill">💜 What We Stand For</span>
                <h2 class="section-title mt-3">Small promises we keep on
                    <span class="gradient-text">every order</span>
                </h2>
                <p class="text-muted mb-0">No fine print, no surprises — just the basics done properly.</p>
            </div>
            <div class="row g-4">
                @foreach ($values as $value)
                    <div class="col-md-6 col-lg-3">
                        <div class="glass-card p-4 h-100 text-center reveal">
                            <div class="value-icon mx-auto">{{ $value['icon'] }}</div>
                            <h6 class="fw-bold mb-2">{{ $value['title'] }}</h6>
                            <p class="text-muted small mb-0">{{ $value['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ---------- What we stock ---------- --}}
        @if ($ranges->isNotEmpty())
            <section class="container my-5 py-3">
                <div class="text-center mb-5">
                    <span class="pill">🧺 What We Stock</span>
                    <h2 class="section-title mt-3">Everything your pet needs,
                        <span class="gradient-text">neatly sorted</span>
                    </h2>
                </div>
                <div class="row g-3 g-md-4">
                    @foreach ($ranges as $range)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ $range['url'] }}" class="text-decoration-none text-reset">
                                <div class="stock-card reveal">
                                    <span class="stock-emoji">{{ $range['icon'] }}</span>
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $range['name'] }}</h6>
                                        <p class="text-muted small mb-0">
                                            {{ $range['count'] }}
                                            {{ Str::plural('product', $range['count']) }}
                                            @if ($range['parent'])
                                                · for {{ Str::title($range['parent']) }}
                                            @endif
                                        </p>
                                    </div>
                                    <span class="stock-arrow">→</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ---------- Closing CTA ---------- --}}
        <section class="container my-5">
            <div class="about-cta reveal">
                <span class="paw" style="left:6%;top:14%">🐾</span>
                <span class="paw" style="right:8%;bottom:10%;font-size:64px">🦴</span>
                <div class="position-relative">
                    <div class="cta-avatars mb-3">
                        <span>🐶</span><span>😺</span><span>🐰</span><span>🐾</span>
                    </div>
                    <h2 class="fw-bold mb-2">Ready to spoil your best friend?</h2>
                    <p class="mb-4 opacity-75">Browse the range, or drop us a message — we love a good pet question.</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('shop') }}" class="btn btn-soft">🛍️ Start Shopping</a>
                        <a href="{{ route('contact') }}" class="btn btn-ghost-light">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
