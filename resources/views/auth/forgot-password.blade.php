@extends('layouts.root')

@section('title', 'Reset Password | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
            <h1 class="section-title h3 mt-2 mb-1">Forgot Your Password?</h1>
            <p class="text-muted mb-0">Enter your email and we'll send you a reset link.</p>
        </div>

        @include('auth.partials.status')

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="email">Email Address</label>
                <span class="field-icon" aria-hidden="true">✉️</span>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com" required autofocus
                    @error('email') aria-describedby="email-error" aria-invalid="true" @enderror>
                @error('email')
                    <div class="field-error show" id="email-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-main w-100 btn-place-order">Send Reset Link</button>
        </form>

        <p class="text-center mt-4 mb-0">
            <a href="{{ route('login') }}" class="auth-links small">← Back to login</a>
        </p>
    </div>
</section>
@endsection
