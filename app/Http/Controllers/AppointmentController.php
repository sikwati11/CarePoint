<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::with([
            'doctor.specialtyDetail',
            'patient.doctors',
        ])
            ->orderByDesc('appointment_date')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        return view('appointments.create', [
            'doctors' => Doctor::orderBy('name')->get(),
            'patients' => Patient::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'appointment_date' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,confirmed,completed,cancelled'],
        ]);

        $duplicate = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('patient_id', $validated['patient_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'appointment_date' => 'This exact appointment has already been booked.',
            ]);
        }

        Appointment::create($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }
}
