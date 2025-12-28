@extends('layouts.app-shell')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>All Parking Spaces</h4>

    <a href="{{ route('admin.spaces.create') }}"
       class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Add Space
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Area</th>
                    <th>Space No</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($spaces as $space)
                <tr>
                    <td>{{ $space->parkingArea->name ?? '-' }}</td>
                    <td>{{ $space->space_no }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $space->status === 'available' ? 'success' :
                            ($space->status === 'occupied' ? 'warning' : 'secondary')
                        }}">
                            {{ ucfirst($space->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.spaces.edit', $space) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="{{ $space->id }}"
                            data-name="{{ $space->space_no }}"
                            data-area="{{ $space->parkingArea->name ?? '-' }}"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No parking spaces found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title text-danger">
            Confirm Deletion
        </h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-warning">
            <strong id="delete-space-name"></strong><br>
            <small id="delete-space-area"></small>
        </div>
        <p>This action <b>cannot be undone</b>.</p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('deleteModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;

        const id   = btn.dataset.id;
        const name = btn.dataset.name;
        const area = btn.dataset.area;

        document.getElementById('delete-space-name').innerText = name;
        document.getElementById('delete-space-area').innerText = 'Area: ' + area;

        document.getElementById('deleteForm').action =
            `/admin/spaces/${id}`;
    });
});
</script>
@endsection
