{{-- Session flash + validation summary, styled to match the storefront. --}}
@if (session('status'))
    <div class="auth-alert auth-alert-success" role="status">
        <span aria-hidden="true">✅</span>
        <span>{{ session('status') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="auth-alert auth-alert-error" role="alert">
        <span aria-hidden="true">⚠️</span>
        <span>{{ $errors->count() === 1 ? $errors->first() : __('Please check the highlighted fields below.') }}</span>
    </div>
@endif
