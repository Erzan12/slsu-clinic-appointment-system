<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id_number'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function information()
    {
        return $this->hasOne(Information::class, 'id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id', 'patient_id');
    }
}
