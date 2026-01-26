<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'status',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'contact_number',
        'address'
    ];

    public function prettyStatus()
    {
        $status = [
            'Pending',
            'Accepted',
            'To be rate'
        ];
        return $status[$this->status];
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function finding()
    {
        return $this->hasOne(Finding::class, 'appointment_id', 'id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'appointment_id', 'id');
    }
}
