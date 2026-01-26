<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * Summary of scopeAuthenticate
     * @param mixed $query
     * @param array $fields has the keys: username, password, account_type
     * @return boolean
     */
    public static function scopeAuthenticate($query, $fields = [])
    {
        if(!Arr::has($fields, ['username', 'password', 'account_type'])) {
            throw \Exception('Missing Fields');
        }

        $user = $query->where('username', $fields['username'])->where('account_type', $fields['account_type'])->first();
        if(!$user) {
            return false;
        }
        
        if(!Hash::check($fields['password'], $user->password)) {
            return false;
        }

        return $user;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'user_id',
        'account_type',
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
    

    public function fullName()
    {
        if($this->account_type == 1) {
            return $this->admin->first_name .' '. $this->admin->last_name;
        }else if($this->account_type == 2) {
            $information = Information::where('user_id', $this->user_id)->where('account_type', $this->account_type)->first();
            return $information->first_name .' '. $information->last_name;
        }else if($this->account_type == 3) {
            $information = Information::where('user_id', $this->user_id)->where('account_type', $this->account_type)->first();
            return $information->first_name .' '.$information->last_name;
        }
    }

    public function displayName()
    {
        if($this->account_type == 1) {
            return $this->admin->display_name;
        }

        return $this->fullName();
    }

    public function avatar()
    {
        if($this->account_type == 1) {
            return $this->admin->avatar;
        } else if($this->account_type == 2) {
            $information = Information::where('user_id', $this->user_id)->where('account_type', $this->account_type)->first();
            return $information->avatar;
        }else if($this->account_type == 3) {
            $information = Information::where('user_id', $this->user_id)->where('account_type', $this->account_type)->first();
            return $information->avatar;
        }
    }
}
