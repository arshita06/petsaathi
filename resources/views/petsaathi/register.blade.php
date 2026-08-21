<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register | PetSaathi</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head><body>
<div id="header"></div>
<main>
<section class="auth-wrap">
<span class="auth-blob b1"></span><span class="auth-blob b2"></span>
<img class="pet-illustration" src="../assets/images/cute-pets.svg" alt="">

<div class="auth-card auth-card-wide reveal">
  <div class="text-center mb-4">
    <div class="auth-icon-badge"><img src="../assets/images/logo-paw.svg" alt="PetSaathi"></div>
    <h2 class="section-title mt-2">Create Your Account</h2>
    <p class="text-muted mb-0">Join PetSaathi and give your pet the care they deserve.</p>
  </div>

  <form id="registerForm" novalidate>
    <div class="row g-3">
      <div class="col-md-6">
        <div class="input-icon-group">
          <label class="form-label" for="regName">Full Name</label>
          <span class="field-icon">👤</span>
          <input class="form-control" id="regName" name="regName" placeholder="e.g. Aditi Sharma" required autocomplete="name">
          <div class="field-error" id="regNameError">Please enter your full name.</div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-icon-group">
          <label class="form-label" for="regEmail">Email Address</label>
          <span class="field-icon">✉️</span>
          <input class="form-control" type="email" id="regEmail" name="regEmail" placeholder="you@example.com" required autocomplete="email">
          <div class="field-error" id="regEmailError">Please enter a valid email address.</div>
        </div>
      </div>
      <div class="col-12">
        <div class="input-icon-group">
          <label class="form-label" for="regPhone">Phone Number</label>
          <span class="field-icon">📱</span>
          <input class="form-control" type="tel" id="regPhone" name="regPhone" placeholder="10-digit mobile number" maxlength="10" required autocomplete="tel">
          <div class="field-error" id="regPhoneError">Please enter a valid 10-digit phone number.</div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-icon-group">
          <label class="form-label" for="regPassword">Password</label>
          <span class="field-icon">🔒</span>
          <input class="form-control" type="password" id="regPassword" name="regPassword" placeholder="Create a password" required autocomplete="new-password">
          <button type="button" class="toggle-pass" data-target="regPassword" aria-label="Show password">👁️</button>
          <div class="field-error" id="regPasswordError">Password must be at least 8 characters.</div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-icon-group">
          <label class="form-label" for="regConfirmPassword">Confirm Password</label>
          <span class="field-icon">🔒</span>
          <input class="form-control" type="password" id="regConfirmPassword" name="regConfirmPassword" placeholder="Re-enter your password" required autocomplete="new-password">
          <button type="button" class="toggle-pass" data-target="regConfirmPassword" aria-label="Show password">👁️</button>
          <div class="field-error" id="regConfirmPasswordError">Passwords do not match.</div>
        </div>
      </div>
    </div>

    <div class="form-check mt-3 mb-3">
      <input class="form-check-input" type="checkbox" id="regTerms" required>
      <label class="form-check-label small text-muted" for="regTerms">I agree to the <a href="#" class="auth-links">Terms &amp; Conditions</a> and <a href="#" class="auth-links">Privacy Policy</a></label>
      <div class="field-error" id="regTermsError">Please accept the Terms &amp; Conditions to continue.</div>
    </div>

    <button type="submit" class="btn btn-main w-100 btn-place-order" id="registerBtn"><span id="registerBtnText">Create Account</span></button>
  </form>

  <p class="text-center mt-4 mb-0">Already have an account? <a href="login.html" class="auth-links">Login</a></p>
</div>

</section>
</main>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/auth.js"></script>
</body></html>
