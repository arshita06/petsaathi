@extends('layouts.root')

@section('title', 'Categories | PetSaathi')

@section('content')
    <main class="categories-page">
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Shop by Category</h1>
                <p class="text-muted">Choose a category to explore its subcategories.</p>
            </div>
        </section>

        <section class="container my-5">
            <div class="category-grid">
                @forelse($categories as $category)
                    @php
                        $fallbackImage = $category->subcategories->first(fn ($subcategory) => filled($subcategory->image))?->image;
                        $categoryImage = $category->image ?: $fallbackImage;
                        $isSelected = $selectedCategory && $selectedCategory->id === $category->id;
                    @endphp
                    <a href="{{ route('categories', ['category' => $category->id]) }}#subcategories"
                        class="category-showcase-card reveal {{ $isSelected ? 'active' : '' }}">
                        <div class="category-showcase-image">
                            @if($categoryImage)
                                <img src="{{ asset($categoryImage) }}" alt="{{ $category->name }}">
                            @else
                                <span>{{ strtoupper(substr($category->name, 0, 2)) }}</span>
                            @endif
                        </div>
                        <div class="category-showcase-body">
                            <span>{{ $category->subcategories->count() }} {{ Str::plural('subcategory', $category->subcategories->count()) }}</span>
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $category->description ?: 'Browse food, toys, care and comfort essentials.' }}</p>
                        </div>
                    </a>
                @empty
                    <div class="glass-card p-5 text-center reveal">
                        <h4>No categories found</h4>
                        <p class="text-muted mb-0">Active categories will appear here.</p>
                    </div>
                @endforelse
            </div>
        </section>

        @if($selectedCategory)
            <section class="container mb-5" id="subcategories">
                <div class="subcategory-panel reveal">
                    <div class="subcategory-panel-head">
                        <div>
                            <span>Selected Category</span>
                            <h2>{{ $selectedCategory->name }} Subcategories</h2>
                        </div>
                        <a href="{{ route('shop', ['category_id' => $selectedCategory->id]) }}" class="btn btn-soft">View All Products</a>
                    </div>

                    <div class="subcategory-grid">
                        @forelse($selectedCategory->subcategories as $subcategory)
                            <a href="{{ route('shop', ['category_id' => $selectedCategory->id, 'subcategory_id' => $subcategory->id]) }}"
                                class="subcategory-card">
                                <div class="subcategory-image">
                                    @if($subcategory->image)
                                        <img src="{{ asset($subcategory->image) }}" alt="{{ $subcategory->name }}">
                                    @else
                                        <span>{{ strtoupper(substr($subcategory->name, 0, 2)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h3>{{ $subcategory->name }}</h3>
                                    <p>{{ $subcategory->products_count }} {{ Str::plural('product', $subcategory->products_count) }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="subcategory-empty">
                                <h3>No subcategories yet</h3>
                                <p class="text-muted mb-0">Add active subcategories from admin to show them here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
