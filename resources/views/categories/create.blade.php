<x-admin-layout title="Create Category">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Create Category</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Add a new category.</p>
        </div>

        <a href="{{ route('admin.category.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Categories
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Category Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.category.store') }}" class="p-6">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Category Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: Dogs" required>
                @error('name')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))
                        class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                    Active
                </label>
                @error('is_active')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.category.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
