@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">Add Parking Area</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.parking-areas.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Area Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Area Code</label>
                <input type="text" name="code" class="form-control" required>
                <small class="text-muted">Example: A1, B1</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="">-- Select --</option>
                    <option value="staff">Staff</option>
                    <option value="student">Student</option>
                    <option value="general">General</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="requires_booking">
                <label class="form-check-label">
                    Requires Booking
                </label>
            </div>

            <button class="btn btn-primary">
                Save
            </button>
            <a href="{{ route('admin.parking-areas.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>
    </div>
</div>
@endsection
