@extends('layouts.root')

@section('title', 'Blog | PetSaathi')

@section('content')
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Pet Care Blog</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="glass-card p-4 reveal">
                        <div class="cat-img">🐶</div>
                        <h4>How to Choose Puppy Food</h4>
                        <p class="text-muted">Simple tips for healthy meals.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 reveal">
                        <div class="cat-img">🐱</div>
                        <h4>Cat Grooming Checklist</h4>
                        <p class="text-muted">Keep your cat clean and happy.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 reveal">
                        <div class="cat-img">🦷</div>
                        <h4>Dental Care for Pets</h4>
                        <p class="text-muted">Fresh breath and strong teeth.</p>
                    </div>
                </div>
            </div>
        </section>
@endsection
