@extends('layouts.root')

@section('title', 'Cart | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Shopping Cart</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="glass-card p-4 reveal">
                        <div class="d-flex align-items-center gap-3 border-bottom py-3">
                            <div style="font-size:60px">🦷</div>
                            <div class="flex-grow-1">
                                <h5>Dental Care Chew Sticks</h5>
                                <p class="text-muted mb-0">Qty: 1</p>
                            </div><strong>₹349</strong>
                        </div>
                        <div class="d-flex align-items-center gap-3 py-3">
                            <div style="font-size:60px">🐰</div>
                            <div class="flex-grow-1">
                                <h5>Squeaky Bunny Toy</h5>
                                <p class="text-muted mb-0">Qty: 2</p>
                            </div><strong>₹598</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="glass-card p-4 reveal">
                        <h4>Order Summary</h4>
                        <div class="d-flex justify-content-between"><span>Subtotal</span><b>₹947</b></div>
                        <hr><a href="checkout.html" class="btn btn-main w-100">Proceed Checkout</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
