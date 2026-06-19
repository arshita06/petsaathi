<x-admin-layout title="Subcategories">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950">Subcategories</h2>
            <p class="mt-1 text-sm text-slate-500">Manage subcategories.</p>
        </div>

        <a href="{{ route('admin.subcategory.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            Create Subcategory
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950">Subcategory List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Sr. No.</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-500">Subcategory Name</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Is Active</th>
                        <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($subcategory as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                        class="h-10 w-10 rounded-lg object-cover">
                                @else
                                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-slate-100 text-xs font-bold text-slate-400">N/A</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-950">{{ $item->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                @if ($item->is_active)
                                    <span class="inline-flex rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-bold text-emerald-700">Active</span>
                                @else
                                    <span class="inline-flex rounded-full bg-slate-100 px-2 py-0.5 text-xs font-bold text-slate-500">Inactive</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.subcategory.edit', $item) }}"
                                        class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700 hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.subcategory.destroy', $item) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">
                                No subcategories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
