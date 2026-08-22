<x-admin-layout title="Edit Permission">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Edit Permission</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update permission module, access, and description.</p>
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

        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}" class="p-6">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-rose-200 dark:border-rose-800 bg-rose-50 dark:bg-rose-950 px-4 py-3 text-sm font-semibold text-rose-700 dark:text-rose-300">
                    Please check the form and try again.
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="module" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Module</label>
                    <input id="module" type="text" name="module" value="{{ old('module', $permission->module ?: str($permission->name)->before('.')->title()) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                    @error('module')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="access" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Access</label>
                    <input id="access" type="text" name="access" value="{{ old('access', $permission->access ?: str($permission->name)->after('.')) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        required>
                    @error('access')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <label for="description" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">{{ old('description', $permission->description) }}</textarea>
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
                    Update Permission
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
