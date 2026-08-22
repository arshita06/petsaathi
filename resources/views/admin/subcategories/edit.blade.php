<x-admin-layout title="Edit Subcategory">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Edit Subcategory</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update the subcategory details.</p>
        </div>

        <a href="{{ route('admin.subcategory.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Subcategories
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Subcategory Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.subcategory.update', $subcategory) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')

            <div>
                <label for="category_id" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Category</label>
                <select id="category_id" name="category_id"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $subcategory->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Subcategory Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $subcategory->name) }}"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: Puppies" required>
                @error('name')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="image" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Image</label>

                @if ($subcategory->image)
                    <div class="mb-3">
                        <img src="{{ asset($subcategory->image) }}" alt="{{ $subcategory->name }}"
                            class="h-20 w-20 rounded-lg object-cover">
                    </div>
                @endif

                <input id="image" type="file" name="image" accept="image/*"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-sm text-slate-900 dark:text-slate-100 shadow-sm file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Leave empty to keep the current image.</p>
                @error('image')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $subcategory->is_active))
                        class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                    Active
                </label>
                @error('is_active')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.subcategory.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Update Subcategory
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
