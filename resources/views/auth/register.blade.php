@extends('layouts.root')

@section('title', 'Create Account | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card auth-card-wide">
        <div class="text-center mb-4">
            <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
            <h1 class="section-title h3 mt-2 mb-1">Join the PetSaathi Family</h1>
            <p class="text-muted mb-0">Create an account to shop, save favourites and track orders.</p>
        </div>

        @include('auth.partials.status')

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="input-icon-group">
                        <label class="form-label" for="name">Full Name</label>
                        <span class="field-icon" aria-hidden="true">👤</span>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Your name" required autofocus autocomplete="name"
                            @error('name') aria-describedby="name-error" aria-invalid="true" @enderror>
                        @error('name')
                            <div class="field-error show" id="name-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-icon-group">
                        <label class="form-label" for="email">Email Address</label>
                        <span class="field-icon" aria-hidden="true">✉️</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="you@example.com" required autocomplete="username"
                            @error('email') aria-describedby="email-error" aria-invalid="true" @enderror>
                        @error('email')
                            <div class="field-error show" id="email-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-icon-group">
                        <label class="form-label" for="password">Password</label>
                        <span class="field-icon" aria-hidden="true">🔒</span>
                        <input id="password" name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="At least 8 characters" required autocomplete="new-password"
                            @error('password') aria-describedby="password-error" aria-invalid="true" @enderror>
                        <button type="button" class="toggle-pass" data-target="password" aria-label="Show password">👁️</button>
                        @error('password')
                            <div class="field-error show" id="password-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="auth-strength" data-strength-for="password" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                    <p class="auth-strength-label small text-muted mb-0">Use 8+ characters with a mix of letters and numbers.</p>
                </div>

                <div class="col-md-6">
                    <div class="input-icon-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <span class="field-icon" aria-hidden="true">🔐</span>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Re-enter your password" required autocomplete="new-password"
                            @error('password_confirmation') aria-describedby="password-confirmation-error" aria-invalid="true" @enderror>
                        <button type="button" class="toggle-pass" data-target="password_confirmation" aria-label="Show password">👁️</button>
                        @error('password_confirmation')
                            <div class="field-error show" id="password-confirmation-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="auth-perks" aria-hidden="true">
                <span class="auth-perk">🚚 Free shipping over ₹999</span>
                <span class="auth-perk">💜 Save your favourites</span>
                <span class="auth-perk">📦 Track every order</span>
            </div>

            <button type="submit" class="btn btn-main w-100 btn-place-order mt-3">Create Account</button>
        </form>

        <div class="auth-divider">or</div>

        <p class="text-center mb-0 small text-muted">
            Already have an account? <a href="{{ route('login') }}" class="auth-links">Log in</a>
        </p>

        <p class="text-center mt-3 mb-0">
            <a href="{{ route('home') }}" class="auth-links small">← Back to store</a>
        </p>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth-ui.js') }}"></script>
@endpush
