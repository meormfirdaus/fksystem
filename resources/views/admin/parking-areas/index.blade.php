@extends('layouts.app-shell')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h4>Parking Areas</h4>
    <a href="{{ route('admin.parking-areas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Area
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Booking</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($areas as $area)
                <tr>
                    <td>{{ $area->code }}</td>
                    <td>{{ $area->name }}</td>
                    <td class="text-capitalize">{{ $area->category }}</td>
                    <td>
                        {{ $area->requires_booking ? 'Required' : 'Not Required' }}
                    </td>
                    <td>
                        <span class="badge bg-{{ $area->status === 'open' ? 'success' : 'danger' }}">
                            {{ ucfirst($area->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.parking-areas.edit',$area) }}"
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>
                
                        <form` method="POST"
                              action="{{ route('admin.parking-areas.destroy',$area) }}"
                              class="d-inline">
                            <button
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteAreaModal"
                                data-id="{{ $area->id }}"
                                data-name="{{ $area->name }}"
                                data-code="{{ $area->code }}"
                            >
                                Delete
                            </button>

                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No parking areas found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAreaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle"></i> Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this parking area?</p>

                <div class="alert alert-warning">
                    <strong id="delete-area-name"></strong><br>
                    <small id="delete-area-code"></small>
                </div>

                <p class="text-muted mb-0">
                    This action <strong>cannot be undone</strong>.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <form id="deleteAreaForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteAreaModal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id   = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const code = button.getAttribute('data-code');

        document.getElementById('delete-area-name').innerText = name;
        document.getElementById('delete-area-code').innerText = 'Code: ' + code;

        const form = document.getElementById('deleteAreaForm');
        form.action = `/admin/parking-areas/${id}`;
    });
});
</script>

@endsection

