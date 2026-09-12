<x-admin-layout title="Create Permission">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Create Permission</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Add a permission that can be assigned to roles.</p>
        </div>

        <a href="{{ route('admin.permissions.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Permissions
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Permission Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.permissions.store') }}" class="p-6">
            @csrf

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="module" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Module</label>
                    <select id="module" name="module" required style="width: 100%;"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option></option>
                        @foreach ($modules as $module)
                            <option value="{{ $module }}" @selected(old('module') === $module)>{{ $module }}</option>
                        @endforeach
                        @if (old('module') && ! $modules->contains(old('module')))
                            <option value="{{ old('module') }}" selected>{{ old('module') }}</option>
                        @endif
                    </select>
                    <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Pick an existing module or type a new name and press Enter.</p>
                    @error('module')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="access" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Access</label>
                    <input id="access" type="text" name="access" value="{{ old('access') }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: view" required>
                    @error('access')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label for="description" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: can view users">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.permissions.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Create Permission
                </button>
            </div>
        </form>
    </div>

    {{-- Select2: searchable dropdown that also lets you type a brand-new module --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 42px;
            border-color: #eadfff;
            border-radius: 0.5rem;
            padding: 5px 6px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px;
            color: #191429;
            padding-left: 6px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9d93ba;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #7c3cff;
            box-shadow: 0 0 0 3px rgba(124, 60, 255, .18);
        }
        .select2-dropdown {
            border-color: #eadfff;
            border-radius: 0.5rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        jQuery(function ($) {
            $('#module').select2({
                tags: true,
                width: '100%',
                placeholder: 'Select or type a module',
                allowClear: false,
            });
        });
    </script>
</x-admin-layout>
