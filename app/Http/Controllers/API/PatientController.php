<?php

namespace App\Http\Controllers\API;

use App\Services\PatientService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientController extends Controller
{

    public function __construct(
        protected PatientService $patientService
    ) {
    }

    public function index()
    {
        $patient = $this->patientService->all();

        return response()->json([
            'success' => true,
            'data' => $patient,
            'message' => 'Todos os Pacientes.'
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients',
            'birth_date' => 'required|date',
        ]);

        return Patient::create($request->all());
    }

    public function show(Patient $patient)
    {
        return $patient;
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:patients,email,' . $patient->id,
            'birth_date' => 'sometimes|required|date',
        ]);

        $patient->update($request->all());

        return $patient;
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->noContent();
    }
}
