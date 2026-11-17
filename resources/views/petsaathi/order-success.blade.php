@extends('layouts.root')

@section('title', 'Order Confirmed | PetSaathi')

@section('content')
@php
    $shipping = (float) ($order->total_shipping_charge ?? 0);
    $subtotal = max((float) $order->total_amount - $shipping, 0);
    $address = collect([
        $order->shipping_address,
        $order->shipping_city,
        $order->shipping_state,
        $order->shipping_zip_code,
        $order->shipping_country,
    ])->filter()->join(', ');
@endphp

<main class="order-confirmed-page">
<section class="order-confirmed-hero">
  <div class="success-spark spark-one"></div>
  <div class="success-spark spark-two"></div>
  <div class="success-spark spark-three"></div>

  <div class="container">
    <div class="success-panel reveal" id="orderResultBox">
      <div class="success-mark" aria-hidden="true"></div>

      <p class="success-eyebrow">Order placed successfully</p>
      <h1>Order #PS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
      <p class="success-copy">Your Cash on Delivery order is confirmed. We are preparing it now and will keep you updated as it moves toward dispatch.</p>

      <div class="success-stats">
        <div>
          <span>Order Total</span>
          <strong>&#8377;{{ number_format($order->total_amount) }}</strong>
        </div>
        <div>
          <span>Shipping Charges</span>
          <strong>{!! $shipping > 0 ? '&#8377;'.number_format($shipping) : 'FREE' !!}</strong>
        </div>
        <div>
          <span>Payment</span>
          <strong>{{ $order->payment_method }}</strong>
        </div>
      </div>

      <div class="success-detail-grid">
        <div class="success-detail-card">
          <span>Customer</span>
          <strong>{{ $order->shipping_name }}</strong>
          <p>{{ $order->shipping_mobile }}<br>{{ $order->shipping_email }}</p>
        </div>
        <div class="success-detail-card">
          <span>Delivery Address</span>
          <strong>{{ $order->shipping_city }}, {{ $order->shipping_state }}</strong>
          <p>{{ $address }}</p>
        </div>
      </div>

      <div class="success-timeline" aria-label="Order progress">
        <div class="active"><span></span><strong>Confirmed</strong></div>
        <div><span></span><strong>Packing</strong></div>
        <div><span></span><strong>Dispatch</strong></div>
        <div><span></span><strong>Delivery</strong></div>
      </div>

      <div class="success-total-strip">
        <span>Products: &#8377;{{ number_format($subtotal) }}</span>
        <span>Shipping: {!! $shipping > 0 ? '&#8377;'.number_format($shipping) : 'FREE' !!}</span>
        <span>Pay on delivery: &#8377;{{ number_format($order->total_amount) }}</span>
      </div>

      <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
        <a href="{{ route('shop') }}" class="btn btn-main">Continue Shopping</a>
        <a href="{{ route('order.history') }}" class="btn btn-soft">View Order History</a>
      </div>
    </div>
  </div>
</section>
</main>
@endsection
