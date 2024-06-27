<?php

namespace App\Repository;

use App\Models\Appointment;
use App\Interface\AppointmentRepositoryInterface;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function getAll()
    {
        return Appointment::all();
    }

    public function getById($id)
    {
        return Appointment::findOrFail($id);
    }

    public function create($data)
    {
        return Appointment::create($data);
    }

    public function update($id, $data)
    {
        $appointment = $this->getById($id);
        $appointment->update($data);
        return $appointment;
    }

    public function delete($id)
    {
        $appointment = $this->getById($id);
        $appointment->delete();
        return $appointment;
    }
}
