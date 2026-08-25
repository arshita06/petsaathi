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
                    <div class="glass-card p-4 sticky-top" style="top:100px">
                        <h5>Filters</h5><input class="form-control mb-3" placeholder="Search product"><select
                            class="form-select mb-3">
                            <option>All Categories</option>
                            <option>Food</option>
                            <option>Toys</option>
                            <option>Healthcare</option>
                        </select><label>Price Range</label><input type="range" class="form-range"><button
                            class="btn btn-main w-100">Apply Filter</button>
                    </div>
                </aside>
                <div class="col-lg-9">
                    <div class="row g-4" data-products="8"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
