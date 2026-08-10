@php
    $orderNo = 'PS-01042';
    $customerName = 'Aarav Mehta';
    $customerEmail = 'aarav.mehta@example.com';
    $customerMobile = '+91 98765 43210';
    $paymentMethod = 'UPI';
    $paymentStatus = 'Paid';
    $shippingStatus = 'Ready to Ship';
    $shippingCharge = 80;
    $totalAmount = 1850;
    $orderDate = '10 Aug 2026, 11:45 AM';
    $utrNo = 'UPI48291045';
    $address = 'B-204, Green Valley Residency, Near City Mall';
    $cityLine = 'Ahmedabad, Gujarat, India, 380015';

    $items = [
        ['name' => 'Premium Puppy Food', 'variant' => 'Chicken and Rice, 3 kg', 'qty' => 2, 'price' => 650, 'total' => 1300],
        ['name' => 'Soft Chew Toy', 'variant' => 'Medium size, mint blue', 'qty' => 1, 'price' => 470, 'total' => 470],
    ];
    $subtotal = collect($items)->sum('total');
    $discount = 0;
    $grandTotal = $totalAmount ?: ($subtotal + $shippingCharge - $discount);
@endphp

<x-admin-layout title="Order Details">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">Order Details</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-950">{{ $orderNo }}</h2>
            <p class="mt-1 text-sm text-slate-500">Placed on {{ $orderDate }}</p>
        </div>

        <a href="{{ route('admin.order.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
            Back to Orders
        </a>
    </div>

    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="mb-5 flex flex-col gap-3 border-b border-slate-200 pb-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-base font-semibold text-slate-950">Order Overview</h3>
                <p class="mt-1 text-sm text-slate-500">Quick summary of customer, payment and order value.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                    Payment: {{ $paymentStatus }}
                </span>
                <span class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                    Shipping: {{ $shippingStatus }}
                </span>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-blue-100 text-blue-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-bold uppercase text-slate-500">Customer</p>
                        <p class="mt-1 truncate text-base font-bold text-slate-950">{{ $customerName }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-emerald-100 text-emerald-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2" />
                            <path d="M2 10h20" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-bold uppercase text-slate-500">Payment Method</p>
                        <p class="mt-1 truncate text-base font-bold text-slate-950">{{ $paymentMethod }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-amber-100 text-amber-700">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 1v22" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <p class="text-xs font-bold uppercase text-slate-500">Order Total</p>
                        <p class="mt-1 truncate text-xl font-black text-slate-950">Rs. {{ number_format($grandTotal, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg border border-slate-200 bg-white p-4">
                <p class="text-xs font-bold uppercase text-slate-500">UTR No.</p>
                <p class="mt-2 break-words text-sm font-semibold text-slate-950">{{ $utrNo }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-4">
                <p class="text-xs font-bold uppercase text-slate-500">Items</p>
                <p class="mt-2 text-sm font-semibold text-slate-950">{{ count($items) }} Products</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-4">
                <p class="text-xs font-bold uppercase text-slate-500">Shipping Charge</p>
                <p class="mt-2 text-sm font-semibold text-slate-950">Rs. {{ number_format($shippingCharge, 2) }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-4">
                <p class="text-xs font-bold uppercase text-slate-500">Priority</p>
                <p class="mt-2 text-sm font-semibold text-slate-950">Standard</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.6fr_0.9fr]">
        <div class="space-y-6">
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h3 class="text-base font-semibold text-slate-950">Ordered Products</h3>
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">Invoice Ready</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Product</th>
                                <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase text-slate-500">Price</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase text-slate-500">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach ($items as $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="grid h-12 w-12 shrink-0 place-items-center rounded-lg bg-blue-50 text-blue-700">
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                                    <path d="M3 6h18" />
                                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-950">{{ $item['name'] }}</p>
                                                <p class="mt-1 text-sm text-slate-500">{{ $item['variant'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-slate-700">{{ $item['qty'] }}</td>
                                    <td class="px-6 py-4 text-right text-sm text-slate-600">Rs. {{ number_format($item['price'], 2) }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-bold text-slate-950">Rs. {{ number_format($item['total'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-slate-950">Customer Contact</h3>
                    <div class="mt-5 space-y-4">
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-500">Email</p>
                            <p class="mt-1 break-words text-sm font-semibold text-slate-900">{{ $customerEmail }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-500">Mobile</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $customerMobile }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-base font-semibold text-slate-950">Shipping Address</h3>
                    <p class="mt-5 text-sm font-semibold leading-6 text-slate-900">{{ $address }}</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $cityLine }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-950">Payment Summary</h3>

                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between gap-4 text-slate-600">
                        <span>Subtotal</span>
                        <span class="font-semibold text-slate-900">Rs. {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between gap-4 text-slate-600">
                        <span>Shipping Charge</span>
                        <span class="font-semibold text-slate-900">Rs. {{ number_format($shippingCharge, 2) }}</span>
                    </div>
                    <div class="flex justify-between gap-4 text-slate-600">
                        <span>Discount</span>
                        <span class="font-semibold text-emerald-600">- Rs. {{ number_format($discount, 2) }}</span>
                    </div>
                    <div class="border-t border-slate-200 pt-4">
                        <div class="flex justify-between gap-4">
                            <span class="text-base font-bold text-slate-950">Grand Total</span>
                            <span class="text-xl font-black text-slate-950">Rs. {{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-950">Order Timeline</h3>

                <div class="mt-5 space-y-5">
                    <div class="flex gap-3">
                        <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-emerald-500 ring-4 ring-emerald-100"></span>
                        <div>
                            <p class="text-sm font-bold text-slate-950">Order confirmed</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $orderDate }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-blue-500 ring-4 ring-blue-100"></span>
                        <div>
                            <p class="text-sm font-bold text-slate-950">{{ $shippingStatus }}</p>
                            <p class="mt-1 text-xs text-slate-500">Packing slip generated</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-slate-300 ring-4 ring-slate-100"></span>
                        <div>
                            <p class="text-sm font-bold text-slate-500">Out for delivery</p>
                            <p class="mt-1 text-xs text-slate-400">Pending courier pickup</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 shadow-sm">
                <p class="text-sm font-bold text-amber-900">Shipping Remark</p>
                <p class="mt-2 text-sm leading-6 text-amber-800">Please call before delivery and handle pet food packet carefully.</p>
            </div>
        </div>
    </div>
</x-admin-layout>
