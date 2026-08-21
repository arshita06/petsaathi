<x-admin-layout title="Orders">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950">Orders</h2>
            <p class="mt-1 text-sm text-slate-500">Track order status, payment and shipping progress.</p>
        </div>

        {{-- <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            Create Products
        </a> --}}
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-1 border-b border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <h3 class="text-base font-semibold text-slate-950">Order List</h3>
            <span class="text-sm font-medium text-slate-500">{{ $orders->count() }} total orders</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Payment</th>
                        <th class="px-6 py-3 text-right text-xs font-bold uppercase text-slate-500">Amount</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Shipping</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <p class="text-sm font-bold text-slate-950">#PS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $order->place_time ? \Carbon\Carbon::parse($order->place_time)->format('d M Y') : $order->created_at?->format('d M Y') }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="whitespace-nowrap text-sm font-semibold text-slate-950">{{ $order->user->name ?? $order->shipping_name ?? 'N/A' }}</p>
                                <p class="mt-1 whitespace-nowrap text-xs text-slate-500">{{ $order->shipping_mobile ?? 'No mobile' }}</p>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-600">{{ $order->payment_method }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-slate-950">Rs. {{ number_format($order->total_amount ?? 0, 2) }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                                    {{ $order->shipping_status }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.order.show', $order) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700 hover:bg-blue-100">
                                        View Order
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-500">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
