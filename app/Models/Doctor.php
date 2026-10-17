<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $date_of_birth
 * @property string $date_of_joining
 * @property string $blood_group
 * @property string $department
 * @property string|null $specialists
 * @property string|null $designations
 * @property int $experience
 * @property string|null $profile_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'phone',
        'address',
        'email',
        'date_of_birth',
        'date_of_joining',
        'blood_group',
        'department',
        'specialists',
        'designations',
        'experience',
        'profile_image',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
