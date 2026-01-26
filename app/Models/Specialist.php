<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'position',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function information()
    {
        return $this->hasOne(Information::class, 'id', 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id', 'specialist_id');
    }
}
