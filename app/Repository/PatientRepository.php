<?php

namespace App\Repository;

use App\Interface\PatientRepositoryInternface;
use App\Models\Patient;

class PatientRepository implements PatientRepositoryInternface
{
    public function all() {
        return  Patient::all();
    }

    public function find(int $id) {
        return  Patient::findOrFail($id);
    }

    public function create(array $data) {
        return  Patient::create($data);
    }

    public function update(array $data, int $id) {
        return  Patient::findOrFail($id)->update($data);
    }

    public function delete(int $id) {
         Patient::findOrFail($id)->delete();
    }
}
