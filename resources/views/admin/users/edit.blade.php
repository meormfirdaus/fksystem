@extends('layouts.app-shell')

@section('content')
<div class="container-fluid d-flex justify-content-center">

    <div class="col-xl-9 col-lg-10">

        {{-- PAGE TITLE --}}
        <div class="mb-4">
            <h2 class="fw-bold">Edit User</h2>
            <p class="text-muted mb-0">
                Update user details and manage account access
            </p>
        </div>

        {{-- STEP INDICATOR --}}
        

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 p-4">

            {{-- USER HEADER --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                     style="width:56px;height:56px">
                    <i class="bi bi-person fs-4 text-secondary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>
            </div>

            <hr>

            {{-- FORM --}}
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                {{-- ACCOUNT INFO --}}
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                    Account Information
                </h6>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $user->name }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ $user->email }}"
                               required>
                    </div>
                </div>

                {{-- ROLE --}}
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-shield-check me-2 text-warning"></i>
                    Role & Access
                </h6>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">User Role</label>
                        <select name="role" class="form-select">
                            <option value="student" @selected($user->role=='student')>Student</option>
                            <option value="safety" @selected($user->role=='safety')>Staff (Safety)</option>
                            <option value="admin" @selected($user->role=='admin')>Administrator</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-warning mb-0">
                            <small>
                                Changing user role will affect system permissions immediately.
                            </small>
                        </div>
                    </div>
                </div>

                {{-- SECURITY --}}
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-lock-fill me-2 text-danger"></i>
                    Security
                </h6>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">New Password (Optional)</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Leave blank to keep current password">
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-info mb-0">
                            <small>
                                Password will only be updated if a new value is provided.
                            </small>
                        </div>
                    </div>
                </div>

                {{-- ACTION BAR --}}
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Back
                    </a>

                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save me-2"></i> Save Changes
                    </button>
                </div>

            </form>
        </div>

        {{-- DANGER ZONE --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-4 border-start border-4 border-danger">
            <h6 class="fw-bold text-danger mb-2">
                <i class="bi bi-exclamation-triangle me-2"></i> Danger Zone
            </h6>
            <p class="text-muted mb-3">
                Deleting this user will permanently remove their access and data.
            </p>

            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                @csrf
                @method('DELETE')

                <button type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteUserModal">
                    <i class="bi bi-trash me-2"></i> Delete User
                </button>

            </form>
        </div>

    </div>
</div>

{{-- DELETE USER MODAL --}}
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            {{-- HEADER --}}
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <p class="mb-2">
                    Are you sure you want to delete this user?
                </p>
                <div class="alert alert-warning mb-0">
                    <strong>{{ $user->name }}</strong>  
                    <br>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>
                <small class="text-muted d-block mt-3">
                    This action <strong>cannot be undone</strong>.
                </small>
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0">
                <button type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i> Delete Permanently
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
