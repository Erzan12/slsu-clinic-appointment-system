<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function upcomingAvailability(Request $request)
    {
        return response()->json(['message' => 'Not yet implemented']);
    }
}
