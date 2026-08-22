<x-admin-layout title="Edit User">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Edit User</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update user profile details.</p>
        </div>

        <a href="{{ route('admin.user.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800">
            Back to Users
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
            <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">User Details</h3>
        </div>

        <form method="POST" action="{{ route('admin.user.update', $user) }}" class="p-6">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-rose-200 dark:border-rose-800 bg-rose-50 dark:bg-rose-950 px-4 py-3 text-sm font-semibold text-rose-700 dark:text-rose-300">
                    Please check the form and try again.
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Enter user name" required>
                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Enter email address" required>
                    @error('email')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">New Password</label>
                    <input id="password" type="password" name="password"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Leave blank to keep current password">
                    @error('password')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Confirm new password">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                        <input type="checkbox" name="is_active" value="1"
                            @checked(old('is_active', (bool) ($user->is_active ?? true)))
                            class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                        Is Active
                    </label>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700">
                <div class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-5 py-3">
                    <h3 class="text-sm font-semibold text-slate-950 dark:text-slate-50">Assign Roles</h3>
                </div>

                <div class="grid gap-4 p-5 sm:grid-cols-2 lg:grid-cols-4">
                    @php
                        $selectedRoles = old('roles', $user->roles->pluck('name')->all());
                    @endphp

                    @forelse ($roles as $role)
                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                @checked(in_array($role->name, $selectedRoles))
                                class="rounded border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-blue-600 dark:text-blue-400 focus:ring-blue-500">
                            {{ $role->name }}
                        </label>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No roles found.</p>
                    @endforelse
                </div>
                @error('roles')
                    <p class="px-5 pb-5 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.user.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Update User
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
