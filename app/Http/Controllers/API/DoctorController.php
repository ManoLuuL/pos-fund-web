<?php

namespace App\Http\Controllers\API;

use App\Services\DoctorService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DoctorController  extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $doctors = $this->doctorService->all();
        return response()->json([
            'success' => true,
            'data' => $doctors,
            'message' => 'Todos os Doutores.'
        ], Response::HTTP_OK);
    }
}
