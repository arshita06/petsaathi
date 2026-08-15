<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} Admin</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-100 text-slate-900">
            <aside class="fixed inset-y-0 left-0 z-30 hidden w-72 flex-col border-r border-slate-200 bg-white lg:flex">
                <div class="flex h-16 shrink-0 items-center gap-3 border-b border-slate-200 px-6">
                    <div class="grid h-10 w-10 place-items-center rounded-xl bg-blue-600 text-lg font-bold text-white">
                        P
                    </div>
                    <div>
                        <div class="text-base font-bold text-slate-900">PetSaathi</div>
                        <div class="text-xs font-medium text-slate-500">Admin Panel</div>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto px-3 py-5">
                    <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">Management</p>

                    <div class="mt-2 space-y-1">
                        {{-- Access Control (collapsible) --}}
                        <div x-data="{ open: {{ request()->routeIs('admin.user.*', 'admin.roles.*', 'admin.permissions.*') ? 'true' : 'false' }} }">
                            <button type="button" @click="open = ! open"
                                class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-slate-200 group-hover:text-slate-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                                        <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                                        <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                                        <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                                        <rect x="7" y="7" width="10" height="10" rx="1" />
                                    </svg>
                                </span>
                                <span class="flex-1 text-left">Access Control</span>
                                <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="open && 'rotate-90'"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="ml-7 mt-1 origin-top space-y-0.5 border-l border-slate-200 pl-2">
                                <a href="{{ route('admin.user.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.user.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                    User Management
                                </a>

                                <a href="{{ route('admin.roles.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.roles.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.68 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1v7Z" />
                                    </svg>
                                    Roles
                                </a>

                                <a href="{{ route('admin.permissions.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.permissions.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M15 7h3a5 5 0 0 1 0 10h-3" />
                                        <path d="M9 17H6A5 5 0 0 1 6 7h3" />
                                        <path d="M8 12h8" />
                                    </svg>
                                    Permissions
                                </a>
                            </div>
                        </div>

                        {{-- Catalog (collapsible) --}}
                        <div x-data="{ open: {{ request()->routeIs('admin.category.*', 'admin.subcategory.*', 'admin.product.*') ? 'true' : 'false' }} }">
                            <button type="button" @click="open = ! open"
                                class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-slate-200 group-hover:text-slate-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 7V5a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v2" />
                                        <path d="M3 7h18l-1.5 11a2 2 0 0 1-2 1.7H6.5a2 2 0 0 1-2-1.7L3 7Z" />
                                    </svg>
                                </span>
                                <span class="flex-1 text-left">Catalog</span>
                                <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="open && 'rotate-90'"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="ml-7 mt-1 origin-top space-y-0.5 border-l border-slate-200 pl-2">
                                <a href="{{ route('admin.category.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.category.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="7" height="7" rx="1" />
                                        <rect x="14" y="3" width="7" height="7" rx="1" />
                                        <rect x="3" y="14" width="7" height="7" rx="1" />
                                        <rect x="14" y="14" width="7" height="7" rx="1" />
                                    </svg>
                                    Categories
                                </a>

                                <a href="{{ route('admin.subcategory.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.subcategory.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4v12a2 2 0 0 0 2 2h2" />
                                        <rect x="10" y="6" width="11" height="5" rx="1" />
                                        <rect x="10" y="15" width="11" height="5" rx="1" />
                                    </svg>
                                    Subcategories
                                </a>

                                <a href="{{ route('admin.product.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.product.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                        <path d="M3 6h18" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                    Product
                                </a>
                            </div>
                        </div>

                        {{-- Sales (collapsible) --}}
                        <div x-data="{ open: {{ request()->routeIs('admin.order.*', 'admin.wishlist.*') ? 'true' : 'false' }} }">
                            <button type="button" @click="open = ! open"
                                class="group flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-slate-200 group-hover:text-slate-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="20" r="1" />
                                        <circle cx="18" cy="20" r="1" />
                                        <path d="M2 3h2.5l2.4 12.2a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H5.5" />
                                    </svg>
                                </span>
                                <span class="flex-1 text-left">Sales</span>
                                <svg class="h-4 w-4 text-slate-400 transition-transform duration-200" :class="open && 'rotate-90'"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 -translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-2"
                                class="ml-7 mt-1 origin-top space-y-0.5 border-l border-slate-200 pl-2">
                                <a href="{{ route('admin.order.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.order.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z" />
                                        <path d="M14 2v6h6" />
                                        <path d="M9 13h6" />
                                        <path d="M9 17h4" />
                                    </svg>
                                    Orders
                                </a>

                                <a href="{{ route('admin.wishlist.index') }}"
                                    class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.wishlist.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1L12 21l7.7-7.6 1.1-1a5.5 5.5 0 0 0 0-7.8Z" />
                                    </svg>
                                    Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="shrink-0 border-t border-slate-200 p-4">
                    <div class="flex items-center gap-3 rounded-xl bg-slate-50 px-3 py-3">
                        <div class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-bold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="truncate text-xs font-medium text-slate-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="lg:pl-72">
                <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
                    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                        <div>
                            <p class="text-xs font-semibold uppercase text-slate-500">Admin</p>
                            <h1 class="text-lg font-bold text-slate-950">{{ $title ?? 'Dashboard' }}</h1>
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('profile.edit') }}" class="hidden text-sm font-medium text-slate-600 hover:text-slate-950 sm:block">
                                {{ Auth::user()->name }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
