@extends('layouts.root')

@section('title', 'Login | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
            <h1 class="section-title h3 mt-2 mb-1">Welcome Back</h1>
            <p class="text-muted mb-0">Log in to continue your PetSaathi journey.</p>
        </div>

        @include('auth.partials.status')

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="email">Email Address</label>
                <span class="field-icon" aria-hidden="true">✉️</span>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com" required autofocus autocomplete="username"
                    @error('email') aria-invalid="true" @enderror>
            </div>

            <div class="mb-2 input-icon-group">
                <label class="form-label" for="password">Password</label>
                <span class="field-icon" aria-hidden="true">🔒</span>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password" required autocomplete="current-password"
                    @error('password') aria-describedby="password-error" aria-invalid="true" @enderror>
                <button type="button" class="toggle-pass" data-target="password" aria-label="Show password">👁️</button>
                @error('password')
                    <div class="field-error show" id="password-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center gap-2 mb-3 mt-3 flex-wrap">
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" @checked(old('remember'))>
                    <label class="form-check-label small text-muted" for="remember">Remember me</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-links small">Forgot Password?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-main w-100 btn-place-order">Log In</button>
        </form>

        <div class="auth-divider">or</div>

        <p class="text-center mb-0 small text-muted">
            New to PetSaathi? <a href="{{ route('register') }}" class="auth-links">Create an account</a>
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
