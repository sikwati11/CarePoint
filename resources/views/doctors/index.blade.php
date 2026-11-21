@extends('layouts.app')

@section('title', 'Doctors')
@section('breadcrumb', 'Doctors')

@section('content')
    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Care team</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Doctors</h1>
            <p class="mt-2 text-sm text-slate-500">Your clinic practitioners and their specialty details.</p>
        </div>
        <a href="{{ route('doctors.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14m-7-7h14"/></svg>
            Add doctor
        </a>
    </div>

    @if ($doctors->isEmpty())
        <section class="rounded-xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M14 3.13a4 4 0 0 1 0 7.75M14 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                </svg>
            </div>
            <h2 class="mt-5 text-base font-semibold text-slate-900">No doctors yet</h2>
            <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">Add your first practitioner and their specialty information to get your care team started.</p>
            <a href="{{ route('doctors.create') }}" class="mt-6 inline-flex items-center rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">Add your first doctor</a>
        </section>
    @else
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($doctors as $doctor)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition-shadow hover:shadow-md">
                    <div class="flex items-start gap-4 border-b border-slate-100 p-5">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-slate-200 text-base font-semibold text-slate-700">
                            {{ collect(explode(' ', $doctor->name))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->join('') }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h2 class="truncate text-base font-semibold text-slate-900">{{ $doctor->name }}</h2>
                            <p class="mt-1 truncate text-sm text-slate-500">{{ $doctor->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-4 p-5">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Specialty details</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-500">License number</p>
                                <p class="mt-1 break-all text-sm font-medium text-slate-800">{{ $doctor->specialtyDetail?->license_number ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Clinic room</p>
                                <p class="mt-1 text-sm font-medium text-slate-800">{{ $doctor->specialtyDetail?->clinic_room ?? 'Not assigned' }}</p>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
