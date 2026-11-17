@extends('layouts.root')

@section('title', 'Checkout | PetSaathi')

@section('content')
<main>
<section class="page-hero"><div class="container"><h1 class="section-title">Checkout</h1><p class="text-muted mb-0">Just a few details and your pet's order is on its way.</p></div></section>

<section class="container checkout-section">
@if (session('checkout_error'))
  <div class="auth-alert auth-alert-error mb-4" role="alert">
    <span>!</span><span>{{ session('checkout_error') }}</span>
  </div>
@endif
@if ($errors->any())
  <div class="auth-alert auth-alert-error mb-4" role="alert">
    <span>!</span><span>Please fix the highlighted fields before placing your order.</span>
  </div>
@endif

<form id="checkoutForm" method="POST" action="{{ route('order.place') }}" novalidate>
@csrf
<div class="row g-4">

<div class="col-lg-7">
<div class="glass-card p-4 p-md-5 reveal">
<h4 class="form-section-title"><span class="num">1</span> Shipping Details</h4>
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="fullName">Full Name</label>
    <input class="form-control @error('fullName') is-invalid @enderror" id="fullName" name="fullName" value="{{ old('fullName', auth()->user()->name) }}" placeholder="e.g. Aditi Sharma" required>
    <div class="field-error @error('fullName') show @enderror" id="fullNameError">@error('fullName') {{ $message }} @else Please enter your full name. @enderror</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="email">Email Address</label>
    <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="you@example.com" required>
    <div class="field-error @error('email') show @enderror" id="emailError">@error('email') {{ $message }} @else Please enter a valid email address. @enderror</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="phone">Phone Number</label>
    <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="10-digit mobile number" maxlength="10" required>
    <div class="field-error @error('phone') show @enderror" id="phoneError">@error('phone') {{ $message }} @else Please enter a valid 10-digit phone number. @enderror</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="pincode">Pincode</label>
    <input class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ old('pincode') }}" placeholder="6-digit pincode" maxlength="6" required>
    <div class="field-error @error('pincode') show @enderror" id="pincodeError">@error('pincode') {{ $message }} @else Please enter a valid 6-digit pincode. @enderror</div>
  </div>
  <div class="col-12">
    <label class="form-label" for="address">Complete Address</label>
    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="House no., street, locality" required>{{ old('address') }}</textarea>
    <div class="field-error @error('address') show @enderror" id="addressError">@error('address') {{ $message }} @else Please enter your complete address. @enderror</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="city">City</label>
    <input class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" placeholder="e.g. Ludhiana" required>
    <div class="field-error @error('city') show @enderror" id="cityError">@error('city') {{ $message }} @else Please enter your city. @enderror</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="state">State</label>
    <select class="form-select @error('state') is-invalid @enderror" id="state" name="state" required>
      <option value="">Select State</option>
      @foreach (['Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chhattisgarh','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Odisha','Punjab','Rajasthan','Sikkim','Tamil Nadu','Telangana','Tripura','Uttar Pradesh','Uttarakhand','West Bengal'] as $stateName)
        <option value="{{ $stateName }}" @selected(old('state') === $stateName)>{{ $stateName }}</option>
      @endforeach
    </select>
    <div class="field-error @error('state') show @enderror" id="stateError">@error('state') {{ $message }} @else Please select your state. @enderror</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="country">Country</label>
    <select class="form-select @error('country') is-invalid @enderror" id="country" name="country" required>
      @foreach (['India','United States','United Kingdom','Canada','Australia','United Arab Emirates','Singapore'] as $countryName)
        <option value="{{ $countryName }}" @selected(old('country', 'India') === $countryName)>{{ $countryName }}</option>
      @endforeach
    </select>
    <div class="field-error @error('country') show @enderror" id="countryError">@error('country') {{ $message }} @else Please select your country. @enderror</div>
  </div>
  <div class="col-12">
    <label class="form-label" for="instructions">Delivery Instructions <span class="optional-tag">Optional</span></label>
    <textarea class="form-control" id="instructions" name="instructions" rows="2" placeholder="e.g. Leave with security guard, call before delivery...">{{ old('instructions') }}</textarea>
  </div>
</div>
</div>

@php $selectedPayment = old('paymentMethod', 'cod'); @endphp
<div class="glass-card p-4 p-md-5 reveal mt-4">
<h4 class="form-section-title"><span class="num">2</span> Payment Method</h4>
<div class="payment-options">
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payUpi" value="upi" @checked($selectedPayment === 'upi')>
    <label for="payUpi"><span class="pay-icon">UPI</span><span class="pay-name">UPI</span></label>
  </div>
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payCard" value="card" @checked($selectedPayment === 'card')>
    <label for="payCard"><span class="pay-icon">Card</span><span class="pay-name">Credit / Debit Card</span></label>
  </div>
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payCod" value="cod" @checked($selectedPayment === 'cod')>
    <label for="payCod"><span class="pay-icon">COD</span><span class="pay-name">Cash on Delivery</span></label>
  </div>
</div>
<div class="field-error @error('paymentMethod') show @enderror" id="paymentMethodError">@error('paymentMethod') {{ $message }} @else Only Cash on Delivery is available right now. @enderror</div>

<div class="pay-detail {{ $selectedPayment === 'upi' ? 'show' : '' }}" id="upiDetail">
  <label class="form-label" for="upiId">UPI ID</label>
  <input class="form-control" id="upiId" name="upiId" placeholder="yourname@upi">
  <div class="field-error" id="upiIdError">Online UPI payment is visible but not active yet.</div>
</div>

<div class="pay-detail {{ $selectedPayment === 'card' ? 'show' : '' }}" id="cardDetail">
  <div class="row g-3">
    <div class="col-12">
      <label class="form-label" for="cardName">Cardholder Name</label>
      <input class="form-control" id="cardName" name="cardName" placeholder="Name on card">
    </div>
    <div class="col-12">
      <label class="form-label" for="cardNumber">Card Number</label>
      <input class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
    </div>
    <div class="col-6">
      <label class="form-label" for="cardExpiry">Expiry Date</label>
      <input class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" maxlength="5">
    </div>
    <div class="col-6">
      <label class="form-label" for="cardCvv">CVV</label>
      <input class="form-control" type="password" id="cardCvv" name="cardCvv" placeholder="***" maxlength="4">
    </div>
  </div>
</div>

<div class="pay-detail {{ $selectedPayment === 'cod' ? 'show' : '' }}" id="codDetail">
  <p class="cod-note">You have chosen <strong>Cash on Delivery</strong>. Please keep the exact amount ready. Our delivery partner will collect payment when your order arrives.</p>
</div>
</div>
</div>

<div class="col-lg-5">
<div class="glass-card p-4 order-summary-card reveal">
<h4 class="mb-3">Order Summary</h4>
<div id="orderItemsList">
  @foreach ($items as $item)
    @php $product = $item->product; @endphp
    <div class="summary-item">
      <div class="item-emoji">
        @if ($product->image)
          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
        @else
          <span>PS</span>
        @endif
      </div>
      <div class="item-info">
        <div class="item-name">{{ $product->name }}</div>
        <div class="item-variant">{{ $product->subcategory?->name ?? 'Pet Care' }} x {{ $item->quantity }}</div>
      </div>
      <div class="item-price">&#8377;{{ number_format($item->lineTotal()) }}</div>
    </div>
  @endforeach
</div>

<div class="checkout-cost-grid" aria-label="Order cost breakdown">
  <div class="checkout-cost-cell">
    <span>Products</span>
    <strong>&#8377;{{ number_format($subtotal) }}</strong>
  </div>
  <div class="checkout-cost-cell shipping">
    <span>Shipping Charges</span>
    <strong>{!! $shipping > 0 ? '&#8377;'.number_format($shipping) : 'FREE' !!}</strong>
  </div>
  <div class="checkout-cost-cell total">
    <span>Total Payable</span>
    <strong>&#8377;{{ number_format($total) }}</strong>
  </div>
</div>

<div class="summary-row"><span>Cart Subtotal</span><b id="subtotalVal">&#8377;{{ number_format($subtotal) }}</b></div>
<div class="summary-row"><span>Delivery Charges</span><b id="deliveryVal">{!! $shipping > 0 ? '&#8377;'.number_format($shipping) : 'FREE' !!}</b></div>
<div class="summary-row total"><span>Total Payable</span><span id="totalVal">&#8377;{{ number_format($total) }}</span></div>

<button type="submit" class="btn btn-main w-100 btn-place-order mt-3" id="placeOrderBtn"><span id="placeOrderText">Place Order</span></button>

<div class="trust-row">
  <span class="trust-chip">Secure Checkout</span>
  <span class="trust-chip">Delivery in 3-5 days</span>
  <span class="trust-chip">7-day easy returns</span>
  <span class="trust-chip">Genuine Products</span>
</div>
</div>
</div>

</div>
</form>
</section>
</main>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/checkout.js') }}"></script>
@endpush
