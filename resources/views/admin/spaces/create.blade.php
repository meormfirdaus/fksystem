@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">Add Parking Space</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.spaces.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Parking Area</label>
                <select name="parking_area_id" class="form-select" required>
                    <option value="">-- Select Area --</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Space No</label>
                <input type="text"
                       name="space_no"
                       class="form-control"
                       placeholder="e.g A-01"
                       required>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.spaces.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
                <button class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
