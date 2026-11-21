@extends('layouts.app')

@section('title', 'Appointments')
@section('breadcrumb', 'Appointments')

@section('content')
    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Schedule</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Appointments</h1>
            <p class="mt-2 text-sm text-slate-500">Review upcoming visits and the care relationships connected to them.</p>
        </div>
        <a href="{{ route('appointments.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M12 5v14m-7-7h14"/></svg>
            Book appointment
        </a>
    </div>

    @if ($appointments->isEmpty())
        <section class="rounded-xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-600">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="16" rx="2"/><path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 15 2 2 4-4"/>
                </svg>
            </div>
            <h2 class="mt-5 text-base font-semibold text-slate-900">No appointments booked</h2>
            <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">Once you have a doctor and a patient, you can schedule a visit and see their care relationships here.</p>
            <a href="{{ route('appointments.create') }}" class="mt-6 inline-flex items-center rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">Book an appointment</a>
        </section>
    @else
        <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-1 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Appointment schedule</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $appointments->count() }} {{ \Illuminate\Support\Str::plural('appointment', $appointments->count()) }}</p>
                </div>
                <span class="text-xs font-medium text-slate-400">Sorted by appointment date</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-slate-500">Date &amp; time</th>
                            <th scope="col" class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-slate-500">Doctor</th>
                            <th scope="col" class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-slate-500">Patient</th>
                            <th scope="col" class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th scope="col" class="px-6 py-3.5 text-xs font-semibold uppercase tracking-wider text-slate-500">Patient's doctors</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($appointments as $appointment)
                            @php
                                [$statusLabel, $statusClasses] = match ($appointment->status) {
                                    'completed' => ['Completed', 'bg-green-100 text-green-800'],
                                    'cancelled' => ['Cancelled', 'bg-red-100 text-red-800'],
                                    'confirmed' => ['Confirmed', 'bg-blue-100 text-blue-800'],
                                    default => ['Pending', 'bg-yellow-100 text-yellow-800'],
                                };
                            @endphp
                            <tr class="transition-colors hover:bg-slate-50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="text-sm font-medium text-slate-900">{{ $appointment->appointment_date->format('M j, Y') }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $appointment->appointment_date->format('g:i A') }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-200 text-xs font-semibold text-slate-700">
                                            {{ collect(explode(' ', $appointment->doctor->name))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->join('') }}
                                        </div>
                                        <div>
                                            <p class="whitespace-nowrap text-sm font-semibold text-slate-900">{{ $appointment->doctor->name }}</p>
                                            <p class="mt-0.5 text-xs text-slate-500">{{ $appointment->doctor->specialtyDetail?->clinic_room ?? 'Clinic room not assigned' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="whitespace-nowrap text-sm font-medium text-slate-800">{{ $appointment->patient->name }}</p>
                                    <p class="mt-1 text-xs text-slate-500">{{ $appointment->patient->email }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses }}">{{ $statusLabel }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex max-w-xs flex-wrap gap-1.5">
                                        @forelse ($appointment->patient->doctors->unique('id') as $linkedDoctor)
                                            <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">{{ $linkedDoctor->name }}</span>
                                        @empty
                                            <span class="text-sm text-slate-400">No doctors linked</span>
                                        @endforelse
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection
