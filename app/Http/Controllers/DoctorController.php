<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(): View
    {
        $doctors = Doctor::with('specialtyDetail')
            ->orderBy('name')
            ->get();

        return view('doctors.index', compact('doctors'));
    }

    public function create(): View
    {
        return view('doctors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:doctors,email'],
            'license_number' => ['required', 'string', 'max:255', 'unique:specialty_details,license_number'],
            'clinic_room' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
            $doctor = Doctor::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $doctor->specialtyDetail()->create([
                'license_number' => $validated['license_number'],
                'clinic_room' => $validated['clinic_room'],
            ]);
        });

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor and specialty details added.');
    }
}
