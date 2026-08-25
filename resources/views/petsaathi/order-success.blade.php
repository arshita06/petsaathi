@extends('layouts.root')

@section('title', 'Order Confirmed | PetSaathi')

@section('content')
<main>
<section class="page-hero"><div class="container text-center"><h1 class="section-title">Order Confirmed 🎉</h1><p class="text-muted mb-0">Thank you — your pet's package is being prepared with love.</p></div></section>

<section class="container my-5">
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="glass-card p-4 p-md-5 reveal text-center" id="orderResultBox">
  <div style="font-size:64px" class="mb-2">✅</div>
  <h3 class="fw-bold" id="orderNumberVal">—</h3>
  <p class="text-muted">A confirmation email is on its way to you.</p>
  <hr class="my-4">
  <div class="row g-3 text-start">
    <div class="col-md-6">
      <p class="text-muted mb-1 small">Order Total</p>
      <p class="fw-semibold fs-5 mb-0" id="orderTotalVal">₹0</p>
    </div>
    <div class="col-md-6">
      <p class="text-muted mb-1 small">Payment Method</p>
      <p class="fw-semibold fs-5 mb-0" id="orderPaymentVal">—</p>
    </div>
    <div class="col-12">
      <p class="text-muted mb-1 small">Delivery Address</p>
      <p class="fw-semibold mb-0" id="orderAddressVal">—</p>
    </div>
  </div>
  <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
    <a href="shop.html" class="btn btn-main">Continue Shopping →</a>
    <a href="order-history.html" class="btn btn-soft">View Order History</a>
  </div>
</div>
</div>
</div>
</section>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/order-success.js') }}"></script>
@endpush
