@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">Edit Parking Area</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.parking-areas.update',$parking_area) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Area Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ $parking_area->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="staff" @selected($parking_area->category=='staff')>Staff</option>
                    <option value="student" @selected($parking_area->category=='student')>Student</option>
                    <option value="general" @selected($parking_area->category=='general')>General</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox"
                       name="requires_booking"
                       @checked($parking_area->requires_booking)>
                <label class="form-check-label">
                    Requires Booking
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="open" @selected($parking_area->status=='open')>Open</option>
                    <option value="closed" @selected($parking_area->status=='closed')>Closed</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Closed Reason</label>
                <input type="text" name="closed_reason"
                       value="{{ $parking_area->closed_reason }}"
                       class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.parking-areas.index') }}" class="btn btn-secondary">
                Back
            </a>
        </form>
    </div>
</div>
@endsection
