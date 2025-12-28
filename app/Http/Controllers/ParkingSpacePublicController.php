<?php

namespace App\Http\Controllers;

use App\Models\ParkingSpace;

class ParkingSpacePublicController extends Controller
{
    public function show($token)
    {
        $space = ParkingSpace::where('qr_token', $token)
            ->with('parkingArea')
            ->firstOrFail();

        return view('public.space-show', compact('space'));
    }
}
