@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">
    Add Parking Space – {{ $parking_area->name }}
</h4>

<form method="POST"
      action="{{ route('admin.parking-areas.spaces.store', $parking_area) }}"
      class="card shadow-sm p-4">

    @csrf

    <div class="mb-3">
        <label class="form-label">Space Number</label>
        <input type="text"
               name="space_no"
               class="form-control"
               placeholder="e.g A-01"
               required>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.parking-areas.spaces.index', $parking_area) }}"
           class="btn btn-secondary">
            Cancel
        </a>

        <button class="btn btn-primary">
            Save
        </button>
    </div>
</form>
@endsection
