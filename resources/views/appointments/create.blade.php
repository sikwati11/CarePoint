@extends('layouts.app')

@section('title', 'Book appointment')
@section('breadcrumb', 'Book appointment')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Schedule</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Book an appointment</h1>
        <p class="mt-2 text-sm text-slate-500">Choose a doctor, a patient, and a time.</p>
    </div>

    @if ($doctors->isEmpty() || $patients->isEmpty())
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5 text-sm text-blue-950">
            <p class="font-semibold">A couple of things are needed first</p>
            <p class="mt-1 text-blue-900">
                Add
                @if ($doctors->isEmpty()) <a href="{{ route('doctors.create') }}" class="font-semibold underline">a doctor</a>@endif
                @if ($doctors->isEmpty() && $patients->isEmpty()) and @endif
                @if ($patients->isEmpty()) <a href="{{ route('patients.create') }}" class="font-semibold underline">a patient</a>@endif
                before booking.
            </p>
        </div>
    @else
        <form method="POST" action="{{ route('appointments.store') }}" class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" onsubmit="const button=this.querySelector('[type=submit]'); button.disabled=true; button.textContent='Booking...';">
            @csrf
            <div class="grid gap-5 p-6 sm:grid-cols-2 sm:p-8">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="doctor_id">Doctor</label>
                    <select class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('doctor_id') border-red-400 @enderror" id="doctor_id" name="doctor_id" required>
                        <option value="">Select a doctor</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                    @error('doctor_id')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="patient_id">Patient</label>
                    <select class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('patient_id') border-red-400 @enderror" id="patient_id" name="patient_id" required>
                        <option value="">Select a patient</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" @selected(old('patient_id') == $patient->id)>{{ $patient->name }} — {{ $patient->email }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="appointment_date">Date and time</label>
                    <input class="block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('appointment_date') border-red-400 @enderror" id="appointment_date" name="appointment_date" type="datetime-local" value="{{ old('appointment_date') }}" required>
                    @error('appointment_date')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-slate-700" for="status">Status</label>
                    <select class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-100 @error('status') border-red-400 @enderror" id="status" name="status" required>
                        @foreach (['scheduled' => 'Scheduled', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', 'scheduled') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:px-8">
                <a class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50" href="{{ route('appointments.index') }}">Cancel</a>
                <button class="rounded-lg bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100" type="submit">Book appointment</button>
            </div>
        </form>
    @endif
@endsection
