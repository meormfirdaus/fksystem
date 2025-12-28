<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>FKPark</title>

<link rel="icon" type="image/png" href="{{ asset('images/kereta.png') }}">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* ================= BACKGROUND ================= */
    body {
        min-height: 100vh;
        background:
            linear-gradient(
                rgba(15, 23, 42, 0.55),
                rgba(15, 23, 42, 0.55)
            ),
            url('{{ asset('images/fk-aerialview.jpg') }}')
            no-repeat center center fixed;
        background-size: cover;

        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', system-ui, sans-serif;
    }

    /* ================= CARD ================= */
    .auth-shell {
        max-width: 1200px;
        width: 100%;
        background: rgba(255,255,255,0.94);
        backdrop-filter: blur(16px);
        border-radius: 32px;
        box-shadow: 0 60px 140px rgba(0,0,0,0.45);
        overflow: hidden;
        animation: rise .6s ease;
    }

    @keyframes rise {
        from { opacity:0; transform: translateY(30px); }
        to { opacity:1; transform: translateY(0); }
    }

    /* ================= LEFT ================= */
    .auth-left {
        padding: 72px;
    }

    .brand-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .brand-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(37,99,235,.12);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-title {
        font-weight: 800;
        font-size: 30px;
        margin-bottom: 6px;
    }

    .auth-subtitle {
        color: #64748b;
        margin-bottom: 36px;
        max-width: 420px;
    }

    /* ================= FORM ================= */
    .form-control {
        height: 52px;
        border-radius: 14px;
        background: #f8fafc;
        border: none;
        font-size: 15px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.15rem rgba(37,99,235,.18);
        background: #ffffff;
    }

    .btn-primary {
        height: 52px;
        border-radius: 14px;
        font-weight: 600;
        background: linear-gradient(135deg,#2563eb,#1e40af);
        border: none;
    }

    .btn-primary:hover {
        opacity: .96;
    }

    /* ================= LINKS ================= */
    .soft-link {
        font-size: 14px;
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    .soft-link:hover {
        text-decoration: underline;
    }

    .back-link {
        font-size: 13px;
        color: #64748b;
        text-decoration: none;
    }

    .back-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    /* ================= RIGHT ================= */
    .auth-right {
        background: linear-gradient(180deg,#eaf2ff,#ffffff);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
    }

    .auth-illustration {
        max-width: 100%;
        opacity: .95;
    }

    /* ================= MOBILE ================= */
    @media (max-width: 992px) {
        .auth-right { display:none; }
        .auth-left { padding:48px; }
    }
</style>
</head>

<body>

<div class="auth-shell row g-0">

    {{-- LEFT --}}
    <div class="col-lg-6 auth-left">


        {{-- FORM SLOT --}}
        {{ $slot }}

        {{-- REGISTER --}}
        <div class="text-center mt-4 small">
            <span class="text-muted">New here?</span>
            <a href="{{ route('register') }}" class="soft-link fw-semibold">
                Create an account
            </a>
        </div>

        {{-- BACK --}}
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="back-link">
                ← Explore parking availability without login
            </a>
        </div>

    </div>

        {{-- RIGHT --}}
        <div class="col-lg-6 auth-right">
            <img
                src="{{ asset('images/parking-right.jpg') }}"
                class="auth-illustration"
                alt="Parking Illustration"
            >
        </div>

</div>

</body>
</html>
