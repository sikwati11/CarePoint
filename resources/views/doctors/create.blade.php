@extends('layouts.app')

@section('title', 'Add doctor')
@section('breadcrumb', 'Add doctor')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Care team</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Add a doctor</h1>
        <p class="mt-2 text-sm text-slate-500">Doctor and specialty information are saved together.</p>
    </div>

    <form method="POST" action="{{ route('doctors.store') }}" class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" onsubmit="const button=this.querySelector('[type=submit]'); button.disabled=true; button.textContent='Saving...';">
        @csrf
        <div class="space-y-8 p-6 sm:p-8">
            <section>
                <h2 class="text-base font-semibold text-slate-900">Doctor information</h2>
                <p class="mt-1 text-sm text-slate-500">Basic contact details for the practitioner.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700" for="name">Full name</label>
                        <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('name') border-red-400 @enderror" id="name" name="name" value="{{ old('name') }}" required maxlength="255" placeholder="e.g. Dr. Maya Santos">
                        @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700" for="email">Email address</label>
                        <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('email') border-red-400 @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" placeholder="doctor@example.com">
                        @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section class="border-t border-slate-100 pt-7">
                <h2 class="text-base font-semibold text-slate-900">Specialty details</h2>
                <p class="mt-1 text-sm text-slate-500">License and clinic room information for this doctor.</p>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700" for="license_number">License number</label>
                        <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('license_number') border-red-400 @enderror" id="license_number" name="license_number" value="{{ old('license_number') }}" required maxlength="255" placeholder="Medical license">
                        @error('license_number')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700" for="clinic_room">Clinic room</label>
                        <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('clinic_room') border-red-400 @enderror" id="clinic_room" name="clinic_room" value="{{ old('clinic_room') }}" required maxlength="255" placeholder="e.g. Room 204">
                        @error('clinic_room')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>
        </div>
        <div class="flex justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:px-8">
            <a class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50" href="{{ route('doctors.index') }}">Cancel</a>
            <button class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100" type="submit">Save doctor</button>
        </div>
    </form>
@endsection
