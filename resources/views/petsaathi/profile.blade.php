@extends('layouts.root')

@section('title', 'My Profile | PetSaathi')

@section('content')
    {{-- .reveal starts at opacity:0 and is shown by app.js. Without JS this is a
         form the user cannot see, so make it visible when scripts are off. --}}
    <noscript>
        <style>
            .reveal {
                opacity: 1;
                transform: none;
            }
        </style>
    </noscript>

    @php
        $initials = collect(explode(' ', trim($user->name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->implode('');
    @endphp

    <section class="page-hero">
        <div class="container">
            <span class="pill">🐾 Your Account</span>
            <h1 class="section-title mt-3 mb-1">My Profile</h1>
            <p class="text-muted mb-0">Keep your details and delivery address up to date for smoother deliveries.</p>
        </div>
    </section>

    <section class="container my-5">
        <div class="row g-4">
            {{-- Identity summary --}}
            <div class="col-lg-4">
                <div class="glass-card p-4 text-center reveal profile-summary">
                    <div class="profile-avatar mx-auto mb-3">{{ $initials ?: '🐾' }}</div>
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-4">{{ $user->email }}</p>

                    <ul class="profile-meta text-start">
                        <li>
                            <span class="soft-icon">📞</span>
                            <div>
                                <small class="text-muted d-block">Phone</small>
                                <span>{{ $user->phone ?: 'Not added yet' }}</span>
                            </div>
                        </li>
                        <li>
                            <span class="soft-icon">📍</span>
                            <div>
                                <small class="text-muted d-block">Address</small>
                                <span>{{ $user->address ?: 'Not added yet' }}</span>
                            </div>
                        </li>
                        <li>
                            <span class="soft-icon">🗓️</span>
                            <div>
                                <small class="text-muted d-block">Member since</small>
                                <span>{{ $user->created_at?->format('M Y') ?? '—' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8">
                {{-- Profile information --}}
                <div class="glass-card p-4 p-md-5 mb-4 reveal">
                    <div class="profile-card-head">
                        <span class="feature-icon">👤</span>
                        <div>
                            <h5 class="fw-bold mb-1">Profile Information</h5>
                            <p class="text-muted small mb-0">Your name, contact details and delivery address.</p>
                        </div>
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="auth-alert auth-alert-success" role="status">
                            <span aria-hidden="true">✅</span>
                            <span>Your profile has been updated.</span>
                        </div>
                    @endif

                    @if ($errors->isNotEmpty() && ! $errors->updatePassword->any() && ! $errors->userDeletion->any())
                        <div class="auth-alert auth-alert-error" role="alert">
                            <span aria-hidden="true">⚠️</span>
                            <span>Please check the highlighted fields below.</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" novalidate>
                        @csrf
                        @method('patch')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="name">Full Name</label>
                                    <span class="field-icon" aria-hidden="true">👤</span>
                                    <input id="name" name="name" type="text"
                                        value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Your full name" required autocomplete="name"
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
                                    <input id="email" name="email" type="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="you@example.com" required autocomplete="email"
                                        @error('email') aria-describedby="email-error" aria-invalid="true" @enderror>
                                    @error('email')
                                        <div class="field-error show" id="email-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <span class="field-icon" aria-hidden="true">📞</span>
                                    <input id="phone" name="phone" type="tel"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="+91 98765 43210" autocomplete="tel"
                                        @error('phone') aria-describedby="phone-error" aria-invalid="true" @enderror>
                                    @error('phone')
                                        <div class="field-error show" id="phone-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-icon-group">
                                    <label class="form-label" for="address">Delivery Address</label>
                                    <span class="field-icon" aria-hidden="true">📍</span>
                                    <textarea id="address" name="address" rows="3"
                                        class="form-control @error('address') is-invalid @enderror"
                                        placeholder="House / flat, street, area, city, PIN code"
                                        autocomplete="street-address"
                                        @error('address') aria-describedby="address-error" aria-invalid="true" @enderror>{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="field-error show" id="address-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-main">Update Profile</button>
                            <a href="{{ route('profile.edit') }}" class="btn btn-soft">Reset</a>
                        </div>
                    </form>
                </div>

                {{-- Password --}}
                <div class="glass-card p-4 p-md-5 mb-4 reveal">
                    <div class="profile-card-head">
                        <span class="feature-icon">🔒</span>
                        <div>
                            <h5 class="fw-bold mb-1">Password</h5>
                            <p class="text-muted small mb-0">Use a long, unique password to keep your account safe.</p>
                        </div>
                    </div>

                    @if (session('status') === 'password-updated')
                        <div class="auth-alert auth-alert-success" role="status">
                            <span aria-hidden="true">✅</span>
                            <span>Your password has been changed.</span>
                        </div>
                    @endif

                    @if ($errors->updatePassword->any())
                        <div class="auth-alert auth-alert-error" role="alert">
                            <span aria-hidden="true">⚠️</span>
                            <span>{{ $errors->updatePassword->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" novalidate>
                        @csrf
                        @method('put')

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="input-icon-group">
                                    <label class="form-label" for="current_password">Current Password</label>
                                    <span class="field-icon" aria-hidden="true">🔑</span>
                                    <input id="current_password" name="current_password" type="password"
                                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                        placeholder="Enter your current password" autocomplete="current-password">
                                    <button type="button" class="toggle-pass" data-target="current_password"
                                        aria-label="Show password">👁️</button>
                                    @error('current_password', 'updatePassword')
                                        <div class="field-error show">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="password">New Password</label>
                                    <span class="field-icon" aria-hidden="true">🔒</span>
                                    <input id="password" name="password" type="password"
                                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                        placeholder="At least 8 characters" autocomplete="new-password">
                                    <button type="button" class="toggle-pass" data-target="password"
                                        aria-label="Show password">👁️</button>
                                    <div class="auth-strength" data-strength-for="password" data-level="0"
                                        aria-hidden="true">
                                        <span></span><span></span><span></span>
                                    </div>
                                    @error('password', 'updatePassword')
                                        <div class="field-error show">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                    <span class="field-icon" aria-hidden="true">🔒</span>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="Repeat the new password"
                                        autocomplete="new-password">
                                    <button type="button" class="toggle-pass" data-target="password_confirmation"
                                        aria-label="Show password">👁️</button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-main">Change Password</button>
                        </div>
                    </form>
                </div>

                {{-- Account removal --}}
                <div class="glass-card p-4 p-md-5 reveal profile-danger">
                    <div class="profile-card-head">
                        <span class="feature-icon danger">⚠️</span>
                        <div>
                            <h5 class="fw-bold mb-1">Delete Account</h5>
                            <p class="text-muted small mb-0">This permanently removes your account and order history.
                                It cannot be undone.</p>
                        </div>
                    </div>

                    @if ($errors->userDeletion->any())
                        <div class="auth-alert auth-alert-error" role="alert">
                            <span aria-hidden="true">⚠️</span>
                            <span>{{ $errors->userDeletion->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.destroy') }}" novalidate
                        onsubmit="return confirm('Delete your PetSaathi account permanently? This cannot be undone.');">
                        @csrf
                        @method('delete')

                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <div class="input-icon-group">
                                    <label class="form-label" for="delete_password">Confirm with your password</label>
                                    <span class="field-icon" aria-hidden="true">🔑</span>
                                    <input id="delete_password" name="password" type="password"
                                        class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                        placeholder="Enter your password" autocomplete="current-password">
                                    <button type="button" class="toggle-pass" data-target="delete_password"
                                        aria-label="Show password">👁️</button>
                                    @error('password', 'userDeletion')
                                        <div class="field-error show">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger-soft">Delete My Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/auth-ui.js') }}"></script>
@endpush
