<div class="topbar py-2">
    <div class="container d-flex justify-content-between">
    <div>🐾 Free shipping on orders above ₹999 &nbsp; | &nbsp; 30 days easy returns</div>
    <div>Track Order &nbsp; | &nbsp; Help & Support</div>
    </div>
</div>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}"><img
        src="{{ asset('assets/images/logo-paw.svg') }}" width="42"><span>Pet<span
            class="brand-grad">Saathi</span></span></a><button class="navbar-toggler" data-bs-toggle="collapse"
        data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto gap-lg-3">
        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li><a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a></li>
        <li><a class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}" href="{{ route('categories') }}">Categories</a></li>
        <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
        <li><a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a></li>
        <li><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div class="d-flex gap-3 align-items-center">
        <div class="search-pill d-none d-xl-flex">🔍 <input class="border-0 ms-2 w-100"
            placeholder="Search for products..."></div><a class="icon-btn" href="{{ auth()->check() ? route('profile.edit') : route('login') }}">👤</a><a
            class="icon-btn" href="{{ route('wishlist') }}">♡<span class="badge-dot">3</span></a><a
            class="icon-btn" href="{{ route('cart') }}">🛒<span class="badge-dot"
            id="nav-cart-badge">2</span></a>
        </div>
    </div>
    </div>
</nav>
