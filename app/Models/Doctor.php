<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Add the fillable property to allow mass assignment
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
