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
       $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients',
            'birth_date' => 'required|date',
        ]);

        $patient = $this->patientService->create($data);

        return response()->json([
            'success' => true,
            'data' => $patient,
            'message' => 'Patient created.'
        ], Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
       $patient = $this->patientService->find($id);
        return response()->json([
            'success' => true,
            'data' => $patient,
            'message' => 'Patient found.'
        ], Response::HTTP_OK);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:patients,email,' . $id,
            'birth_date' => 'sometimes|required|date',
        ]);

        $patient= $this->patientService->update($data, $id);

        return response()->json([
            'success' => true,
            'data' => $patient,
            'message' => 'Patient updated.'
        ], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $this->patientService->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
