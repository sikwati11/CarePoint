<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Overview') | CarePoint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    <div class="min-h-screen">
        <div x-cloak x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-40 bg-slate-950/40 lg:hidden" @click="sidebarOpen = false"></div>

        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-800 bg-slate-900 text-white transition-transform duration-200 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            aria-label="Main navigation"
        >
            <div class="flex h-20 items-center gap-3 border-b border-slate-800 px-6">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16M4 12h16"/>
                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                    </svg>
                </div>
                <div>
                    <a href="{{ route('doctors.index') }}" class="text-lg font-semibold tracking-tight text-white">CarePoint</a>
                    <p class="text-xs font-medium text-slate-400">Clinic management</p>
                </div>
                <button type="button" class="ml-auto rounded-lg p-2 text-slate-400 hover:bg-slate-800 lg:hidden" @click="sidebarOpen = false" aria-label="Close navigation">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
                </button>
            </div>

            <div class="px-4 pt-7">
                <p class="px-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-slate-500">Workspace</p>
                <nav class="mt-3 space-y-1">
                    <a href="{{ route('doctors.index') }}" @click="sidebarOpen = false" @class([
                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
                        'bg-slate-800 text-white' => request()->routeIs('doctors.*', 'home'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('doctors.*', 'home'),
                    ])>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M14 3.13a4 4 0 0 1 0 7.75M14 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/></svg>
                        Doctors
                    </a>
                    <a href="{{ route('patients.index') }}" @click="sidebarOpen = false" @class([
                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
                        'bg-slate-800 text-white' => request()->routeIs('patients.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('patients.*'),
                    ])>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 0 0-16 0m12-13a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/></svg>
                        Patients
                    </a>
                    <a href="{{ route('appointments.index') }}" @click="sidebarOpen = false" @class([
                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition',
                        'bg-slate-800 text-white' => request()->routeIs('appointments.*'),
                        'text-slate-400 hover:bg-slate-800 hover:text-white' => ! request()->routeIs('appointments.*'),
                    ])>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/></svg>
                        Appointments
                    </a>
                </nav>
            </div>

            <div class="mt-auto border-t border-slate-800 px-6 py-5">
                <p class="text-xs font-medium text-slate-400">CarePoint Clinic</p>
                <p class="mt-1 text-xs text-slate-500">Appointment management</p>
            </div>
        </aside>

        <div class="min-h-screen lg:pl-72">
            <header class="sticky top-0 z-30 border-b border-slate-800 bg-slate-900">
                <div class="flex h-16 items-center gap-4 px-4 sm:px-6 lg:px-10">
                    <button type="button" class="rounded-lg p-2 text-slate-300 hover:bg-slate-800 lg:hidden" @click="sidebarOpen = true" aria-label="Open navigation">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="flex min-w-0 items-center gap-2 text-sm">
                        <span class="hidden text-slate-400 sm:inline">Workspace</span>
                        <svg class="hidden h-4 w-4 text-slate-600 sm:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                        <span class="truncate font-medium text-white">@yield('breadcrumb', 'Overview')</span>
                    </div>
                    <div class="ml-auto flex items-center gap-3">
                        <span class="hidden text-sm text-slate-400 sm:inline">Clinic workspace</span>
                        <div class="hidden items-center gap-2 sm:flex">
                            <div class="text-right">
                                <p class="text-xs font-medium text-slate-100">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-slate-400">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-700 text-sm font-semibold text-slate-100">
                                {{ collect(explode(' ', auth()->user()->name))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->join('') }}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg border border-slate-700 px-3 py-2 text-xs font-semibold text-slate-300 transition hover:border-slate-600 hover:bg-slate-800 hover:text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-10 lg:py-10">
                @if (session('success'))
                    <div x-data="{ visible: true }" x-show="visible" x-transition class="mb-6 flex items-start justify-between gap-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="font-medium text-emerald-700 hover:text-emerald-900" @click="visible = false" aria-label="Dismiss notification">Dismiss</button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
