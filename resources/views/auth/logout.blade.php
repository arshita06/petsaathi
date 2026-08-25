@extends('layouts.root')

@section('title', 'Log Out | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card text-center">
        <div class="auth-avatar" aria-hidden="true">{{ strtoupper(mb_substr(auth()->user()->name ?? 'P', 0, 1)) }}</div>

        <h1 class="section-title h3 mt-3 mb-1">See you soon, {{ auth()->user()->name ?? 'friend' }}!</h1>
        <p class="text-muted">
            You're about to log out of PetSaathi. Your cart and wishlist stay saved for the next visit.
        </p>

        <div class="auth-paw-divider" aria-hidden="true">🐾 &nbsp; 🐾 &nbsp; 🐾</div>

        <div class="auth-actions">
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="btn btn-main w-100 btn-place-order">Yes, Log Me Out</button>
            </form>

            <a href="{{ url()->previous() === url()->current() ? route('home') : url()->previous() }}"
                class="btn btn-soft w-100">Stay Logged In</a>
        </div>

        <p class="text-center mt-4 mb-0 small text-muted">
            Need a hand? <a href="{{ route('contact') }}" class="auth-links">Contact support</a>
        </p>
    </div>
</section>
@endsection
