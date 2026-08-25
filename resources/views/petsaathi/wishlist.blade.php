@extends('layouts.root')

@section('title', 'Wishlist | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">My Wishlist</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4" data-products="4"></div>
        </section>
    </main>
@endsection
