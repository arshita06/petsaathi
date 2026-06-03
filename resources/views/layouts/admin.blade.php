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
            <aside class="fixed inset-y-0 left-0 z-30 hidden w-72 border-r border-slate-200 bg-white lg:block">
                <div class="flex h-16 items-center gap-3 border-b border-slate-200 px-6">
                    <div class="grid h-10 w-10 place-items-center rounded-lg bg-blue-600 text-lg font-bold text-white">
                        P
                    </div>
                    <div>
                        <div class="text-base font-bold">PetSaathi</div>
                        <div class="text-xs font-medium text-slate-500">Admin Panel</div>
                    </div>
                </div>

                <nav class="px-4 py-5">
                    {{-- <div class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                            <span class="grid h-8 w-8 place-items-center rounded-md {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 13h8V3H3v10Z" />
                                    <path d="M13 21h8V11h-8v10Z" />
                                    <path d="M13 3v6h8V3h-8Z" />
                                    <path d="M3 21h8v-6H3v6Z" />
                                </svg>
                            </span>
                            Dashboard
                        </a>
                    </div> --}}

                    <div class="mt-6">
                        <p class="px-3 text-xs font-bold uppercase tracking-wider text-slate-400">Management</p>

                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.user.index') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.user.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                                <span class="grid h-8 w-8 place-items-center rounded-md {{ request()->routeIs('admin.user.*') ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </span>
                                User Management
                            </a>

                            <a href="{{ route('admin.roles.index') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.roles.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                                <span class="grid h-8 w-8 place-items-center rounded-md {{ request()->routeIs('admin.roles.*') ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.68 0C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1v7Z" />
                                    </svg>
                                </span>
                                Roles
                            </a>

                            <a href="{{ route('admin.permissions.index') }}"
                                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold {{ request()->routeIs('admin.permissions.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}">
                                <span class="grid h-8 w-8 place-items-center rounded-md {{ request()->routeIs('admin.permissions.*') ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600' }}">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M15 7h3a5 5 0 0 1 0 10h-3" />
                                        <path d="M9 17H6A5 5 0 0 1 6 7h3" />
                                        <path d="M8 12h8" />
                                    </svg>
                                </span>
                                Permissions
                            </a>
                        </div>
                    </div>
                </nav>

                <div class="absolute bottom-0 left-0 right-0 border-t border-slate-200 p-4">
                    <div class="flex items-center gap-3 rounded-lg bg-slate-50 px-3 py-3">
                        <div class="grid h-9 w-9 place-items-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
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
