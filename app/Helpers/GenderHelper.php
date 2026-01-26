<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class GenderHelper 
{
    public static function prettyGender($gender)
    {
        switch($gender) {
            case 1:
                return 'Male';
            default:
                return 'Female';
        }
    }
}