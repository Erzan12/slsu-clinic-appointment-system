<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id', 'service_id');
    }
}
