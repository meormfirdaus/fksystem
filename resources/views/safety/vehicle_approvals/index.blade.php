@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Vehicle Approval</h3>
            <p class="text-muted mb-0">
                Review and approve student vehicle registrations
            </p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body table-responsive">

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
                        <th>Plate No</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Grant</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($vehicles as $vehicle)
                    <tr>
                        {{-- STUDENT --}}
                        <td>
                            <div class="fw-semibold">{{ $vehicle->user->name }}</div>
                            <small class="text-muted">{{ $vehicle->user->email }}</small>
                        </td>

                        {{-- PLATE --}}
                        <td class="fw-bold">
                            {{ $vehicle->plate_no }}
                        </td>

                        {{-- TYPE --}}
                        <td class="text-capitalize">
                            {{ $vehicle->type }}
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($vehicle->approval_status === 'approved')
                                <span class="badge bg-success bg-opacity-10 text-success">
                                    Approved
                                </span>
                            @elseif($vehicle->approval_status === 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    Pending
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                    Rejected
                                </span>
                            @endif
                        </td>

                        {{-- GRANT --}}
                        <td>
                            <button class="btn btn-outline-primary btn-sm"
                                    onclick="openGrantModal(
                                        '{{ asset('storage/'.$vehicle->grant_path) }}',
                                        '{{ $vehicle->plate_no }}'
                                    )">
                                <i class="bi bi-file-earmark-text"></i> View
                            </button>
                        </td>

                        {{-- ACTION --}}
                        <td>
                            @if($vehicle->approval_status === 'pending')
                                <div class="d-flex gap-2">
                                    {{-- APPROVE --}}
                                    <form method="POST"
                                          action="{{ route('safety.vehicle-approvals.approve', $vehicle) }}">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>

                                    {{-- REJECT --}}
                                    <button class="btn btn-danger btn-sm"
                                            onclick="openRejectModal('{{ route('safety.vehicle-approvals.reject', $vehicle) }}')">
                                        <i class="bi bi-x-circle"></i> Reject
                                    </button>
                                </div>
                            @else
                                <span class="text-muted small">No action</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No vehicle submissions found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- ================== GRANT PREVIEW MODAL ================== --}}
<div class="modal fade" id="grantModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">

            <div class="modal-header">
                <h5 class="fw-bold mb-0">
                    Vehicle Grant – <span id="grantPlate"></span>
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="grantPreview"
                     class="border rounded-3 p-3 text-center"
                     style="min-height:400px">
                    Loading...
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================== REJECT MODAL ================== --}}
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">

            <form method="POST" id="rejectForm">
                @csrf

                <div class="modal-header">
                    <h5 class="fw-bold text-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                        Reject Vehicle
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label fw-semibold">
                        Rejection Note
                    </label>
                    <textarea name="note"
                              class="form-control"
                              rows="4"
                              required
                              placeholder="State reason for rejection..."></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-danger">
                        Reject
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- ================== JS ================== --}}
<script>
function openGrantModal(url, plate) {
    const preview = document.getElementById('grantPreview');
    const plateEl = document.getElementById('grantPlate');

    plateEl.innerText = plate;
    preview.innerHTML = '';

    if (url.endsWith('.pdf')) {
        preview.innerHTML = `
            <iframe src="${url}"
                    style="width:100%;height:450px;border:none"></iframe>
        `;
    } else {
        preview.innerHTML = `
            <img src="${url}"
                 class="img-fluid rounded"
                 style="max-height:450px">
        `;
    }

    new bootstrap.Modal(document.getElementById('grantModal')).show();
}

function openRejectModal(action) {
    const form = document.getElementById('rejectForm');
    form.action = action;

    new bootstrap.Modal(document.getElementById('rejectModal')).show();
}
</script>
@endsection
