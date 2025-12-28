<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parking Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-sm" style="max-width: 420px;">
    <div class="card-body text-center">

        <h4 class="mb-2">
            {{ $space->parkingArea->name }}
        </h4>

        <p class="text-muted mb-3">
            Space No: <strong>{{ $space->space_no }}</strong>
        </p>

        <span class="badge fs-6
            bg-{{ $space->status === 'available' ? 'success' : 'danger' }}">
            {{ strtoupper($space->status) }}
        </span>

        <hr>

        <small class="text-muted">
            FKPark – Parking Management System
        </small>

    </div>
</div>

</body>
</html>
