@extends('layouts.root')

@section('title', 'Wishlist | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">My Wishlist</h1>
                <p class="text-muted mb-0">
                    {{ $items->count() }} {{ Str::plural('item', $items->count()) }} saved for later.
                </p>
            </div>
        </section>

        <section class="container my-5">
            {{-- Message set by WishlistController@toggle --}}
            @if (session('wishlist_status'))
                <div class="auth-alert auth-alert-success mb-4" role="status">
                    <span>❤️</span>
                    <span>{{ session('wishlist_status') }}</span>
                </div>
            @endif

            <div class="row g-4">
                {{-- @forelse loops the saved items, and falls into @empty when there are none --}}
                @forelse ($items as $item)
                    @php
                        $product = $item->product;
                        $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
                        $sellingPrice = $hasDiscount ? $product->discount_price : $product->price;
                        $inStock = $product->stock > 0;
                    @endphp
                    <div class="col-md-6 col-lg-4 reveal">
                        <div class="product-card h-100">
                            <div class="position-relative">
                                {{-- Same toggle route as the shop page: clicking it here removes the product --}}
                                <form method="POST" action="{{ route('wishlist.toggle') }}" class="wish-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="wish-btn active" title="Remove from wishlist"
                                        aria-label="Remove {{ $product->name }} from wishlist">♥</button>
                                </form>

                                <a href="{{ route('product.details') }}" class="d-block text-decoration-none">
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <span class="product-emoji">&#128062;</span>
                                    @endif
                                </a>
                            </div>
                            <div class="product-body">
                                <p class="text-muted mb-1">{{ $product->subcategory?->name ?? 'Pet Care' }}</p>
                                <h5 class="fw-semibold">{{ $product->name }}</h5>
                                <div class="text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;
                                    <span class="text-muted">{{ $inStock ? 'In Stock' : 'Out of Stock' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <span class="price">&#8377;{{ number_format($sellingPrice) }}</span>
                                        @if ($hasDiscount)
                                            <span class="old">&#8377;{{ number_format($product->price) }}</span>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-main py-2" @disabled(!$inStock)>Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="glass-card p-5 text-center reveal">
                            <div style="font-size:64px">💔</div>
                            <h5 class="mt-3">Your wishlist is empty</h5>
                            <p class="text-muted">Tap the ♡ on any product to save it here for later.</p>
                            <a href="{{ route('shop') }}" class="btn btn-main mt-2">Browse the Shop →</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection
