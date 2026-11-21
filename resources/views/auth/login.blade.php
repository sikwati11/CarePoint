<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | CarePoint</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#edf2f8] font-sans text-slate-900 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[minmax(380px,0.82fr)_minmax(520px,1.18fr)]">
        <section class="relative hidden overflow-hidden bg-[#071a33] px-12 py-10 text-white lg:flex lg:flex-col">
            <div class="absolute -left-24 top-20 h-72 w-72 rounded-full border border-white/10"></div>
            <div class="absolute -left-10 top-36 h-44 w-44 rounded-full border border-white/10"></div>
            <div class="absolute bottom-[-180px] right-[-140px] h-[420px] w-[420px] rounded-full bg-blue-600/20 blur-3xl"></div>
            <div class="absolute right-[-110px] top-[-100px] h-80 w-80 rounded-full border border-blue-300/10"></div>

            <a href="{{ route('login') }}" class="relative z-10 flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 shadow-[0_10px_30px_rgba(59,130,246,.35)]">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" d="M12 4v16M4 12h16"/>
                        <rect x="3" y="3" width="18" height="18" rx="5"/>
                    </svg>
                </div>
                <span class="text-xl font-semibold tracking-tight">CarePoint</span>
            </a>

            <div class="relative z-10 my-auto max-w-lg">
                <p class="mb-5 text-xs font-semibold uppercase tracking-[0.24em] text-blue-300">Clinic workspace</p>
                <h2 class="max-w-md text-5xl font-semibold leading-[1.08] tracking-[-0.04em]">
                    Care, organized around people.
                </h2>
                <p class="mt-6 max-w-md text-base leading-7 text-slate-300">
                    Manage practitioners, patient records, and appointments from one calm, dependable workspace.
                </p>

                <div class="mt-10 grid max-w-md grid-cols-3 gap-3">
                    <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4 backdrop-blur">
                        <p class="text-2xl font-semibold">24/7</p>
                        <p class="mt-1 text-xs text-slate-400">Secure access</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4 backdrop-blur">
                        <p class="text-2xl font-semibold">One</p>
                        <p class="mt-1 text-xs text-slate-400">Unified system</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4 backdrop-blur">
                        <p class="text-2xl font-semibold">Fast</p>
                        <p class="mt-1 text-xs text-slate-400">Daily workflow</p>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-xs text-slate-500">CarePoint Clinic Management System</p>
        </section>

        <section class="relative flex items-center justify-center px-5 py-8 sm:px-10">
            <div class="absolute right-7 top-7 hidden items-center gap-2 text-sm text-slate-500 sm:flex">
                <span>New here?</span>
                <a href="{{ route('register') }}" class="font-semibold text-[#0b315e] hover:text-blue-700">Create an account</a>
            </div>

            <div class="w-full max-w-[440px]">
                <div class="mb-8 flex items-center gap-3 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0b315e] text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M12 4v16M4 12h16"/><rect x="3" y="3" width="18" height="18" rx="5"/></svg>
                    </div>
                    <span class="text-lg font-semibold text-[#0b315e]">CarePoint</span>
                </div>

                <div class="mb-8">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-700">Welcome back</p>
                    <h1 class="mt-3 text-4xl font-semibold tracking-[-0.035em] text-[#10243d]">Sign in to your account</h1>
                    <p class="mt-3 text-sm leading-6 text-slate-500">Enter your credentials to continue to the clinic workspace.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5" onsubmit="const button=this.querySelector('[type=submit]'); button.disabled=true; button.querySelector('.button-label').textContent='Signing in...';">
                    @csrf
                    @if ($errors->has('email'))
                        <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 7v6m0 4h.01"/></svg>
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    @endif

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#26384b]" for="email">Email address</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m4 7 8 6 8-6"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="name@company.com">
                        </div>
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <label class="block text-sm font-semibold text-[#26384b]" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path stroke-linecap="round" d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="password" name="password" type="password" required autocomplete="current-password" placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex cursor-pointer items-center gap-2.5 text-sm text-slate-600">
                            <input class="h-4 w-4 rounded border-slate-300 text-blue-700 focus:ring-2 focus:ring-blue-100" type="checkbox" name="remember" value="1">
                            Keep me signed in
                        </label>
                        <span class="text-sm text-slate-400">Secure session</span>
                    </div>

                    <button class="group flex h-13 w-full items-center justify-center gap-2 rounded-xl bg-[#0b315e] px-5 text-sm font-semibold text-white shadow-[0_12px_24px_rgba(11,49,94,.18)] transition hover:-translate-y-0.5 hover:bg-[#0e3c70] hover:shadow-[0_16px_28px_rgba(11,49,94,.24)] focus:outline-none focus:ring-4 focus:ring-blue-100 disabled:cursor-not-allowed disabled:opacity-60" type="submit">
                        <span class="button-label">Sign in</span>
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/></svg>
                    </button>
                </form>

                <p class="mt-7 text-center text-sm text-slate-500 sm:hidden">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-[#0b315e]">Create one</a>
                </p>
            </div>
        </section>
    </main>
</body>
</html>
