<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_homepage_displays_the_doctors_list(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertOk()
            ->assertSee('Doctors')
            ->assertSee('No doctors yet');
    }

    public function test_a_user_can_add_a_doctor_patient_and_appointment(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('doctors.store'), [
            'name' => 'Dr. Maya Santos',
            'email' => 'maya@example.com',
            'license_number' => 'LIC-1001',
            'clinic_room' => 'Room 204',
        ])->assertRedirect(route('doctors.index'));

        $doctor = Doctor::firstOrFail();
        $this->assertSame('LIC-1001', $doctor->specialtyDetail->license_number);

        $this->post(route('patients.store'), [
            'name' => 'Alex Rivera',
            'email' => 'alex@example.com',
        ])->assertRedirect(route('patients.index'));

        $patient = Patient::firstOrFail();
        $this->post(route('appointments.store'), [
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'appointment_date' => now()->addDay()->format('Y-m-d\TH:i'),
            'status' => 'scheduled',
        ])->assertRedirect(route('appointments.index'));

        $this->assertDatabaseCount('appointments', 1);
        $appointment = Appointment::with('patient.doctors')->firstOrFail();
        $this->assertTrue($appointment->patient->doctors->contains('id', $doctor->id));
    }
}
