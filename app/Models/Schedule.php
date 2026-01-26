<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'specialist_id',
        'time_start',
        'time_end',
        'date',
        'flag'
    ];


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id', 'id');
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'id', 'schedule_id');
    }
}
