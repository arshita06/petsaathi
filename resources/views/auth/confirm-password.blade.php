@extends('layouts.root')

@section('title', 'Confirm Password | PetSaathi')

@section('content')
<section class="auth-wrap">
    @include('auth.partials.decor')

    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-icon-badge"><img src="{{ asset('assets/images/logo-paw.svg') }}" alt=""></div>
            <h1 class="section-title h3 mt-2 mb-1">Confirm Your Password</h1>
            <p class="text-muted mb-0">This is a secure area — please confirm your password to continue.</p>
        </div>

        @include('auth.partials.status')

        <form method="POST" action="{{ route('password.confirm') }}" novalidate>
            @csrf

            <div class="mb-3 input-icon-group">
                <label class="form-label" for="password">Password</label>
                <span class="field-icon" aria-hidden="true">🔒</span>
                <input id="password" name="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter your password" required autocomplete="current-password" autofocus>
                <button type="button" class="toggle-pass" data-target="password" aria-label="Show password">👁️</button>
                @error('password')
                    <div class="field-error show">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-main w-100 btn-place-order">Confirm</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth-ui.js') }}"></script>
@endpush
