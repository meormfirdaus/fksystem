@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold">Student Dashboard</h2>
        <p class="text-muted">Overview of your vehicle registrations</p>
    </div>

    {{-- STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Total Vehicles</h6>
                    <h3 class="fw-bold">
                        {{ auth()->user()->vehicles->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Pending</h6>
                    <h3 class="fw-bold text-warning">
                        {{ auth()->user()->vehicles->where('approval_status','pending')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Approved</h6>
                    <h3 class="fw-bold text-success">
                        {{ auth()->user()->vehicles->where('approval_status','approved')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted">Rejected</h6>
                    <h3 class="fw-bold text-danger">
                        {{ auth()->user()->vehicles->where('approval_status','rejected')->count() }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Quick Actions</h5>

                    <a href="{{ route('student.vehicles.index') }}"
                       class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-car-front me-2"></i> My Vehicles
                    </a>

                    <a href="{{ route('student.vehicles.create') }}"
                       class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle me-2"></i> Register New Vehicle
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Important Notes</h5>
                    <ul class="text-muted mb-0">
                        <li>Approved vehicles cannot be edited or deleted</li>
                        <li>Rejected vehicles must be re-registered</li>
                        <li>Ensure uploaded grant is clear and valid</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
