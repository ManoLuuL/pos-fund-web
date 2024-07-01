<?php

namespace App\Services;

use App\Interface\PatientRepositoryInterface;

class PatientService
{
    public function __construct(
        protected PatientRepositoryInterface $patientRepository
    ) {
    }

    public function all() {
        return $this->patientRepository->all();
    }

    public function create(array $data) {
        return $this->patientRepository->create($data);
    }

    public function find(int $id) {
        return $this->patientRepository->find($id);
    }

    public function update(array $data, int $id) {
        return $this->patientRepository->update($data, $id);
    }

    public function delete(int $id) {
        return $this->patientRepository->delete($id);
    }
}
