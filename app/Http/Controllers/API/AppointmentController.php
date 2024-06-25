<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['patient', 'doctor'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        return Appointment::create($request->all());
    }

    public function show(Appointment $appointment)
    {
        return $appointment->load(['patient', 'doctor']);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'sometimes|required|exists:patients,id',
            'doctor_id' => 'sometimes|required|exists:doctors,id',
            'appointment_date' => 'sometimes|required|date',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($request->all());

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->noContent();
    }
}
