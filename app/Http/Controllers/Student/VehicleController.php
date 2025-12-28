<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.vehicles.index', [
            'vehicles' => auth()->user()->vehicles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_no' => 'required|string|max:20|unique:vehicles,plate_no',
            'type'     => 'required|in:car,motorcycle',
            'brand'    => 'nullable|string|max:50',
            'model'    => 'nullable|string|max:50',
            'grant'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $path = $request->file('grant')->store('grants', 'public');

        Vehicle::create([
            'user_id'         => auth()->id(),
            'plate_no'        => strtoupper($validated['plate_no']),
            'type'            => $validated['type'],
            'brand'           => $validated['brand'] ?? null,
            'model'           => $validated['model'] ?? null,
            'grant_path'      => $path,
            'approval_status' => 'pending',
        ]);

        return redirect()
            ->route('student.vehicles.index')
            ->with('success', 'Vehicle submitted for approval');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $this->authorizeOwner($vehicle);

        return view('student.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->authorizeOwner($vehicle);

        $validated = $request->validate([
            'type'  => 'required|in:car,motorcycle',
            'brand' => 'nullable|string|max:50',
            'model' => 'nullable|string|max:50',
            'grant' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // If re-upload grant
        if ($request->hasFile('grant')) {
            if ($vehicle->grant_path) {
                Storage::disk('public')->delete($vehicle->grant_path);
            }

            $validated['grant_path'] =
                $request->file('grant')->store('grants', 'public');

            // bila update grant → kena approve semula
            $validated['approval_status'] = 'pending';
        }

        $vehicle->update($validated);

        return redirect()
            ->route('student.vehicles.index')
            ->with('success', 'Vehicle updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = \App\Models\Vehicle::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($vehicle->approval_status === 'approved') {
            return back()->with('error', 'Approved vehicle cannot be deleted');
        }

        $vehicle->delete();

        return back()->with('success', 'Vehicle deleted successfully');
    }


    /**
     * Ensure student owns the vehicle
     */
    private function authorizeOwner(Vehicle $vehicle)
    {
        if ($vehicle->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
