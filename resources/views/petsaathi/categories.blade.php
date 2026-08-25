@extends('layouts.root')

@section('title', 'Categories | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Shop by Category</h1>
                <p class="text-muted">Everything arranged beautifully for your pet needs.</p>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🥣</div>
                        <h4>Food & Treats</h4>
                        <p class="text-muted">Healthy meals and tasty rewards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🐰</div>
                        <h4>Toys</h4>
                        <p class="text-muted">Playful and training essentials.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🧴</div>
                        <h4>Grooming</h4>
                        <p class="text-muted">Keep pets fresh and confident.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🦷</div>
                        <h4>Healthcare</h4>
                        <p class="text-muted">Vet-approved care products.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🛏️</div>
                        <h4>Accessories</h4>
                        <p class="text-muted">Beds, collars, clothing and more.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card reveal">
                        <div class="cat-img">🎁</div>
                        <h4>Deals</h4>
                        <p class="text-muted">Premium products at sweet prices.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
