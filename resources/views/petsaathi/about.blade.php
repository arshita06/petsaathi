@extends('layouts.root')

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1 class="section-title">About PetSaathi</h1>
            <p class="text-muted">A modern pet-commerce experience made with care.</p>
        </div>
    </section>
    <section class="container my-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 reveal"><img src="../assets/images/cute-pets.svg" class="img-fluid"></div>
            <div class="col-lg-6 reveal">
                <h2 class="section-title">We make pet parenting easier and happier.</h2>
                <p class="text-muted">PetSaathi brings premium food, toys, grooming, healthcare and accessories into
                    one clean shopping journey.</p><button class="btn btn-main">Know More</button>
            </div>
        </div>
    </section>
@endsection
