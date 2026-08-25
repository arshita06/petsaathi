@extends('layouts.root')

@section('title', 'Order History | PetSaathi')

@section('content')
    <main>
        <section class="page-hero">
            <div class="container">
                <h1 class="section-title">Order History</h1>
            </div>
        </section>
        <section class="container my-5">
            <div class="glass-card p-4 reveal">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PS1024</td>
                            <td>02 Jun 2026</td>
                            <td><span class="tag">Delivered</span></td>
                            <td>₹1,247</td>
                        </tr>
                        <tr>
                            <td>#PS1025</td>
                            <td>05 Jun 2026</td>
                            <td><span class="tag">Processing</span></td>
                            <td>₹899</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
