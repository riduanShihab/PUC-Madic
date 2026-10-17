<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $patient_id
 * @property string $name
 * @property string $gender
 * @property int $age
 * @property string|null $date_of_birth
 * @property string $phone
 * @property string|null $email
 * @property string|null $blood_group
 * @property string|null $address
 * @property string|null $emergency_contact
 * @property string|null $medical_history
 * @property string|null $allergies
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Patient extends Model
{
    use HasFactory;

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
}
