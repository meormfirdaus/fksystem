<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingArea;
use App\Models\ParkingSpace;

class AvailabilityApiController extends Controller
{
    /**
     * GET /api/availability
     * List all parking areas with availability
     */
    public function availability()
    {
        $areas = ParkingArea::withCount([
            'parkingSpaces as total_spaces',
            'parkingSpaces as available_spaces' => function ($query) {
                $query->where('status', 'available');
            }
        ])->get();

        return response()->json([
            'status' => 'success',
            'data' => $areas
        ]);
    }

    /**
     * GET /api/parking-space/{token}
     * Show parking space info by QR token
     */
    public function parkingSpace($token)
    {
        $space = ParkingSpace::where('qr_token', $token)
            ->with('parkingArea')
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => [
                'space_no' => $space->space_no,
                'status' => $space->status,
                'area' => [
                    'name' => $space->parkingArea->name,
                    'code' => $space->parkingArea->code,
                    'category' => $space->parkingArea->category,
                ],
            ]
        ]);
    }
}
