<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FKPark | Faculty of Computing UMPSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: "Segoe UI", system-ui, sans-serif;
            background: #f8fafc;
        }

        /* ===== HEADER ===== */
        .top-header {
            background: #0f172a;
            color: #fff;
            font-size: 14px;
        }

        /* ===== HERO ===== */
        .hero {
            background: linear-gradient(
                rgba(15,23,42,.75),
                rgba(15,23,42,.75)
            ),
            url('/images/fk-aerialview.jpg') center/cover no-repeat;
            color: #fff;
            padding: 110px 0;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 44px;
        }

        .hero p {
            max-width: 700px;
            color: #e5e7eb;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-weight: 700;
            margin-bottom: 6px;
        }

        .section-sub {
            color: #64748b;
        }

        /* ===== CARD ===== */
        .area-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            transition: .25s ease;
        }

        .area-card:hover {
            transform: translateY(-5px);
        }

        /* ===== FOOTER ===== */
        footer {
            background: #0f172a;
            color: #cbd5f5;
            font-size: 14px;
        }
    </style>
</head>

<body>
{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2">
            <i class="bi bi-car-front fs-4"></i> FKPark
        </a>

        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                Login
            </a>
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm ms-2">
                    Register
                </a>
            @endif
        </div>
    </div>
</nav>


{{-- HERO SECTION --}}
<section class="hero text-center">
    <div class="container">
        <h1 class="mb-3">
            Faculty of Computing <br>
            Parking Management System
        </h1>

        <p class="mx-auto mb-4">
            A centralized digital platform to monitor parking availability,
            manage parking areas and improve traffic flow within
            Faculty of Computing, UMPSA Pekan.
        </p>

        <a href="#availability" class="btn btn-primary btn-lg px-4">
            View Parking Availability
        </a>
    </div>
</section>

{{-- AVAILABILITY SECTION --}}
<section id="availability" class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h3 class="section-title">Daily Parking Availability</h3>
            <p class="section-sub">
                Live overview of parking spaces in Faculty of Computing
            </p>
        </div>

        <div class="row g-4">
            @forelse($areas as $area)
                <div class="col-md-4">
                    <div class="card area-card h-100">
                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="fw-bold mb-0">
                                    {{ $area->name }}
                                </h5>

                                <span class="badge bg-{{ $area->status === 'open' ? 'success' : 'danger' }}">
                                    {{ strtoupper($area->status) }}
                                </span>
                            </div>

                            <small class="text-muted">
                                Code: {{ $area->code }} • {{ ucfirst($area->category) }}
                            </small>

                            <hr>

                            <p class="mb-1">
                                Available Spaces
                            </p>

                            <h4 class="fw-bold">
                                {{ $area->available_spaces }}
                                <small class="text-muted fs-6">
                                    / {{ $area->total_spaces }}
                                </small>
                            </h4>

                            <div class="progress" style="height:6px">
                                <div class="progress-bar bg-success"
                                     style="width:
                                     {{ $area->total_spaces > 0
                                        ? ($area->available_spaces / $area->total_spaces) * 100
                                        : 0 }}%">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No parking information available today
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>

{{-- FOOTER --}}
<footer class="py-4 text-center">
    <div class="container">
        <strong>FKPark</strong> © {{ date('Y') }} <br>
        Faculty of Computing, Universiti Malaysia Pahang Al-Sultan Abdullah
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
