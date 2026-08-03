<x-admin-layout title="View Wishlist">
    {{-- Breadcrumb --}}
    <nav class="mb-4 flex items-center gap-2 text-sm font-medium text-slate-500">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-900">Dashboard</a>
        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m9 18 6-6-6-6" />
        </svg>
        <a href="{{ route('admin.wishlist.index') }}" class="hover:text-slate-900">Wishlist</a>
        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m9 18 6-6-6-6" />
        </svg>
        <span class="text-slate-900">View</span>
    </nav>

    {{-- Hero header --}}
    <div class="relative mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-r from-blue-600 via-blue-600 to-indigo-600 p-6 shadow-sm sm:p-8">
        <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
        <div class="pointer-events-none absolute -bottom-16 right-24 h-48 w-48 rounded-full bg-white/5"></div>

        <div class="relative flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
            <div class="flex items-center gap-4">
                <div class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-white/15 text-white ring-1 ring-white/30 backdrop-blur">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                    </svg>
                </div>
                <div>
                    <span class="inline-flex items-center rounded-full bg-white/15 px-2.5 py-0.5 text-[11px] font-bold uppercase tracking-wide text-white ring-1 ring-white/25">Wishlist Entry</span>
                    <h2 class="mt-1.5 text-2xl font-bold text-white">View Wishlist</h2>
                    <p class="mt-1 text-sm text-blue-100">Customer and product details for this wishlist entry.</p>
                </div>
            </div>

            <a href="{{ route('admin.wishlist.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-white/95 px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-sm ring-1 ring-white/40 hover:bg-white">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Back to Wishlist
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
        {{-- Card 1: Customer Details --}}
        <div class="lg:col-span-2">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-2 border-b border-slate-200 px-6 py-4">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-blue-50 text-blue-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </span>
                    <h3 class="text-base font-semibold text-slate-950">Customer Details</h3>
                </div>

                <div class="p-6">
                    {{-- Customer identity --}}
                    @foreach($users as $user)
                        <div class="mb-6 flex items-center gap-4 rounded-xl bg-slate-50 p-4">
                            <div class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-lg font-bold text-white shadow-sm">
                                JD
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-base font-bold text-slate-900">{{ $user->name }}</p>
                                <p class="truncate text-sm text-slate-500">{{ $user->email }}</p>
                            </div>
                            <span class="ml-auto inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                {{ $user->is_active }}
                            </span>
                        </div>

                        <dl class="space-y-4">
                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-slate-100 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z" />
                                    </svg>
                                </span>
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">Phone Number</dt>
                                    <dd class="mt-0.5 text-sm font-medium text-slate-800">{{ $user->phone }}</dd>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="mt-0.5 grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-slate-100 text-slate-500">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </span>
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">Location</dt>
                                    <dd class="mt-0.5 text-sm font-medium text-slate-800">{{ $user->address }}</dd>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-4">
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">City</dt>
                                    <dd class="mt-1 text-sm font-medium text-slate-800">{{ $user->city->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">State</dt>
                                    <dd class="mt-1 text-sm font-medium text-slate-800">{{ $user->state->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">Country</dt>
                                    <dd class="mt-1 text-sm font-medium text-slate-800">{{ $user->country->name}}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-bold uppercase text-slate-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700">Active</span>
                                    </dd>
                                </div>
                            </div>
                        </dl>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Card 2: Product Details --}}
        <div class="lg:col-span-3">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center gap-2 border-b border-slate-200 px-6 py-4">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-indigo-50 text-indigo-600">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                            <path d="M3 6h18" />
                            <path d="M16 10a4 4 0 0 1-8 0" />
                        </svg>
                    </span>
                    <h3 class="text-base font-semibold text-slate-950">Product Details</h3>
                    <span class="ml-auto inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        In Stock
                    </span>
                </div>

                <div class="p-6">
                    <div class="flex flex-col gap-6 sm:flex-row">
                        {{-- Product Image --}}
                        <div class="shrink-0">
                            <div class="relative">
                                <img src="https://placehold.co/220x220?text=Product"
                                    alt="Product image"
                                    class="h-48 w-48 rounded-xl border border-slate-200 object-cover shadow-sm">
                                <span class="absolute left-2 top-2 inline-flex items-center rounded-full bg-blue-600 px-2.5 py-0.5 text-[11px] font-bold text-white shadow">Pet Food</span>
                            </div>
                        </div>

                        {{-- Product Info --}}
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-slate-900">Premium Dog Food</h4>
                            <p class="mt-0.5 text-sm text-slate-500">by <span class="font-semibold text-slate-700">PetSaathi</span></p>

                            <div class="mt-3 flex items-baseline gap-2">
                                <span class="text-2xl font-bold text-slate-900">₹1,299.00</span>
                                <span class="text-sm font-medium text-slate-400 line-through">₹1,599.00</span>
                            </div>

                            <div class="mt-5 grid grid-cols-2 gap-x-6 gap-y-4">
                                <div class="rounded-lg border border-slate-100 bg-slate-50 px-3 py-2">
                                    <dt class="text-xs font-bold uppercase text-slate-500">Category</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-slate-900">Pet Food</dd>
                                </div>
                                <div class="rounded-lg border border-slate-100 bg-slate-50 px-3 py-2">
                                    <dt class="text-xs font-bold uppercase text-slate-500">Added to Wishlist</dt>
                                    <dd class="mt-0.5 text-sm font-semibold text-slate-900">24 Jul 2026</dd>
                                </div>
                                <div class="rounded-lg border border-slate-100 bg-slate-50 px-3 py-2">
                                    <dt class="text-xs font-bold uppercase text-slate-500">Product Status</dt>
                                    <dd class="mt-0.5">
                                        <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-bold text-emerald-700">Active</span>
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Product Description --}}
                    <div class="mt-6 border-t border-slate-200 pt-6">
                        <dt class="text-xs font-bold uppercase text-slate-500">Description</dt>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nutrient-rich, balanced
                            formula crafted for daily health and vitality. Made with premium ingredients to
                            support a healthy coat, strong bones, and improved digestion for pets of all ages.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Actions --}}
    {{-- <div class="mt-6 flex justify-end">
        <a href="{{ route('admin.wishlist.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            Back
        </a>
    </div> --}}
</x-admin-layout>
