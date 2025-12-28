<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingArea;

class ParkingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = ParkingArea::latest()->get();
        return view('admin.parking-areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parking-areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:parking_areas,code',
            'category' => 'required|in:staff,student,general',
            'requires_booking' => 'nullable',
        ]);

        ParkingArea::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'category' => $request->category,
            'requires_booking' => $request->has('requires_booking'),
            'status' => 'open',
        ]);

        return redirect()
            ->route('admin.parking-areas.index')
            ->with('success','Parking Area created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingArea $parking_area)
    {
        return view('admin.parking-areas.edit', compact('parking_area'));
    }

    /**
     * Update the specified resource in storage.
     */
/* UPDATE */
    public function update(Request $request, ParkingArea $parking_area)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|in:staff,student,general',
            'status' => 'required|in:open,closed',
        ]);

        $parking_area->update([
            'name' => $request->name,
            'category' => $request->category,
            'requires_booking' => $request->has('requires_booking'),
            'status' => $request->status,
            'closed_reason' => $request->status === 'closed'
                ? $request->closed_reason
                : null,
        ]);

        return redirect()
            ->route('admin.parking-areas.index')
            ->with('success','Parking Area updated');
    }

    /* DELETE */
    public function destroy(ParkingArea $parking_area)
    {
        $parking_area->delete();

        return back()->with('success','Parking Area deleted');
    }
}
