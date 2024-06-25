<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'notes',
    ];

    // Relacionamento com o paciente (Patient)
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relacionamento com o médico (Doctor)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
