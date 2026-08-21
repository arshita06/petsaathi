<x-admin-layout title="Edit Category">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950">Edit Category</h2>
            <p class="mt-1 text-sm text-slate-500">Update the category details.</p>
        </div>

        <a href="{{ route('admin.category.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Categories
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950">Category Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.category.update', $category) }}" class="p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Category Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}"
                    class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: Dogs" required>
                @error('name')
                    <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active))
                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    Active
                </label>
                @error('is_active')
                    <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 pt-6">
                <a href="{{ route('admin.category.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
