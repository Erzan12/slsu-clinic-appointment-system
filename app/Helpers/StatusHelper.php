<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class StatusHelper 
{
    public static function prettyStatus($status)
    {
        switch($status) {
            case 0:
                return 'Pending';
            case 1:
                return 'Approved';
            case 2:
                return 'To be rate';
            case 4:
                return 'Rejected';
            default:
                return 'Done';
        }
    }

    public static function numericStatus($status)
    {
        $status = Str::lower($status);
        if(Str::startsWith('pending', $status)) {
            return 0;
        } else if (Str::startsWith('approved', $status)) {
            return 1;
        } else if (Str::startsWith('rating', $status)) {
            return 2;
        } else if (Str::startsWith('done', $status)) {
            return 3;
        } else {
            return 4;
        }
    }
}