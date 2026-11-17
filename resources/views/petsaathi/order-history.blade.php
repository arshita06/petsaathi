@extends('layouts.root')

@section('title', 'Order History | PetSaathi')

@section('content')
<main class="order-history-page">
    <section class="order-history-hero">
        <div class="container">
            <div class="history-hero-inner">
                <div>
                    <p class="success-eyebrow">My Orders</p>
                    <h1 class="section-title">Order History</h1>
                    <p class="history-hero-copy">Track every PetSaathi order, payment method, shipping charge and delivery progress in one place.</p>
                </div>
                <a href="{{ route('shop') }}" class="btn btn-main">Shop Again</a>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <div class="history-stats">
            <div>
                <span>Total Orders</span>
                <strong>{{ $totalOrders }}</strong>
            </div>
            <div>
                <span>Active Orders</span>
                <strong>{{ $activeOrders }}</strong>
            </div>
            <div>
                <span>Total Spent</span>
                <strong>&#8377;{{ number_format($totalSpent) }}</strong>
            </div>
        </div>

        @if ($orders->isEmpty())
            <div class="history-empty glass-card reveal">
                <div class="history-empty-mark">PS</div>
                <h3>No orders yet</h3>
                <p>Your order history will appear here after you place your first Cash on Delivery order.</p>
                <a href="{{ route('shop') }}" class="btn btn-main">Start Shopping</a>
            </div>
        @else
            <div class="history-list">
                @foreach ($orders as $order)
                    @php
                        $shipping = (float) ($order->total_shipping_charge ?? 0);
                        $itemsCount = $order->orderItem->sum('quantity');
                        $status = strtolower($order->shipping_status ?: $order->status ?: 'pending');
                        $status = $status === '0' ? 'pending' : $status;
                        $statusClass = str_replace(' ', '-', $status);
                        $date = $order->place_time
                            ? \Carbon\Carbon::parse($order->place_time)->format('d M Y')
                            : $order->created_at?->format('d M Y');
                        $firstItems = $order->orderItem->take(3);
                    @endphp

                    <article class="history-order-card reveal">
                        <div class="history-order-top">
                            <div>
                                <span class="history-order-label">Order</span>
                                <h3>#PS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                                <p>{{ $date }} &middot; {{ $itemsCount }} {{ Str::plural('item', $itemsCount) }}</p>
                            </div>
                            <span class="history-status status-{{ $statusClass }}">{{ ucfirst($status) }}</span>
                        </div>

                        <div class="history-products">
                            @foreach ($firstItems as $item)
                                @php $product = $item->product; @endphp
                                <div class="history-product-chip">
                                    <div class="history-product-thumb">
                                        @if ($product?->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <span>PS</span>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $product?->name ?? 'Product unavailable' }}</strong>
                                        <span>{{ $product?->subcategory?->name ?? 'Pet Care' }} x {{ $item->quantity }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="history-money-grid">
                            <div>
                                <span>Payment</span>
                                <strong>{{ $order->payment_method }}</strong>
                            </div>
                            <div>
                                <span>Shipping Charges</span>
                                <strong>{!! $shipping > 0 ? '&#8377;'.number_format($shipping) : 'FREE' !!}</strong>
                            </div>
                            <div>
                                <span>Total</span>
                                <strong>&#8377;{{ number_format($order->total_amount) }}</strong>
                            </div>
                        </div>

                        <div class="history-order-actions">
                            <p>{{ $order->shipping_city }}, {{ $order->shipping_state }}</p>
                            <a href="{{ route('order.success', $order) }}" class="btn btn-soft">View Order Details</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
</main>
@endsection
