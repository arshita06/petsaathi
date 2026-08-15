<x-admin-layout title="Create Product">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950">Create Product</h2>
            <p class="mt-1 text-sm text-slate-500">Add a new Product.</p>
        </div>

        <a href="{{ route('admin.product.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
            Back to Product
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4 col-6">
            <h3 class="text-base font-semibold text-slate-950">Product Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.product.store') }}" class="p-6">
            @csrf
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Product Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: Pedigree Adult Dog Food" required>
                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category_id" class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
                    <select id="category_id" name="category_id"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" @selected(old('category_id') == $id)>{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="subcategory_id"
                        class="mb-2 block text-sm font-semibold text-slate-700">Subcategory</label>
                    {{-- @dd($products) --}}
                    <select id="subcategory_id" name="subcategory_id"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                        <option value="">-- Select Subcategory --</option>
                        @foreach ($subcategories as $id => $name)
                            <option value="{{ $id }}" @selected(old('subcategory_id') == $id)>{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="mb-2 block text-sm font-semibold text-slate-700">Image</label>
                    <input id="image" type="file" name="image" accept="image/*"
                        class="block w-full rounded-lg border border-slate-300 text-sm text-slate-900 shadow-sm file:mr-4 file:border-0 file:bg-slate-100 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @error('image')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Price</label>
                    <input id="price" type="text" name="price" value="{{ old('price') }}"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: 230" required>
                    @error('price')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="mb-2 block text-sm font-semibold text-slate-700">Stock</label>
                    <input id="stock" type="text" name="stock" value="{{ old('stock') }}"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: 20" required>
                    @error('stock')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: Complete and balanced nutrition for adult dogs.">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))
                            class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        Active
                    </label>
                    @error('is_active')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 pt-6">
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Create Product
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
