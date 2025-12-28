<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingArea;
use App\Models\ParkingSpace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParkingSpaceController extends Controller
{
    // 🔹 GLOBAL LIST
    public function index()
    {
        $spaces = ParkingSpace::with('parkingArea')
            ->latest()
            ->get();

        return view('admin.spaces.index', compact('spaces'));
    }

    public function create()
    {
        $areas = ParkingArea::orderBy('name')->get();

        return view('admin.spaces.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parking_area_id' => 'required|exists:parking_areas,id',
            'space_no'        => 'required|string|max:50',
        ]);

        ParkingSpace::create([
            'parking_area_id' => $request->parking_area_id,
            'space_no'        => $request->space_no,
            'qr_token'        => Str::uuid(),
            'status'          => 'available',
        ]);

        return redirect()
            ->route('admin.spaces.index')
            ->with('success', 'Parking space created');
    }

    public function edit(ParkingSpace $space)
    {
        $areas = ParkingArea::orderBy('name')->get();

        return view('admin.spaces.edit', compact('space', 'areas'));
    }

    public function update(Request $request, ParkingSpace $space)
    {
        $request->validate([
            'parking_area_id' => 'required|exists:parking_areas,id',
            'space_no'        => 'required|string|max:50',
            'status'          => 'required|in:available,occupied,disabled',
        ]);

        $space->update($request->only(
            'parking_area_id',
            'space_no',
            'status'
        ));

        return redirect()
            ->route('admin.spaces.index')
            ->with('success', 'Parking space updated');
    }

    public function destroy(ParkingSpace $space)
    {
        $space->delete();

        return back()->with('success', 'Parking space deleted');
    }
}
