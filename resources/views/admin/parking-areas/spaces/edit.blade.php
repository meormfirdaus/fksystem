@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">
    Edit Parking Space – {{ $parking_space->space_no }}
</h4>

<form method="POST"
      action="{{ route('admin.parking-areas.spaces.update', [$parking_area, $parking_space]) }}"
      class="card shadow-sm p-4">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Space Number</label>
        <input type="text"
               name="space_no"
               value="{{ $parking_space->space_no }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="available" @selected($parking_space->status === 'available')>
                Available
            </option>
            <option value="occupied" @selected($parking_space->status === 'occupied')>
                Occupied
            </option>
            <option value="disabled" @selected($parking_space->status === 'disabled')>
                Disabled
            </option>
        </select>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.parking-areas.spaces.index', $parking_area) }}"
           class="btn btn-secondary">
            Cancel
        </a>

        <button class="btn btn-primary">
            Update
        </button>
    </div>
</form>
@endsection
