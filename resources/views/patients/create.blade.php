@extends('layouts.app')

@section('title', 'Add patient')
@section('breadcrumb', 'Add patient')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Patient directory</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Add a patient</h1>
        <p class="mt-2 text-sm text-slate-500">Patient records can be selected when booking an appointment.</p>
    </div>

    <form method="POST" action="{{ route('patients.store') }}" class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" onsubmit="const button=this.querySelector('[type=submit]'); button.disabled=true; button.textContent='Saving...';">
        @csrf
        <div class="grid gap-5 p-6 sm:grid-cols-2 sm:p-8">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700" for="name">Full name</label>
                <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('name') border-red-400 @enderror" id="name" name="name" value="{{ old('name') }}" required maxlength="255" placeholder="Patient's full name">
                @error('name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700" for="email">Email address</label>
                <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('email') border-red-400 @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" placeholder="patient@example.com">
                @error('email')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:px-8">
            <a class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50" href="{{ route('patients.index') }}">Cancel</a>
            <button class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100" type="submit">Save patient</button>
        </div>
    </form>
@endsection
