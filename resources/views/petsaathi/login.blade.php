<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login | PetSaathi</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head><body>
<div id="header"></div>
<main>
<section class="auth-wrap">
<span class="auth-blob b1"></span><span class="auth-blob b2"></span>
<img class="pet-illustration" src="../assets/images/cute-pets.svg" alt="">

<div class="auth-card reveal" id="authCard">
  <div class="text-center mb-4" id="loginHeading">
    <div class="auth-icon-badge"><img src="../assets/images/logo-paw.svg" alt="PetSaathi"></div>
    <h2 class="section-title mt-2">Welcome Back</h2>
    <p class="text-muted mb-0">Log in to continue your PetSaathi journey.</p>
  </div>

  <form id="loginForm" novalidate>
    <div class="mb-3 input-icon-group">
      <label class="form-label" for="loginEmail">Email Address</label>
      <span class="field-icon">✉️</span>
      <input class="form-control" type="email" id="loginEmail" name="loginEmail" placeholder="you@example.com" required autocomplete="email">
      <div class="field-error" id="loginEmailError">Please enter a valid email address.</div>
    </div>
    <div class="mb-2 input-icon-group">
      <label class="form-label" for="loginPassword">Password</label>
      <span class="field-icon">🔒</span>
      <input class="form-control" type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required autocomplete="current-password">
      <button type="button" class="toggle-pass" data-target="loginPassword" aria-label="Show password">👁️</button>
      <div class="field-error" id="loginPasswordError">Please enter your password.</div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="rememberMe">
        <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
      </div>
      <a href="#" class="auth-links small" id="forgotLink">Forgot Password?</a>
    </div>
    <button type="submit" class="btn btn-main w-100 btn-place-order" id="loginBtn"><span id="loginBtnText">Login</span></button>
  </form>

  <div id="forgotPanel" class="auth-fade" style="display:none">
    <p class="text-muted small mb-3">Enter your email and we'll send you a link to reset your password.</p>
    <label class="form-label" for="resetEmail">Email Address</label>
    <input class="form-control mb-1" type="email" id="resetEmail" placeholder="you@example.com">
    <div class="field-error" id="resetEmailError">Please enter a valid email address.</div>
    <button type="button" class="btn btn-main w-100 btn-place-order mt-3" id="sendResetBtn"><span id="resetBtnText">Send Reset Link</span></button>
    <p class="text-center mt-3 mb-0"><a href="#" class="auth-links" id="backToLoginLink">← Back to Login</a></p>
  </div>

  <p class="text-center mt-4 mb-0" id="registerPrompt">Don't have an account? <a href="register.html" class="auth-links">Register</a></p>
</div>

</section>
</main>
<div id="footer"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/auth.js"></script>
</body></html>
