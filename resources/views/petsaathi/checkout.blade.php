<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Checkout | PetSaathi</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head><body>
<div id="header"></div>
<main>
<section class="page-hero"><div class="container"><h1 class="section-title">Checkout</h1><p class="text-muted mb-0">Just a few details and your pet's order is on its way 🐾</p></div></section>

<section class="container checkout-section">
<form id="checkoutForm" novalidate>
<div class="row g-4">

<div class="col-lg-7">
<div class="glass-card p-4 p-md-5 reveal">
<h4 class="form-section-title"><span class="num">1</span> Shipping Details</h4>
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="fullName">Full Name</label>
    <input class="form-control" id="fullName" name="fullName" placeholder="e.g. Aditi Sharma" required>
    <div class="field-error" id="fullNameError">Please enter your full name.</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="email">Email Address</label>
    <input class="form-control" type="email" id="email" name="email" placeholder="you@example.com" required>
    <div class="field-error" id="emailError">Please enter a valid email address.</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="phone">Phone Number</label>
    <input class="form-control" type="tel" id="phone" name="phone" placeholder="10-digit mobile number" maxlength="10" required>
    <div class="field-error" id="phoneError">Please enter a valid 10-digit phone number.</div>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="pincode">Pincode</label>
    <input class="form-control" id="pincode" name="pincode" placeholder="6-digit pincode" maxlength="6" required>
    <div class="field-error" id="pincodeError">Please enter a valid 6-digit pincode.</div>
  </div>
  <div class="col-12">
    <label class="form-label" for="address">Complete Address</label>
    <textarea class="form-control" id="address" name="address" rows="2" placeholder="House no., street, locality" required></textarea>
    <div class="field-error" id="addressError">Please enter your complete address.</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="city">City</label>
    <input class="form-control" id="city" name="city" placeholder="e.g. Ludhiana" required>
    <div class="field-error" id="cityError">Please enter your city.</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="state">State</label>
    <select class="form-select" id="state" name="state" required>
      <option value="">Select State</option>
      <option>Andhra Pradesh</option><option>Arunachal Pradesh</option><option>Assam</option><option>Bihar</option><option>Chhattisgarh</option><option>Delhi</option><option>Goa</option><option>Gujarat</option><option>Haryana</option><option>Himachal Pradesh</option><option>Jharkhand</option><option>Karnataka</option><option>Kerala</option><option>Madhya Pradesh</option><option>Maharashtra</option><option>Manipur</option><option>Meghalaya</option><option>Mizoram</option><option>Nagaland</option><option>Odisha</option><option>Punjab</option><option>Rajasthan</option><option>Sikkim</option><option>Tamil Nadu</option><option>Telangana</option><option>Tripura</option><option>Uttar Pradesh</option><option>Uttarakhand</option><option>West Bengal</option>
    </select>
    <div class="field-error" id="stateError">Please select your state.</div>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="country">Country</label>
    <select class="form-select" id="country" name="country" required>
      <option>India</option><option>United States</option><option>United Kingdom</option><option>Canada</option><option>Australia</option><option>United Arab Emirates</option><option>Singapore</option>
    </select>
    <div class="field-error" id="countryError">Please select your country.</div>
  </div>
  <div class="col-12">
    <label class="form-label" for="instructions">Delivery Instructions <span class="optional-tag">Optional</span></label>
    <textarea class="form-control" id="instructions" name="instructions" rows="2" placeholder="e.g. Leave with security guard, call before delivery..."></textarea>
  </div>
</div>
</div>

<div class="glass-card p-4 p-md-5 reveal mt-4">
<h4 class="form-section-title"><span class="num">2</span> Payment Method</h4>
<div class="payment-options">
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payUpi" value="upi" checked>
    <label for="payUpi"><span class="pay-icon">📲</span><span class="pay-name">UPI</span></label>
  </div>
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payCard" value="card">
    <label for="payCard"><span class="pay-icon">💳</span><span class="pay-name">Credit / Debit Card</span></label>
  </div>
  <div class="pay-option">
    <input type="radio" name="paymentMethod" id="payCod" value="cod">
    <label for="payCod"><span class="pay-icon">💵</span><span class="pay-name">Cash on Delivery</span></label>
  </div>
</div>

<div class="pay-detail show" id="upiDetail">
  <label class="form-label" for="upiId">UPI ID</label>
  <input class="form-control" id="upiId" name="upiId" placeholder="yourname@upi" required>
  <div class="field-error" id="upiIdError">Please enter a valid UPI ID (e.g. name@bank).</div>
</div>

<div class="pay-detail" id="cardDetail">
  <div class="row g-3">
    <div class="col-12">
      <label class="form-label" for="cardName">Cardholder Name</label>
      <input class="form-control" id="cardName" name="cardName" placeholder="Name on card">
      <div class="field-error" id="cardNameError">Please enter the cardholder's name.</div>
    </div>
    <div class="col-12">
      <label class="form-label" for="cardNumber">Card Number</label>
      <input class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
      <div class="field-error" id="cardNumberError">Please enter a valid 16-digit card number.</div>
    </div>
    <div class="col-6">
      <label class="form-label" for="cardExpiry">Expiry Date</label>
      <input class="form-control" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" maxlength="5">
      <div class="field-error" id="cardExpiryError">Use MM/YY format.</div>
    </div>
    <div class="col-6">
      <label class="form-label" for="cardCvv">CVV</label>
      <input class="form-control" type="password" id="cardCvv" name="cardCvv" placeholder="***" maxlength="4">
      <div class="field-error" id="cardCvvError">Please enter a valid CVV.</div>
    </div>
  </div>
</div>

<div class="pay-detail" id="codDetail">
  <p class="cod-note">💵 You've chosen <strong>Cash on Delivery</strong>. Please keep the exact amount ready — our delivery partner will collect payment when your order arrives.</p>
</div>
</div>
</div>

<div class="col-lg-5">
<div class="glass-card p-4 order-summary-card reveal">
<h4 class="mb-3">Order Summary</h4>
<div id="orderItemsList"></div>
<div class="empty-cart-box" id="emptyCartBox" style="display:none">
  <div class="emoji">🛒</div>
  <h6 class="fw-semibold">Your cart is empty</h6>
  <p class="text-muted small mb-3">Add some pawsome products before checking out.</p>
  <a href="shop.html" class="btn btn-soft btn-sm">Continue Shopping</a>
</div>

<div class="coupon-row">
  <input class="form-control" id="couponInput" placeholder="Enter coupon code">
  <button type="button" class="btn btn-soft" id="applyCouponBtn">Apply</button>
</div>
<div class="field-error" id="couponMsg"></div>

<div class="summary-row"><span>Cart Subtotal</span><b id="subtotalVal">₹0</b></div>
<div class="summary-row"><span>Delivery Charges</span><b id="deliveryVal">FREE</b></div>
<div class="summary-row" id="discountRow" style="display:none"><span>Coupon Discount</span><b class="discount-val" id="discountVal">−₹0</b></div>
<div class="summary-row"><span>Tax (GST 5%)</span><b id="taxVal">₹0</b></div>
<div class="summary-row total"><span>Total Payable</span><span id="totalVal">₹0</span></div>

<button type="submit" class="btn btn-main w-100 btn-place-order mt-3" id="placeOrderBtn"><span id="placeOrderText">Place Order</span></button>

<div class="trust-row">
  <span class="trust-chip">🔒 100% Secure Checkout</span>
  <span class="trust-chip">🚚 Delivery in 3–5 days</span>
  <span class="trust-chip">↩️ 7-day easy returns</span>
  <span class="trust-chip">✅ Genuine Products</span>
</div>
</div>
</div>

</div>
</form>
</section>
</main>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/checkout.js"></script>
</body></html>
