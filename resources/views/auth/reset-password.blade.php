@extends('layouts.root')

@section('title', 'Set New Password | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
            <h1 class="section-title h3 mt-2 mb-1">Set a New Password</h1>
            <p class="text-muted mb-0">Choose a strong password for your account.</p>
        </div>

        @include('auth.partials.status')

        <form method="POST" action="{{ route('password.store') }}" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="email">Email Address</label>
                <span class="field-icon" aria-hidden="true">✉️</span>
                <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}"
                    class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
                @error('email')
                    <div class="field-error show">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="password">New Password</label>
                <span class="field-icon" aria-hidden="true">🔒</span>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="At least 8 characters" required autocomplete="new-password">
                <button type="button" class="toggle-pass" data-target="password" aria-label="Show password">👁️</button>
                @error('password')
                    <div class="field-error show">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <span class="field-icon" aria-hidden="true">🔐</span>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Re-enter your password" required autocomplete="new-password">
                <button type="button" class="toggle-pass" data-target="password_confirmation" aria-label="Show password">👁️</button>
                @error('password_confirmation')
                    <div class="field-error show">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-main w-100 btn-place-order">Reset Password</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth-ui.js') }}"></script>
@endpush
