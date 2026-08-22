<x-admin-layout title="Edit Product">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Edit Product</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update the product details.</p>
        </div>

        <a href="{{ route('admin.product.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Products
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Product Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.product.update', $product) }}" enctype="multipart/form-data"
            class="p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Product Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: Puppies" required>
                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category_id" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Category</label>
                    <select id="category_id" name="category_id"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                        <option value="">-- Select Category --</option>
                        {{-- @dd($categories) --}}
                        @foreach ($categories as $id => $name)
                            {{-- @dd($category) --}}
                            <option value="{{ $id }}" @selected(old('product->subcategory->category_id', $product->subcategory->category_id) == $id)>{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="subcategory_id"
                        class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Subcategory</label>
                    <select id="subcategory_id" name="subcategory_id"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                        <option value="">-- Select Subcategory --</option>
                        @foreach ($subcategories as $id => $name)
                            <option value="{{ $id }}" @selected(old('subcategory_id', $product->subcategory_id) == $id)>{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="image" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Image</label>

                    @if ($product->image)
                        <div class="mb-3">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
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

                <div>
                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Price</label>
                    <input id="price" type="text" name="price" value="{{ old('price', $product->price) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: 230" required>
                    @error('price')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Stock</label>
                    <input id="stock" type="text" name="stock" value="{{ old('stock', $product->stock) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: 20" required>
                    @error('stock')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: Complete and balanced nutrition for adult dogs.">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->status))
                            class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                        Active
                    </label>
                    @error('is_active')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.product.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
