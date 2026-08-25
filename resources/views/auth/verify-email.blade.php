@extends('layouts.root')

@section('title', 'Verify Email | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card text-center">
        <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
        <h1 class="section-title h3 mt-2 mb-1">Verify Your Email</h1>
        <p class="text-muted">
            Thanks for signing up! Please confirm your email address by clicking the link we just sent you.
            Didn't get it? We'll gladly send another.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="auth-alert auth-alert-success" role="status">
                <span aria-hidden="true">✅</span>
                <span>A fresh verification link has been sent to your email address.</span>
            </div>
        @endif

        <div class="auth-paw-divider" aria-hidden="true">🐾 &nbsp; 🐾 &nbsp; 🐾</div>

        <div class="auth-actions">
            <form method="POST" action="{{ route('verification.send') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-main w-100 btn-place-order">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-soft w-100">Log Out</button>
            </form>
        </div>
    </div>
</section>
@endsection
