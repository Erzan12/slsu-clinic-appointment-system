<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'responsiveness',
        'reliability',
        'access_and_facility',
        'costs',
        'integrity',
        'communication',
        'assurance',
        'outcome',
        'suggestions'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
}
