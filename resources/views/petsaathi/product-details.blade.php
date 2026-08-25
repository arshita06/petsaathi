@extends('layouts.root')

@section('title', 'Product Details | PetSaathi')

@section('content')
    <main>
        <section class="container my-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="glass-card p-5 text-center reveal">
                        <div style="font-size:220px">🦷</div>
                    </div>
                </div>
                <div class="col-lg-6 reveal"><span class="tag">Vet Pick</span>
                    <h1 class="section-title mt-3">Dental Care Chew Sticks</h1>
                    <p class="text-warning">★★★★★ <span class="text-muted">4.8 reviews</span></p>
                    <h2 class="price">₹349 <span class="old">₹499</span></h2>
                    <p class="text-muted">Premium chew sticks for fresh breath and dental wellness. Designed with
                        vet-approved ingredients.</p>
                    <div class="d-flex gap-3"><input type="number" class="form-control" value="1"
                            style="max-width:90px"><button class="btn btn-main addCart">Add to Cart</button><button
                            class="btn btn-soft">♡ Wishlist</button></div>
                </div>
            </div>
        </section>
    </main>
@endsection
