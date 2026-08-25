@extends('layouts.root')

@section('title', 'FAQ | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Frequently Asked Questions</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="accordion reveal" id="faq">
                <div class="accordion-item">
                    <h2><button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#q1">Do you offer same-day
                            delivery?</button></h2>
                    <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                        <div class="accordion-body">Yes, selected cities support same-day delivery.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#q2">Are
                            products genuine?</button></h2>
                    <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faq">
                        <div class="accordion-body">Yes, all items are sourced from trusted brands.</div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
