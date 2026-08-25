@extends('layouts.root')

@section('title', 'Profile | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">User Profile</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="glass-card p-4 reveal">
                <div class="d-flex align-items-center gap-3">
                    <div class="soft-icon">👤</div>
                    <div>
                        <h4>Mukul Kohli</h4>
                        <p class="text-muted mb-0">Premium Pet Parent</p>
                    </div>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6"><input class="form-control" value="Mukul Kohli"></div>
                    <div class="col-md-6"><input class="form-control" value="mukul@example.com"></div>
                    <div class="col-12"><input class="form-control" value="India"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
