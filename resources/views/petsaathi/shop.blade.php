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
                                class="form-select mb-3" name="category_id" id="categoryFilter">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"{{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <select class="form-select mb-3" name="subcategory_id" id="subcategoryFilter" @disabled(! $selectedCategory)>
                                <option value="">{{ $selectedCategory ? 'All '.$selectedCategory->name.' Subcategories' : 'Select category first' }}</option>
                                @if ($selectedCategory)
                                    @foreach ($selectedCategory->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" @selected(request('subcategory_id') == $subcategory->id)>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @php
                                $priceFloor = 0;
                                $priceCeil = 5000;
                                $minPrize = (int) request('min_prize', $priceFloor);
                                $maxPrize = (int) request('max_prize', $priceCeil);
                            @endphp
                            <div class="price-filter">
                                <div class="price-filter-head">
                                    <label class="price-filter-label" for="maxPrize">Price Range</label>
                                    <span class="price-range-value" id="priceRangeValue" aria-live="polite">
                                        &#8377;{{ number_format($minPrize) }} &ndash; &#8377;{{ number_format($maxPrize) }}
                                    </span>
                                </div>
                                <div class="price-slider" id="priceSlider">
                                    <div class="price-slider-track"></div>
                                    <div class="price-slider-fill" id="priceSliderFill"></div>
                                    <input type="range" name="min_prize" id="minPrize" aria-label="Minimum price"
                                        min="{{ $priceFloor }}" max="{{ $priceCeil }}" step="500" value="{{ $minPrize }}">
                                    <input type="range" name="max_prize" id="maxPrize" aria-label="Maximum price"
                                        min="{{ $priceFloor }}" max="{{ $priceCeil }}" step="500" value="{{ $maxPrize }}">
                                </div>
                                <div class="price-slider-bounds">
                                    <span>&#8377;{{ number_format($priceFloor) }}</span>
                                    <span>&#8377;{{ number_format($priceCeil) }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-main w-100">
                                Apply Filter
                            </button>
                            <a href="{{ route('shop') }}" class="btn btn-soft w-100 mt-2 btn-clear-filter">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </aside>
                <div class="col-lg-9">
                    {{-- Message set by WishlistController@toggle --}}
                    @if (session('wishlist_status'))
                        <div class="auth-alert auth-alert-success mb-4" role="status">
                            <span>❤️</span>
                            <span>{{ session('wishlist_status') }}</span>
                        </div>
                    @endif

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
                                        @endif

                                        {{-- Wishlist heart. Logged in: posts to the toggle route.
                                             Guest: just a link to the login page. --}}
                                        @auth
                                            @php $saved = in_array($product->id, $wishlistIds); @endphp
                                            <form method="POST" action="{{ route('wishlist.toggle') }}" class="wish-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="wish-btn {{ $saved ? 'active' : '' }}"
                                                    title="{{ $saved ? 'Remove from wishlist' : 'Save to wishlist' }}"
                                                    aria-label="{{ $saved ? 'Remove' : 'Save' }} {{ $product->name }}">{{ $saved ? '♥' : '♡' }}</button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="wish-btn" title="Log in to save this">♡</a>
                                        @endauth

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
                                            {{-- Add to cart. Logged in: posts to the cart.
                                                 Guest: link to login, same as the heart. --}}
                                            @auth
                                                <form method="POST" action="{{ route('cart.add') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-main py-2"
                                                        @disabled(!$inStock)>Add</button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-main py-2">Add</a>
                                            @endauth
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
@push('scripts')
    @php
        $subcategoriesByCategory = $categories->mapWithKeys(function ($category) {
            return [
                $category->id => [
                    'name' => $category->name,
                    'subcategories' => $category->subcategories->map(function ($subcategory) {
                        return [
                            'id' => $subcategory->id,
                            'name' => $subcategory->name,
                        ];
                    })->values(),
                ],
            ];
        });
    @endphp
    <script>
        const subcategoriesByCategory = @json($subcategoriesByCategory);
        const categoryFilter = document.getElementById('categoryFilter');
        const subcategoryFilter = document.getElementById('subcategoryFilter');

        if (categoryFilter) {
            categoryFilter.addEventListener('change', function () {
                if (!subcategoryFilter) return;

                const selected = subcategoriesByCategory[this.value];
                subcategoryFilter.innerHTML = '';
                subcategoryFilter.disabled = !selected;

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = selected ? 'All ' + selected.name + ' Subcategories' : 'Select category first';
                subcategoryFilter.appendChild(defaultOption);

                if (selected) {
                    selected.subcategories.forEach(function (subcategory) {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategoryFilter.appendChild(option);
                    });
                }
            });
        }

        /* ---- Price range slider: live min / max display ---- */
        (function () {
            const slider = document.getElementById('priceSlider');
            if (!slider) return;

            const minInput = document.getElementById('minPrize');
            const maxInput = document.getElementById('maxPrize');
            const fill = document.getElementById('priceSliderFill');
            const output = document.getElementById('priceRangeValue');

            const THUMB = 20; // keep in sync with the thumb size in style.css
            const floor = Number(minInput.min);
            const ceil = Number(minInput.max);

            const inr = value => '\u20B9' + Number(value).toLocaleString('en-IN');
            const percent = value => ((value - floor) / (ceil - floor)) * 100;
            // Native thumbs stay inside the track, so shift the fill to match their centres.
            const nudge = pct => (THUMB / 2) - (pct / 100 * THUMB);

            function render() {
                const lo = Number(minInput.value);
                const hi = Number(maxInput.value);
                const pLo = percent(lo);
                const pHi = percent(hi);

                fill.style.left = 'calc(' + pLo + '% + ' + nudge(pLo) + 'px)';
                fill.style.width = 'calc(' + (pHi - pLo) + '% + ' + (nudge(pHi) - nudge(pLo)) + 'px)';
                output.textContent = inr(lo) + ' \u2013 ' + inr(hi);

                // Lift the min handle above the max one once it reaches the right half,
                // otherwise an overlapped handle can no longer be grabbed.
                minInput.style.zIndex = pLo > 50 ? 5 : 3;
            }

            minInput.addEventListener('input', function () {
                if (Number(minInput.value) > Number(maxInput.value)) {
                    minInput.value = maxInput.value;
                }
                render();
            });

            maxInput.addEventListener('input', function () {
                if (Number(maxInput.value) < Number(minInput.value)) {
                    maxInput.value = minInput.value;
                }
                render();
            });

            render();
        })();
    </script>
@endpush
