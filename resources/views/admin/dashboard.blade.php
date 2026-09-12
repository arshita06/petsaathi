<x-admin-layout title="Dashboard">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-950 dark:text-slate-50">Dashboard</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Overview of PetSaathi admin activity.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $label => $value)
            <div class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-5 shadow-sm">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $label }}</p>
                <p class="mt-2 text-3xl font-bold text-slate-950 dark:text-slate-50">{{ $value }}</p>
            </div>
        @endforeach
    </div>
</x-admin-layout>
