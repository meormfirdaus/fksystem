@extends('layouts.app-shell')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">
        Parking Spaces – {{ $parking_area->name }}
    </h4>

    <div class="d-flex gap-2">
        {{-- FILTER --}}
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm w-auto">
                <option value="" {{ request('status') === null || request('status') === '' ? 'selected' : '' }}>
                    All
                </option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>
                    Available
                </option>
                <option value="occupied" {{ request('status') === 'occupied' ? 'selected' : '' }}>
                    Occupied
                </option>
                <option value="disabled" {{ request('status') === 'disabled' ? 'selected' : '' }}>
                    Disabled
                </option>
            </select>
            <button class="btn btn-outline-primary btn-sm">Filter</button>
        </form>

        <a href="{{ route('admin.parking-areas.spaces.create', $parking_area) }}"
           class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Space
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Space No</th>
                    <th>Status</th>
                    <th>QR Preview</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($spaces as $space)
                <tr>
                    <td class="fw-semibold">{{ $space->space_no }}</td>

                    <td>
                        <span class="badge
                            bg-{{
                                $space->status === 'available' ? 'success' :
                                ($space->status === 'occupied' ? 'warning' : 'secondary')
                            }}">
                            {{ ucfirst($space->status) }}
                        </span>
                    </td>

                    <td>
                        {{-- QR PREVIEW (gambar kecil) --}}
                        <img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(route('parking-space.public.show', $space->qr_token)) }}"
                            width="60"
                            class="border rounded bg-white p-1"
                        >

                    </td>

                    <td>
                        <a href="{{ route('admin.parking-areas.spaces.edit', [$parking_area, $space]) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $space->id }}">
                            Delete
                        </button>

                        {{-- ✅ CONFIRM DELETE MODAL (MESTI DALAM LOOP) --}}
                        <div class="modal fade" id="deleteModal{{ $space->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger">
                                            Confirm Deletion
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p class="mb-3">Are you sure you want to delete this space?</p>

                                        <div class="alert alert-warning mb-0">
                                            <strong>Space:</strong> {{ $space->space_no }} <br>
                                            This action <b>cannot be undone</b>.
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <form method="POST"
                                              action="{{ route('admin.parking-areas.spaces.destroy', [$parking_area, $space]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ✅ END MODAL --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        No parking spaces found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
