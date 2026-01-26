<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class RatingHelper 
{
    public static function prettyRate($rate)
    {
        switch($rate) {
            case 1:
                return 'Very Dissastified';
            case 2:
                return 'Dissastified';
            case 3:
                return 'Neither Satisfied Nor Dissastified';
            case 4:
                return 'Satisfied';
            case 5:
                return 'Very Satisfied';
            default:
                return 'No Rating';
        }
    }
}