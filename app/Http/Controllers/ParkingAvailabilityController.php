<?php

namespace App\Http\Controllers;

use App\Models\ParkingArea;

class ParkingAvailabilityController extends Controller
{
    /**
     * Display daily parking availability (PUBLIC)
     */
    public function index()
    {
        $areas = ParkingArea::withCount([
            'parkingSpaces as total_spaces',
            'parkingSpaces as available_spaces' => function ($query) {
                $query->where('status', 'available');
            }
        ])->get();

        return view('public.availability', compact('areas'));
    }
}
