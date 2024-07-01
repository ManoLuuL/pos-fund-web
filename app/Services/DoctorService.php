<?php

namespace App\Services;

use App\Interface\DoctorRepositoryInterface;

class DoctorService
{
    public function __construct(
        protected DoctorRepositoryInterface $doctorRepository
    ) {
    }

    public function all() {
        return $this->doctorRepository->all();
    }


}
