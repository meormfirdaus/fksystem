@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold">Safety Dashboard</h2>
        <p class="text-muted">Monitor and approve student vehicles</p>
    </div>

    {{-- STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Pending Approval</h6>
                    <h3 class="fw-bold text-warning">
                        {{ \App\Models\Vehicle::where('approval_status','pending')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Approved</h6>
                    <h3 class="fw-bold text-success">
                        {{ \App\Models\Vehicle::where('approval_status','approved')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Rejected</h6>
                    <h3 class="fw-bold text-danger">
                        {{ \App\Models\Vehicle::where('approval_status','rejected')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Total Vehicles</h6>
                    <h3 class="fw-bold">
                        {{ \App\Models\Vehicle::count() }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- QUICK ACTION --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Approval Management</h5>

                    <a href="{{ route('safety.vehicle-approvals.index') }}"
                       class="btn btn-primary w-100">
                        <i class="bi bi-shield-check me-2"></i>
                        Review Vehicle Approvals
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Guidelines</h5>
                    <ul class="text-muted mb-0">
                        <li>Verify plate number & grant clearly</li>
                        <li>Reject with clear reason if invalid</li>
                        <li>Approval is final unless re-registered</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
