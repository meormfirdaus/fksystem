@extends('layouts.app-shell')

@section('content')
<h4 class="mb-4">Admin Dashboard</h4>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Users</h6>
                <h3>{{ $users }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Parking Areas</h6>
                <h3>{{ $areas }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Spaces</h6>
                <h3>{{ $spaces }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Available</h6>
                <h3>{{ $available }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
