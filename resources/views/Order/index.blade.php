<x-admin-layout title="Products">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950">Orders</h2>
            <p class="mt-1 text-sm text-slate-500">Manage Orders.</p>
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
        <div class="border-b border-slate-200 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950">Order List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Sr. No.</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">User</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Payment</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Total Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Total Shipping Charge</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Shipping Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Utr No. </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping Name </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping Email </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping Mobile </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping Address </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping Country </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping State </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping City </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500"> Shipping ZipCode </th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($products as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $item->subcategory?->name ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $item->subcategory?->category?->name ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $item->price }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $item->stock }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                @if ($item->status)
                                    <span class="inline-flex rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-bold text-emerald-700">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-2 py-0.5 text-xs font-bold text-slate-500">Inactive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.product.edit', $item) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700 hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.product.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center rounded-lg border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700 hover:bg-rose-100">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-sm text-slate-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
