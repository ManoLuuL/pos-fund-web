<?php

namespace App\Repository;

use App\Interface\DoctorRepositoryInterface;
use App\Models\Doctor;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function all() {
        return  Doctor::all();
    }


}
