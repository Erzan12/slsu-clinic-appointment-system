<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'account_type',
        'avatar',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'gender',
        'contact_number',
        'barangay',
        'municipality',
        'province'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id', 'id');
    }

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getFullAddress()
    {
        return "$this->barangay, $this->municipality, $this->province";
    }
}
