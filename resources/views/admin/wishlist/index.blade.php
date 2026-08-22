<x-admin-layout title="Products">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Wishlist</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage Wishlist.</p>
        </div>

        {{-- <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            Create Wishlist
        </a> --}}
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Wishlist List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Sr. No.</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Product</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900">
                    @forelse ($wishlists as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950 dark:text-slate-50">{{ $item->user?->name ?? 'N/A'}}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $item->product?->name ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.wishlist.show', $item) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-950 px-3 py-1.5 text-xs font-bold text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900">
                                        View
                                    </a>

                                    <form method="POST" action="{{ route('admin.wishlist.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this Wishlist?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center rounded-lg border border-rose-200 dark:border-rose-800 bg-rose-50 dark:bg-rose-950 px-3 py-1.5 text-xs font-bold text-rose-700 dark:text-rose-300 hover:bg-rose-100 dark:hover:bg-rose-900">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                No Wishlist found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
