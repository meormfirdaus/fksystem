<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ParkingArea;
use App\Models\ParkingSpace;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard',[
            'users'=>User::count(),
            'areas'=>ParkingArea::count(),
            'spaces'=>ParkingSpace::count(),
            'available'=>ParkingSpace::where('status','available')->count()
        ]);
    }
}
