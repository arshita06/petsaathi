<x-admin-layout title="General Settings">
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-400">Settings</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-950 dark:text-slate-50">General Settings</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Each field is a key / value row from the settings table.</p>
        </div>

        <span class="inline-flex items-center rounded-full border border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-950 px-3 py-1 text-xs font-bold text-blue-700 dark:text-blue-300">
            {{ count($settings) }} {{ Str::plural('Setting', count($settings)) }}
        </span>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 dark:border-emerald-800 bg-emerald-50 dark:bg-emerald-950 px-4 py-3 text-sm font-semibold text-emerald-700 dark:text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-rose-200 dark:border-rose-800 bg-rose-50 dark:bg-rose-950 px-4 py-3 text-sm font-semibold text-rose-700 dark:text-rose-300">
            Please fix the highlighted fields below.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
            <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Saved Settings</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update any value and save.</p>
            </div>

            @php
                $appearance = $settings['appearance'] ?? 'light';
            @endphp

            <div class="p-6">
                <label for="appearance" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Appearance
                </label>

                <select
                    id="appearance"
                    name="appearance"
                    class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                >
                    <option value="light" {{ old('appearance', $appearance) === 'light' ? 'selected' : '' }}>
                        Light
                    </option>

                    <option value="dark" {{ old('appearance', $appearance) === 'dark' ? 'selected' : '' }}>
                        Dark
                    </option>
                </select>

                <p class="mt-1.5 text-xs font-medium text-slate-400 dark:text-slate-500">
                    key: appearance
                </p>

                @error('appearance')
                    <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">
                        {{ $message }}
                    </p>
                @enderror
            </div>



            @php
                $rows = collect($settings)->except(['appearance', 'site_logo', 'site_favicon']);
                $logo = $settings['site_logo'] ?? null;
                $favicon = $settings['site_favicon'] ?? null;
            @endphp

            <div class="grid gap-5 border-t border-slate-200 px-6 py-6 dark:border-slate-700 sm:grid-cols-2">
                <div>
                    <label for="site_logo" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Site Logo
                    </label>

                    <div class="flex items-center gap-4">
                        <span class="grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                            @if ($logo)
                                <img src="{{ asset($logo) }}" alt="Site logo" class="h-full w-full object-contain">
                            @else
                                <span class="text-[11px] font-bold uppercase text-slate-400 dark:text-slate-500">None</span>
                            @endif
                        </span>

                        <input id="site_logo" type="file" name="site_logo" accept="image/*"
                            class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 dark:text-slate-400">
                    </div>

                    <p class="mt-1.5 text-xs font-medium text-slate-400 dark:text-slate-500">
                        key: site_logo &mdash; leave empty to keep the current image
                    </p>

                    @error('site_logo')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_favicon" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                        Site Favicon
                    </label>

                    <div class="flex items-center gap-4">
                        <span class="grid h-16 w-16 shrink-0 place-items-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-800">
                            @if ($favicon)
                                <img src="{{ asset($favicon) }}" alt="Site favicon" class="h-8 w-8 object-contain">
                            @else
                                <span class="text-[11px] font-bold uppercase text-slate-400 dark:text-slate-500">None</span>
                            @endif
                        </span>

                        <input id="site_favicon" type="file" name="site_favicon" accept=".png,.ico,.svg,.jpg,.jpeg,.webp"
                            class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 dark:text-slate-400">
                    </div>

                    <p class="mt-1.5 text-xs font-medium text-slate-400 dark:text-slate-500">
                        key: site_favicon &mdash; leave empty to keep the current image
                    </p>

                    @error('site_favicon')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            @if ($rows->isNotEmpty())
                <div class="grid gap-5 p-6 sm:grid-cols-2">
                    @foreach ($rows as $key => $value)
                        <div>
                            <label for="setting_{{ $key }}" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                {{ Str::headline($key) }}
                            </label>
                            <input id="setting_{{ $key }}" type="text" name="settings[{{ $key }}]"
                                value="{{ old('settings.' . $key, $value) }}"
                                class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            <p class="mt-1.5 text-xs font-medium text-slate-400 dark:text-slate-500">key: {{ $key }}</p>
                            @error('settings.' . $key)
                                <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                    No settings saved yet. Add your first key and value below.
                </div>
            @endif
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm">
            <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-950 dark:text-slate-50">Add New Setting</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Leave blank if you are only updating the values above.</p>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2">
                <div>
                    <label for="new_key" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Key</label>
                    <input id="new_key" type="text" name="new_key" value="{{ old('new_key') }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: site_name">
                    @error('new_key')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_value" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-300">Value</label>
                    <input id="new_value" type="text" name="new_value" value="{{ old('new_value') }}"
                        class="block w-full rounded-lg border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-3 py-2.5 text-sm text-slate-900 dark:text-slate-100 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: PetSaathi">
                    @error('new_value')
                        <p class="mt-2 text-sm font-semibold text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-200 dark:border-slate-700 px-6 py-5">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
