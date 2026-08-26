@extends('layouts.root')

@section('content')
    <section class="hero-section container reveal">
        <div class="hero-bg-decor" aria-hidden="true">
            <span class="deco-circle dc1"></span><span class="deco-circle dc2"></span><span
                class="deco-circle dc3"></span><span class="deco-circle dc4"></span>
            <span class="deco-blob db1"></span><span class="deco-blob db2"></span>
            <span class="deco-icon" style="left:10%;top:16%">🐾</span>
            <span class="deco-icon" style="left:85%;top:12%;animation-delay:1.4s">♡</span>
            <span class="deco-icon" style="left:80%;top:78%;animation-delay:2.4s">🦴</span>
            <span class="deco-icon" style="left:6%;top:80%;animation-delay:.8s">✦</span>
        </div>
        <div class="row align-items-center g-5 position-relative z-2">
            <div class="col-lg-6 position-relative z-3">
                <span class="pill hero-badge text-animate">🐾 Your Pet, Our Priority</span>
                <h1 class="hero-heading">
                    <span class="line1 text-animate">Everything Your Pet</span>
                    <span class="hero-grad-1 text-animate">Deserves,</span>
                    <span class="hero-grad-2 text-animate">All in One Place</span>
                </h1>
                <p class="lead text-muted hero-sub my-4">Premium products, healthy choices, and happy tails — because
                    they're
                    family.</p>
                <div class="d-flex gap-3 flex-wrap hero-cta">
                    <a href="{{ route('shop') }}" class="btn btn-main btn-hero-primary">Shop Now <span
                            class="cta-arrow">→</span></a>
                    <a href="{{ route('categories') }}" class="btn btn-soft btn-hero-secondary">🐾 Explore Categories</a>
                </div>
                <div class="hero-trust mt-4">
                    <div class="avatar-stack"><span>🐶</span><span>😺</span><span>🐰</span><span>🐾</span></div>
                    <div class="hero-trust-text">
                        <strong>25,000+ Happy Pet Parents</strong>
                        <div class="hero-rating"><span class="stars">★★★★★</span> 4.9 Rating · Trusted Across India</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-stage">
                <div class="hero-illustration-wrap">
                    <span class="hero-glow"></span>
                    <img class="hero-illustration" src="assets/images/hero-pets-photo.png" alt="Happy puppy and kitten">
                    <span class="hero-shadow"></span>
                    <span class="float-deco fd1">🐾</span>
                    <span class="float-deco fd2">♡</span>
                    <span class="float-deco fd3">✦</span>
                    <span class="float-deco fd4">●</span>
                </div>
            </div>
        </div>
        <div class="feature-card fc1">
            <div class="feature-icon">🚚</div>
            <div>
                <h6 class="mb-1">Fast Delivery</h6><small class="text-muted">Same-day delivery</small>
            </div>
        </div>
        <div class="feature-card fc2">
            <div class="feature-icon">🛡️</div>
            <div>
                <h6 class="mb-1">100% Genuine</h6><small class="text-muted">Trusted products</small>
            </div>
        </div>
        <div class="feature-card fc3">
            <div class="feature-icon">🎧</div>
            <div>
                <h6 class="mb-1">24/7 Support</h6><small class="text-muted">We're here anytime</small>
            </div>
        </div>
    </section>
    {{-- <section class="container my-4">
        <div class="row g-3">
            <div class="col-md">
                <div class="category-card reveal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="soft-icon mb-2">🦷</div>
                            <h6>Vet Pick</h6>
                            <p class="text-muted">Expert approved essentials</p>
                        </div>
                        <div class="cat-img">🐕</div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="category-card reveal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="soft-icon mb-2">🍰</div>
                            <h6>Food & Treats</h6>
                            <p class="text-muted">Healthy goodness</p>
                        </div>
                        <div class="cat-img">🥣</div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="category-card reveal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="soft-icon mb-2">🎾</div>
                            <h6>Toys & Training</h6>
                            <p class="text-muted">Play more</p>
                        </div>
                        <div class="cat-img">🐰</div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="category-card reveal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="soft-icon mb-2">🪮</div>
                            <h6>Grooming</h6>
                            <p class="text-muted">Shine & clean</p>
                        </div>
                        <div class="cat-img">🧴</div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- <section class="container my-4 deal-strip reveal d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h5>🎉 Pawsome Deals! Up to <span class="gradient-text">40% OFF</span> on Top Brands</h5>
            <p class="mb-0 text-muted">Limited time offer. Shop now and save big on your pet’s favorites!</p>
        </div><a class="btn btn-main" href="pages/shop.html">Explore Deals</a>
    </section> --}}
    <section class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title">Recommended For You ✨</h3><a href="{{ route('shop') }}" class="btn btn-soft">View All</a>
        </div>
        <div class="row g-4">
            @forelse ($products as $product)
                @php
                    $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
                    $sellingPrice = $hasDiscount ? $product->discount_price : $product->price;
                    $inStock = $product->stock > 0;
                @endphp
                <div class="col-md-6 col-lg-3 reveal">
                    <div class="product-card h-100">
                        <div class="position-relative">
                            @if ($product->is_featured)
                                <span class="tag position-absolute m-3">Featured</span>
                            @elseif ($hasDiscount)
                                <span class="tag position-absolute m-3">Deal</span>
                            @endif
                            <a href="{{ route('product.details') }}" class="d-block text-decoration-none">
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <span class="product-emoji">🐾</span>
                                @endif
                            </a>
                        </div>
                        <div class="product-body">
                            <p class="text-muted mb-1">{{ $product->subcategory?->name ?? 'Pet Care' }}</p>
                            <h5 class="fw-semibold">{{ $product->name }}</h5>
                            <div class="text-warning">★★★★★
                                <span class="text-muted">{{ $inStock ? 'In Stock' : 'Out of Stock' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="price">₹{{ number_format($sellingPrice) }}</span>
                                    @if ($hasDiscount)
                                        <span class="old">₹{{ number_format($product->price) }}</span>
                                    @endif
                                </div>
                                <button class="btn btn-main py-2 addCart" data-id="{{ $product->id }}"
                                    @disabled(!$inStock)>Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="glass-card p-5 text-center reveal">
                        <div style="font-size:64px">🐾</div>
                        <h5 class="mt-3">No products available right now</h5>
                        <p class="text-muted mb-0">New arrivals are on the way — please check back soon.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
    <section class="container my-5">
        @php
            // Deliberately distinct from the three hero cards (Fast Delivery,
            // 100% Genuine, 24/7 Support) so the page doesn't repeat itself.
            $benefits = [
                ['icon' => '🩺', 'title' => 'Vet-Checked Range', 'text' => 'Every product is reviewed by practising vets before it reaches our shelves.'],
                ['icon' => '↩️', 'title' => '30-Day Easy Returns', 'text' => 'Not the right fit? Start a return within 30 days — no questions asked.'],
                ['icon' => '🔒', 'title' => 'Secure Checkout', 'text' => 'Pay by UPI, card or cash on delivery. Every transaction is encrypted.'],
                ['icon' => '🏷️', 'title' => 'Honest Pricing', 'text' => 'Clear prices, regular offers and no surprise charges at checkout.'],
            ];
        @endphp
        <div class="text-center mb-5">
            <span class="pill">🐾 Why PetSaathi</span>
            <h3 class="section-title mt-3">Built Around Your Pet's <span class="gradient-text">Wellbeing</span></h3>
            <p class="text-muted mb-0">Small promises we keep on every single order.</p>
        </div>
        <div class="row g-4">
            @foreach ($benefits as $benefit)
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card p-4 h-100 text-center reveal">
                        <div class="feature-icon mx-auto mb-3">{{ $benefit['icon'] }}</div>
                        <h6 class="fw-bold mb-2">{{ $benefit['title'] }}</h6>
                        <p class="text-muted small mb-0">{{ $benefit['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container my-5">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="glass-card p-4 reveal">
                    <h2 class="count gradient-text" data-count="{{ $stats['customers'] }}">0</h2>
                    <p>Happy Parents</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 reveal">
                    <h2 class="count gradient-text" data-count="{{ $stats['products'] }}">0</h2>
                    <p>Products</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 reveal">
                    <h2 class="count gradient-text" data-count="98">0</h2>
                    <p>Positive Reviews</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="glass-card p-4 reveal">
                    <h2 class="count gradient-text" data-count="24">0</h2>
                    <p>Hour Support</p>
                </div>
            </div>
        </div>
    </section>
@endsection
