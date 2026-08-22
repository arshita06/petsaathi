<x-admin-layout title="Create Role">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Create Role</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Add a role that can be assigned to users.</p>
        </div>

        <a href="{{ route('admin.roles.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Roles
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Role Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Role Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: admin" required>
                @error('name')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label for="description" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                    placeholder="Example: access to everything">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700">
                <div class="bg-blue-600 px-5 py-3">
                    <h3 class="text-sm font-semibold text-white">Assign Permissions</h3>
                </div>

                <div class="divide-y divide-slate-200 dark:divide-slate-700 p-5">
                    @forelse ($permissionGroups as $module => $modulePermissions)
                        <div class="py-5 first:pt-0 last:pb-0">
                            <h4 class="mb-4 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-base font-semibold uppercase text-slate-950 dark:text-slate-50">{{ $module }}:</h4>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach ($modulePermissions as $permission)
                                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            @checked(in_array($permission->name, old('permissions', [])))
                                            class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                                        {{ $permission->access ?: $permission->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No permissions found.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.roles.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Create Role
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
