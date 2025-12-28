@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    <h2 class="fw-bold mb-4">My Profile</h2>

    <div class="row g-4">

        {{-- ================= PROFILE OVERVIEW ================= --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">

                <div class="text-center">
                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:110px;height:110px">
                        <i class="bi bi-person fs-1 text-secondary"></i>
                    </div>

                    <h4 class="fw-bold mb-1">{{ auth()->user()->name }}</h4>

                    <span class="badge bg-primary bg-opacity-10 text-primary text-capitalize px-3 py-2">
                        {{ auth()->user()->role }}
                    </span>

                    <div class="mt-3 text-muted small">
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between small">
                    <span class="text-muted">Account Status</span>
                    <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                </div>

                <div class="d-flex justify-content-between small mt-2">
                    <span class="text-muted">Member Since</span>
                    <span>{{ auth()->user()->created_at->format('M Y') }}</span>
                </div>

            </div>
        </div>

        {{-- ================= PROFILE SETTINGS ================= --}}
        <div class="col-lg-8">

            {{-- PERSONAL INFO --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                    Personal Information
                </h5>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required>
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>

            {{-- SECURITY --}}
            <div class="card border-0 shadow-sm rounded-4 p-4">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-shield-lock-fill me-2 text-danger"></i>
                    Security
                </h5>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-outline-danger px-4">
                            <i class="bi bi-key me-2"></i> Update Password
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
