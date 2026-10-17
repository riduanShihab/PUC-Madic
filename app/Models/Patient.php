<?php

namespace App\Models;

class Patient extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'gender',
        'age',
        'date_of_birth',
        'phone',
        'email',
        'blood_group',
        'address',
        'emergency_contact',
        'medical_history',
        'allergies',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
