<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | CarePoint</title>
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
                <p class="mb-5 text-xs font-semibold uppercase tracking-[0.24em] text-blue-300">Get started</p>
                <h2 class="max-w-md text-5xl font-semibold leading-[1.08] tracking-[-0.04em]">
                    A better way to manage care.
                </h2>
                <p class="mt-6 max-w-md text-base leading-7 text-slate-300">
                    Create your workspace account and keep doctors, patients, and appointments moving together.
                </p>

                <div class="mt-10 max-w-md space-y-3">
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 backdrop-blur">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500/20 text-blue-300">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 7"/></svg>
                        </span>
                        <span class="text-sm text-slate-200">Secure account access</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 backdrop-blur">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500/20 text-blue-300">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 7"/></svg>
                        </span>
                        <span class="text-sm text-slate-200">One organized clinic workspace</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-3 backdrop-blur">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-500/20 text-blue-300">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 7"/></svg>
                        </span>
                        <span class="text-sm text-slate-200">Fast appointment management</span>
                    </div>
                </div>
            </div>

            <p class="relative z-10 text-xs text-slate-500">CarePoint Clinic Management System</p>
        </section>

        <section class="relative flex items-center justify-center px-5 py-8 sm:px-10">
            <div class="absolute right-7 top-7 hidden items-center gap-2 text-sm text-slate-500 sm:flex">
                <span>Already registered?</span>
                <a href="{{ route('login') }}" class="font-semibold text-[#0b315e] hover:text-blue-700">Sign in</a>
            </div>

            <div class="w-full max-w-[440px]">
                <div class="mb-7 flex items-center gap-3 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0b315e] text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M12 4v16M4 12h16"/><rect x="3" y="3" width="18" height="18" rx="5"/></svg>
                    </div>
                    <span class="text-lg font-semibold text-[#0b315e]">CarePoint</span>
                </div>

                <div class="mb-7">
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-blue-700">Create account</p>
                    <h1 class="mt-3 text-4xl font-semibold tracking-[-0.035em] text-[#10243d]">Join the clinic workspace</h1>
                    <p class="mt-3 text-sm leading-6 text-slate-500">Set up your account to start managing CarePoint.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" onsubmit="const button=this.querySelector('[type=submit]'); button.disabled=true; button.querySelector('.button-label').textContent='Creating account...';">
                    @csrf

                    @if ($errors->any())
                        <div class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            <svg class="mt-0.5 h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 7v6m0 4h.01"/></svg>
                            <ul class="list-disc space-y-0.5 pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#26384b]" for="name">Full name</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path stroke-linecap="round" d="M5 21a7 7 0 0 1 14 0"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="name" name="name" value="{{ old('name') }}" required maxlength="255" autocomplete="name" autofocus placeholder="Your full name">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#26384b]" for="email">Email address</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m4 7 8 6 8-6"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email" placeholder="name@company.com">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#26384b]" for="password">Password</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path stroke-linecap="round" d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="password" name="password" type="password" required minlength="8" autocomplete="new-password" placeholder="At least 8 characters">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-[#26384b]" for="password_confirmation">Confirm password</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path stroke-linecap="round" d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                            <input class="block h-13 w-full rounded-xl border border-slate-200 bg-white py-3 pl-12 pr-4 text-sm text-slate-900 shadow-[0_4px_14px_rgba(15,23,42,.03)] outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password" placeholder="Repeat your password">
                        </div>
                    </div>

                    <button class="group flex h-13 w-full items-center justify-center gap-2 rounded-xl bg-[#0b315e] px-5 text-sm font-semibold text-white shadow-[0_12px_24px_rgba(11,49,94,.18)] transition hover:-translate-y-0.5 hover:bg-[#0e3c70] hover:shadow-[0_16px_28px_rgba(11,49,94,.24)] focus:outline-none focus:ring-4 focus:ring-blue-100 disabled:cursor-not-allowed disabled:opacity-60" type="submit">
                        <span class="button-label">Create account</span>
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-5-5 5 5-5 5"/></svg>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500 sm:hidden">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-[#0b315e]">Sign in</a>
                </p>
            </div>
        </section>
    </main>
</body>
</html>
