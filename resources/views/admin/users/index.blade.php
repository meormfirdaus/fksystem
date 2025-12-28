@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    {{-- PAGE TITLE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">User Management</h2>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Add User
        </a>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                        <i class="bi bi-people fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Users</div>
                        <div class="fs-4 fw-bold">{{ $users->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3">
                        <i class="bi bi-mortarboard fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Students</div>
                        <div class="fs-4 fw-bold">{{ $users->where('role','student')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                        <i class="bi bi-shield-check fs-4 text-warning"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Staff</div>
                        <div class="fs-4 fw-bold">{{ $users->where('role','safety')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- USER LIST --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Registered Users</h5>

            <form method="GET" class="d-flex align-items-center gap-2">
                <label class="small text-muted mb-0">Filter:</label>
                <select name="role"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()"
                        style="width:160px">
                    <option value="">All Users</option>
                    <option value="student" {{ request('role')=='student' ? 'selected' : '' }}>Student</option>
                    <option value="safety" {{ request('role')=='safety' ? 'selected' : '' }}>Staff</option>
                </select>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($users as $user)
                    <tr>
                        {{-- USER --}}
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                                     style="width:42px;height:42px">
                                    <i class="bi bi-person text-secondary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        </td>

                        {{-- ROLE --}}
                        <td>
                            @if($user->role === 'student')
                                <span class="badge bg-info bg-opacity-10 text-info">Student</span>
                            @elseif($user->role === 'safety')
                                <span class="badge bg-warning bg-opacity-10 text-warning">Staff</span>
                            @else
                                <span class="badge bg-primary bg-opacity-10 text-primary">Admin</span>
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                        </td>

                        {{-- ACTION --}}
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteUserModal{{ $user->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- DELETE MODAL --}}
                    <div class="modal fade"
                         id="deleteUserModal{{ $user->id }}"
                         tabindex="-1"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4">

                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold text-danger">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Confirm Deletion
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <p>Are you sure you want to delete this user?</p>

                                    <div class="alert alert-warning mb-0">
                                        <strong>{{ $user->name }}</strong><br>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>

                                    <small class="text-muted d-block mt-3">
                                        This action <strong>cannot be undone</strong>.
                                    </small>
                                </div>

                                <div class="modal-footer border-0">
                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">
                                        Cancel
                                    </button>

                                    <form method="POST"
                                          action="{{ route('admin.users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <i class="bi bi-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5">
                            No users found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

    

</div>
@endsection
