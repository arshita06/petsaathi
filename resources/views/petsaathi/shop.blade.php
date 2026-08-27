@extends('layouts.root')

@section('title', 'Shop | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Shop Premium Pet Products</h1>
                <p class="text-muted">Search, filter and discover designer-quality pet essentials.</p>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4">
                <aside class="col-lg-3">
                    <form method="GET" action="{{ route('shop') }}">
                        <div class="glass-card p-4 sticky-top" style="top:100px">
                            <h5>Filters</h5>
                            <input type= "text" name="search" class="form-control mb-3" placeholder="Search product"  id="shopSearch" value="{{ request('search') }}">
                            <select
                                class="form-select mb-3" name="category_id">
                                <option value="">All Categories</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label>Price Range</label>
                            <input type="range" name="max_prize" min="0" max="5000" step="100" class="form-range" value="{{ request('max_prize', 500) }}">
                            <button type="submit" class="btn btn-main w-100">
                                Apply Filter
                            </button>
                        </div>
                    </form>
                </aside>
                <div class="col-lg-9">
                    <div class="row g-4">
                        @forelse ($shops as $product)
                            @php
                                $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
                                $sellingPrice = $hasDiscount ? $product->discount_price : $product->price;
                                $inStock = $product->stock > 0;
                            @endphp
                            <div class="col-md-6 col-lg-4 reveal">
                                <div class="product-card h-100">
                                    <div class="position-relative">
                                        @if ($product->is_featured)
                                            <span class="tag position-absolute m-3">Featured</span>
                                        @elseif ($hasDiscount)
                                            <span class="tag position-absolute m-3">Deal</span>
                                        @endif
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
                                            <button class="btn btn-main py-2 addCart" data-id="{{ $product->id }}"
                                                @disabled(!$inStock)>Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="glass-card p-5 text-center reveal">
                                    <div style="font-size:64px">&#128062;</div>
                                    <h5 class="mt-3">No products found</h5>
                                    <p class="text-muted mb-0">Try changing your filters or search term.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
<script>
    let searchTimer;

    document.getElementById('shopSearch').addEventListener('input', function () {
        clearTimeout(searchTimer);

        searchTimer = setTimeout(() => {
            this.form.submit();
        }, 500);
    });
</script>
