@extends('layouts.app-shell')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">My Vehicles</h2>

    <div class="d-flex gap-2">
        <select class="form-select" style="width:180px" onchange="filterStatus(this.value)">
            <option value="all">All Vehicles</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>

        <a href="{{ route('student.vehicles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Register Vehicle
        </a>
    </div>
</div>

{{-- VEHICLE GRID --}}
<div class="row g-4" id="vehicleGrid">

@forelse($vehicles as $v)
<div class="col-md-6 col-lg-4 vehicle-card"
     data-status="{{ $v->approval_status }}">

    <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-body p-4">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="fw-bold mb-1">{{ $v->plate_no }}</h5>
                    <small class="text-muted text-capitalize">{{ $v->type }}</small>
                </div>

                @if($v->approval_status === 'approved')
                    <span class="badge bg-success bg-opacity-10 text-success">
                        Approved
                    </span>
                @elseif($v->approval_status === 'pending')
                    <span class="badge bg-warning bg-opacity-10 text-warning">
                        Pending
                    </span>
                @else
                    <span class="badge bg-danger bg-opacity-10 text-danger">
                        Rejected
                    </span>
                @endif
            </div>

            {{-- PROGRESS --}}
            <div class="mb-3">
                <div class="progress" style="height:6px">
                    <div class="progress-bar
                        {{ $v->approval_status === 'approved' ? 'bg-success' :
                           ($v->approval_status === 'pending' ? 'bg-warning' : 'bg-danger') }}"
                        style="width:
                        {{ $v->approval_status === 'approved' ? '100%' :
                           ($v->approval_status === 'pending' ? '50%' : '100%') }}">
                    </div>
                </div>

                <small class="text-muted">
                    {{ ucfirst($v->approval_status) }} status
                </small>

                @if($v->approval_status === 'pending')
                    <div class="small text-warning mt-1">
                        ⏳ Awaiting safety approval
                    </div>
                @elseif($v->approval_status === 'rejected')
                    <div class="small text-danger mt-1">
                        ❌ Rejected. Please re-register with correct document.
                    </div>
                @endif
            </div>

            <div class="text-muted small mb-3">
                Registered on {{ $v->created_at->format('d M Y') }}
            </div>

            {{-- ACTIONS --}}
            <div class="d-flex gap-2">

                {{-- VIEW --}}
                <button class="btn btn-outline-primary btn-sm w-100"
                        onclick="openViewModal(
                            '{{ $v->plate_no }}',
                            '{{ ucfirst($v->type) }}',
                            '{{ ucfirst($v->approval_status) }}',
                            '{{ $v->created_at->format('d M Y') }}'
                        )">
                    <i class="bi bi-eye me-1"></i> View
                </button>

                {{-- DELETE --}}
                @if($v->approval_status !== 'approved')
                    <button class="btn btn-outline-danger btn-sm w-100"
                            onclick="openDeleteModal(
                                '{{ route('student.vehicles.destroy', $v) }}',
                                '{{ $v->plate_no }}'
                            )">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                @else
                    <button class="btn btn-outline-secondary btn-sm w-100" disabled>
                        <i class="bi bi-lock"></i> Locked
                    </button>
                @endif

            </div>

        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
        <i class="bi bi-car-front fs-1 text-muted mb-3"></i>
        <h5 class="fw-bold">No Vehicles Registered</h5>
        <p class="text-muted">Register your first vehicle to continue.</p>
        <a href="{{ route('student.vehicles.create') }}" class="btn btn-primary">
            Register Vehicle
        </a>
    </div>
</div>
@endforelse

</div>

{{-- VIEW MODAL --}}
<div class="modal fade" id="viewVehicleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header">
                <h5 class="fw-bold">Vehicle Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p><strong>Plate Number:</strong> <span id="vmPlate"></span></p>
                <p><strong>Type:</strong> <span id="vmType"></span></p>
                <p><strong>Status:</strong> <span id="vmStatus"></span></p>
                <p><strong>Registered:</strong> <span id="vmDate"></span></p>
            </div>
        </div>
    </div>
</div>
{{-- EDIT --}}
    @if($v->approval_status !== 'approved')
        <a href="{{ route('student.vehicles.edit', $v->id) }}"
           class="btn btn-outline-warning btn-sm w-100">
            <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
    @else
        <button class="btn btn-outline-secondary btn-sm w-100" disabled>
            <i class="bi bi-lock"></i> Locked
        </button>
    @endif

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteVehicleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header">
                <h5 class="fw-bold text-danger">Confirm Deletion</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete vehicle
                <strong id="deletePlate"></strong>?
                <p class="text-muted small mt-2">
                    This action cannot be undone.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
function filterStatus(status) {
    document.querySelectorAll('.vehicle-card').forEach(card => {
        card.style.display =
            (status === 'all' || card.dataset.status === status)
            ? 'block'
            : 'none';
    });
}

function openViewModal(plate, type, status, date) {
    document.getElementById('vmPlate').innerText = plate;
    document.getElementById('vmType').innerText = type;
    document.getElementById('vmStatus').innerText = status;
    document.getElementById('vmDate').innerText = date;

    new bootstrap.Modal(
        document.getElementById('viewVehicleModal')
    ).show();
}

function openDeleteModal(url, plate) {
    document.getElementById('deletePlate').innerText = plate;
    document.getElementById('deleteForm').action = url;

    new bootstrap.Modal(
        document.getElementById('deleteVehicleModal')
    ).show();
}
</script>
@endsection
