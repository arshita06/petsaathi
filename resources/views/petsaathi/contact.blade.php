@extends('layouts.root')

@section('title', 'Contact | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Contact Us</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="glass-card p-4 reveal"><input class="form-control mb-3" placeholder="Name"><input
                            class="form-control mb-3" placeholder="Email">
                        <textarea class="form-control mb-3" rows="5" placeholder="Message"></textarea><button class="btn btn-main">Send Message</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="glass-card p-4 h-100 reveal">
                        <h4>We’d love to help</h4>
                        <p>📍 Delhi, India</p>
                        <p>📞 +91 98765 43210</p>
                        <p>✉️ support@petsaathi.com</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
