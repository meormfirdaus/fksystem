<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Parking Availability</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

{{-- TOP BAR (GUEST ONLY) --}}
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <span class="navbar-brand fw-bold text-primary">
            FKPark
        </span>

        <div>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                Login
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm ms-2">
                    Register
                </a>
            @endif
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<div class="container py-4">
    <h4 class="mb-4">Daily Parking Availability</h4>

    <div class="row g-3">
        @forelse($areas as $area)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold">
                            {{ $area->name }} ({{ $area->code }})
                        </h6>

                        <p class="mb-1 text-capitalize text-muted">
                            {{ $area->category }}
                        </p>

                        <p class="mb-2">
                            Available:
                            <strong>
                                {{ $area->available_spaces }} / {{ $area->total_spaces }}
                            </strong>
                        </p>

                        <span class="badge bg-{{ $area->status === 'open' ? 'success' : 'danger' }}">
                            {{ strtoupper($area->status) }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    No parking areas available
                </div>
            </div>
    @endforelse
</div>