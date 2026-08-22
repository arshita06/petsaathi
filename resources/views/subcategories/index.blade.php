<x-admin-layout title="Subcategories">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Subcategories</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage subcategories.</p>
        </div>

        <a href="{{ route('admin.subcategory.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            Create Subcategory
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Subcategory List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-800">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Sr. No.</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Image</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Subcategory Name</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Category Name</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Is Active</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500 dark:text-slate-400">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900">
                    @forelse ($subcategory as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-400 text-center">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                                        class="h-10 w-10 rounded-lg object-cover mx-auto">
                                @else
                                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-400 dark:text-slate-500">N/A</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950 dark:text-slate-50 text-center">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950 dark:text-slate-50 text-center">{{ $item->category->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                @if ($item->is_active)
                                    <span class="inline-flex rounded-full bg-emerald-100 dark:bg-emerald-900 px-2 py-0.5 text-xs font-bold text-emerald-700 dark:text-emerald-300">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 dark:bg-slate-800 px-2 py-0.5 text-xs font-bold text-slate-500 dark:text-slate-400">Inactive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.subcategory.edit', $item) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-950 px-3 py-1.5 text-xs font-bold text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.subcategory.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                No subcategories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
