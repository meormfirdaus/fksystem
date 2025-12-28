@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Admin Dashboard</h2>
        <p class="text-muted mb-0">
            Overview of FKPark system management
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-4 mb-4">

        {{-- USERS --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Users</div>
                        <h3 class="fw-bold mb-0">{{ $users }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- AREAS --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-success bg-opacity-10 text-success">
                        <i class="bi bi-geo-alt fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Parking Areas</div>
                        <h3 class="fw-bold mb-0">{{ $areas }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- SPACES --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-info bg-opacity-10 text-info">
                        <i class="bi bi-grid-3x3-gap fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Spaces</div>
                        <h3 class="fw-bold mb-0">{{ $spaces }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- AVAILABLE --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Available Spaces</div>
                        <h3 class="fw-bold mb-0">{{ $available }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="row g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Quick Management</h5>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-outline-primary w-100 mb-2">
                        <i class="bi bi-people me-2"></i> Manage Users
                    </a>

                    <a href="{{ route('admin.parking-areas.index') }}"
                       class="btn btn-outline-success w-100 mb-2">
                        <i class="bi bi-geo-alt me-2"></i> Manage Parking Areas
                    </a>

                    <a href="{{ route('admin.spaces.index') }}"
                       class="btn btn-outline-info w-100">
                        <i class="bi bi-grid-3x3-gap me-2"></i> Manage Parking Spaces
                    </a>
                </div>
            </div>
        </div>

        {{-- SYSTEM INFO --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">System Summary</h5>

                    <ul class="text-muted mb-0">
                        <li>Total registered users in FKPark system</li>
                        <li>Parking areas and spaces are centrally managed</li>
                        <li>Availability updates in real-time</li>
                        <li>QR code integration for each parking space</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- SMALL STYLE --}}
<style>
.icon-box {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection
