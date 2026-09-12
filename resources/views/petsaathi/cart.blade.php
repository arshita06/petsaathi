@extends('layouts.root')

@section('title', 'Cart | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Shopping Cart</h1>
                <p class="text-muted mb-0">
                    {{ $items->count() }} {{ Str::plural('item', $items->count()) }} in your cart.
                </p>
            </div>
        </section>

        <section class="container my-5">
            {{-- Messages set by CartController --}}
            @if (session('cart_status'))
                <div class="auth-alert auth-alert-success mb-4" role="status">
                    <span>🛒</span><span>{{ session('cart_status') }}</span>
                </div>
            @endif
            @if (session('cart_error'))
                <div class="auth-alert auth-alert-error mb-4" role="alert">
                    <span>⚠️</span><span>{{ session('cart_error') }}</span>
                </div>
            @endif

            @if ($items->isEmpty())
                {{-- Nothing in the cart yet --}}
                <div class="glass-card p-5 text-center reveal">
                    <div style="font-size:64px">🛒</div>
                    <h5 class="mt-3">Your cart is empty</h5>
                    <p class="text-muted">Add a few treats and they will show up here.</p>
                    <a href="{{ route('shop') }}" class="btn btn-main mt-2">Browse the Shop →</a>
                </div>
            @else
                <div class="row g-4">
                    {{-- ---------- Left: the items ---------- --}}
                    <div class="col-lg-8">
                        <div class="glass-card p-4 reveal">
                            @foreach ($items as $item)
                                @php $product = $item->product; @endphp
                                <div class="cart-row">
                                    <div class="cart-thumb">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <span>🐾</span>
                                        @endif
                                    </div>

                                    <div class="cart-info">
                                        <p class="cart-cat">{{ $product->subcategory?->name ?? 'Pet Care' }}</p>
                                        <h5 class="cart-name">{{ $product->name }}</h5>
                                        <div class="cart-unit">
                                            &#8377;{{ number_format($product->sellingPrice()) }} each
                                            @if ($product->hasDiscount())
                                                <span class="old">&#8377;{{ number_format($product->price) }}</span>
                                            @endif
                                        </div>

                                        {{-- Change how many. Submitting posts to CartController@update --}}
                                        <form method="POST" action="{{ route('cart.update') }}" class="cart-qty-form">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                            <label class="visually-hidden"
                                                for="qty{{ $item->id }}">Quantity</label>
                                            <input type="number" class="form-control cart-qty" id="qty{{ $item->id }}"
                                                name="quantity" value="{{ $item->quantity }}" min="1"
                                                max="{{ max($product->stock, 1) }}">
                                            <button type="submit" class="btn btn-soft cart-qty-btn">Update</button>
                                        </form>
                                    </div>

                                    <div class="cart-end">
                                        <strong class="cart-line-total">&#8377;{{ number_format($item->lineTotal()) }}</strong>

                                        {{-- Remove this row, posts to CartController@remove --}}
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                            <button type="submit" class="cart-remove"
                                                aria-label="Remove {{ $product->name }}">&times;</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('shop') }}" class="btn btn-soft mt-3">← Continue Shopping</a>
                    </div>

                    {{-- ---------- Right: the totals ---------- --}}
                    <div class="col-lg-4">
                        <div class="glass-card p-4 reveal cart-summary">
                            <h4 class="mb-3">Order Summary</h4>

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <b>&#8377;{{ number_format($subtotal) }}</b>
                            </div>
                            <div class="summary-row">
                                <span>Delivery</span>
                                <b>
                                    @if ($shipping > 0)
                                        &#8377;{{ number_format($shipping) }}
                                    @else
                                        <span class="free-tag">Free</span>
                                    @endif
                                </b>
                            </div>

                            @if ($shipping > 0)
                                <p class="summary-hint">
                                    Add &#8377;{{ number_format(App\Http\Controllers\CartController::FREE_SHIPPING_ABOVE - $subtotal) }}
                                    more to get free delivery.
                                </p>
                            @endif

                            <hr>

                            <div class="summary-row summary-total">
                                <span>Total</span>
                                <b>&#8377;{{ number_format($total) }}</b>
                            </div>

                            <a href="{{ route('checkout') }}" class="btn btn-main w-100 mt-3">Proceed to Checkout →</a>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </main>
@endsection
