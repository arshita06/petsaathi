<x-admin-layout title="Products">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Products</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage Products.</p>
        </div>

        <a href="{{ route('admin.product.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            Create Products
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Product List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Sr. No.</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Product Name</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Subcategory</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Description</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Is Active</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900">
                    {{-- @dd($products) --}}
                    @forelse ($products as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950 dark:text-slate-50">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $item->subcategory?->name ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $item->subcategory?->category?->name ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $item->price }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $item->stock }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                @if (filled($item->description))
                                    @if (Str::length($item->description) > 60)
                                        <div x-data="{ expanded: false }" class="w-64 max-w-xs">
                                            <p x-show="! expanded">{{ Str::limit($item->description, 60) }}</p>
                                            <p x-show="expanded" style="display: none;" class="whitespace-pre-line">{{ $item->description }}</p>

                                            <button type="button" @click="expanded = ! expanded"
                                                class="mt-1 text-xs font-bold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                                                <span x-show="! expanded">Read more</span>
                                                <span x-show="expanded" style="display: none;">Show less</span>
                                            </button>
                                        </div>
                                    @else
                                        <p class="w-64 max-w-xs">{{ $item->description }}</p>
                                    @endif
                                @else
                                    <span class="text-slate-400 dark:text-slate-500">N/A</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                @if ($item->status)
                                    <span class="inline-flex rounded-full bg-emerald-100 dark:bg-emerald-900 px-2 py-0.5 text-xs font-bold text-emerald-700 dark:text-emerald-300">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 dark:bg-slate-800 px-2 py-0.5 text-xs font-bold text-slate-500 dark:text-slate-400">Inactive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.product.edit', $item) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-950 px-3 py-1.5 text-xs font-bold text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.product.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                            <td colspan="9" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
