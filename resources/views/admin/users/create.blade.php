@extends('layouts.app-shell')

@section('content')
<div class="container-fluid d-flex justify-content-center">

    <div class="col-xl-9 col-lg-10">

        {{-- PAGE TITLE --}}
        <div class="mb-4">
            <h2 class="fw-bold">Create New User</h2>
            <p class="text-muted mb-0">
                Follow the steps below to register a new system user
            </p>
        </div>

        {{-- STEP INDICATOR --}}
       

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 p-4">

            {{-- HEADER --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                    <i class="bi bi-person-plus fs-4 text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">User Details</h5>
                    <small class="text-muted">
                        Required information for account creation
                    </small>
                </div>
            </div>

            <hr>

            {{-- FORM --}}
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

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
                               placeholder="e.g. Ali Bin Abu"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="e.g. ali@student.edu.my"
                               required>
                    </div>
                </div>

                {{-- ROLE SETUP --}}
                <h6 class="fw-bold mb-3">
                    <i class="bi bi-shield-check me-2 text-warning"></i>
                    Role Setup
                </h6>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">User Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Select Role --</option>
                            <option value="student">Student</option>
                            <option value="safety">Staff (Safety)</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-warning mb-0">
                            <small>
                                <strong>Note:</strong> User role determines system access level.
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
                        <label class="form-label fw-semibold">Temporary Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Minimum 6 characters"
                               required>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-info mb-0">
                            <small>
                                The user is advised to change the password upon first login.
                            </small>
                        </div>
                    </div>
                </div>

                {{-- ACTION BAR --}}
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Cancel
                    </a>

                    <button class="btn btn-primary px-4">
                        <i class="bi bi-check-circle me-2"></i> Create User
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
