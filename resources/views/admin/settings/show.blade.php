<x-admin-layout title="General Settings">
    @php
        $fields = [
            'site_name'          => ['label' => 'Site Name', 'placeholder' => 'PetSaathi'],
            'site_tagline'       => ['label' => 'Tagline', 'placeholder' => 'Everything your pet needs, delivered.'],
            'site_email'         => ['label' => 'Site Email', 'placeholder' => 'support@petsaathi.com'],
            'site_phone'         => ['label' => 'Site Phone', 'placeholder' => '+91 98765 43210'],
            'site_address'       => ['label' => 'Address', 'placeholder' => 'Plot 21, Sector 34-A, Chandigarh'],
            'site_logo'          => ['label' => 'Site Logo', 'placeholder' => 'petsaathi-logo.png'],
            'site_favicon'       => ['label' => 'Site Favicon', 'placeholder' => 'favicon.ico'],
            'theme'              => ['label' => 'Theme Colour', 'placeholder' => '#2563EB'],
            'currency'           => ['label' => 'Currency', 'placeholder' => 'INR'],
            'shipping_charge'    => ['label' => 'Default Shipping Charge', 'placeholder' => '49'],
            'free_shipping_above'=> ['label' => 'Free Shipping Above', 'placeholder' => '999'],
            'facebook_url'       => ['label' => 'Facebook URL', 'placeholder' => 'https://facebook.com/petsaathi'],
            'instagram_url'      => ['label' => 'Instagram URL', 'placeholder' => 'https://instagram.com/petsaathi'],
            'whatsapp_number'    => ['label' => 'WhatsApp Number', 'placeholder' => '+91 98765 43210'],
            'meta_title'         => ['label' => 'Meta Title', 'placeholder' => 'PetSaathi - Pet Food, Toys & Accessories'],
            'meta_description'   => ['label' => 'Meta Description', 'placeholder' => 'Shop trusted pet food and accessories.'],
        ];

        $extra = collect($settings)->except(array_keys($fields));
    @endphp

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">Settings</p>
            <h2 class="mt-1 text-2xl font-bold text-slate-950">General Settings</h2>
            <p class="mt-1 text-sm text-slate-500">Each field is stored as a key / value row in the settings table.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
            Please fix the highlighted fields below.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.store') }}" class="space-y-6">
        @csrf

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-950">Site Settings</h3>
                <p class="mt-1 text-sm text-slate-500">Saved values are updated, new ones are created.</p>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2">
                @foreach ($fields as $key => $field)
                    <div>
                        <label for="{{ $key }}" class="mb-2 block text-sm font-semibold text-slate-700">
                            {{ $field['label'] }}
                        </label>
                        <input id="{{ $key }}" type="text" name="settings[{{ $key }}]"
                            value="{{ old('settings.' . $key, $settings[$key] ?? '') }}"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            placeholder="{{ $field['placeholder'] }}">
                        <p class="mt-1.5 text-xs font-medium text-slate-400">key: {{ $key }}</p>
                        @error('settings.' . $key)
                            <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>

        @if ($extra->isNotEmpty())
            <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="text-base font-semibold text-slate-950">Other Settings</h3>
                    <p class="mt-1 text-sm text-slate-500">Custom keys already saved in the table.</p>
                </div>

                <div class="grid gap-5 p-6 sm:grid-cols-2">
                    @foreach ($extra as $key => $value)
                        <div>
                            <label for="extra_{{ $key }}" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ $key }}
                            </label>
                            <input id="extra_{{ $key }}" type="text" name="settings[{{ $key }}]"
                                value="{{ old('settings.' . $key, $value) }}"
                                class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                            @error('settings.' . $key)
                                <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-950">Add New Setting</h3>
                <p class="mt-1 text-sm text-slate-500">Leave blank if you are only updating the fields above.</p>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2">
                <div>
                    <label for="new_key" class="mb-2 block text-sm font-semibold text-slate-700">Key</label>
                    <input id="new_key" type="text" name="new_key" value="{{ old('new_key') }}"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: support_timings">
                    @error('new_key')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_value" class="mb-2 block text-sm font-semibold text-slate-700">Value</label>
                    <input id="new_value" type="text" name="new_value" value="{{ old('new_value') }}"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                        placeholder="Example: Mon - Sat, 10 AM to 7 PM">
                    @error('new_value')
                        <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-200 px-6 py-5">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
