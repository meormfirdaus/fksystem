<?php

namespace App\Http\Controllers\Safety;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleApprovalController extends Controller
{
    public function index()
    {
        $vehicles = \App\Models\Vehicle::with('user')
            ->orderByRaw("FIELD(approval_status,'pending','rejected','approved')")
            ->latest()
            ->get();

        return view('safety.vehicle_approvals.index', compact('vehicles'));
    }

    public function approve(\App\Models\Vehicle $vehicle, Request $request)
    {
        $vehicle->update([
            'approval_status'=>'approved',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'approval_note'=>$request->note,
        ]);
        return back()->with('success','Approved');
    }

    public function reject(\App\Models\Vehicle $vehicle, Request $request)
    {
        $request->validate(['note'=>'required|string']);
        $vehicle->update([
            'approval_status'=>'rejected',
            'approved_by'=>auth()->id(),
            'approved_at'=>now(),
            'approval_note'=>$request->note,
        ]);
        return back()->with('success','Rejected');
    }

}
