@extends('layouts.app-shell')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Edit Vehicle</h2>
            <p class="text-muted mb-0">Update vehicle information</p>
        </div>

        <a href="{{ route('student.vehicles.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 col-lg-7">
        <div class="card-body p-4 p-md-5">

            <form method="POST"
                  action="{{ route('student.vehicles.update', $vehicle) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- PLATE (LOCKED) --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Plate Number</label>
                    <input type="text" class="form-control" value="{{ $vehicle->plate_no }}" disabled>
                </div>

                {{-- TYPE --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Vehicle Type</label>
                    <select name="type" class="form-select">
                        <option value="car" {{ $vehicle->type==='car'?'selected':'' }}>🚗 Car</option>
                        <option value="motorcycle" {{ $vehicle->type==='motorcycle'?'selected':'' }}>🏍 Motorcycle</option>
                    </select>
                </div>

                {{-- BRAND --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Brand</label>
                    <input type="text" name="brand" class="form-control" value="{{ $vehicle->brand }}">
                </div>

                {{-- MODEL --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Model</label>
                    <input type="text" name="model" class="form-control" value="{{ $vehicle->model }}">
                </div>

                {{-- GRANT --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Replace Grant (optional)</label>
                    <input type="file" name="grant" class="form-control">
                    <small class="text-muted">
                        Uploading new grant will reset approval to <b>pending</b>
                    </small>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('student.vehicles.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button class="btn btn-primary px-4">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
