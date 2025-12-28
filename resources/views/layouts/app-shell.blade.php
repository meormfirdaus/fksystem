<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ParkSystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/kereta.png') }}">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* ================= TOPBAR ================= */
        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1001;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            height: calc(100vh - 64px);
            background: #020617;
            color: #cbd5e1;
            transition: width .3s ease;
            z-index: 1002;
            overflow: hidden;
        }

        /* ===== DEFAULT (ICON ONLY) ===== */
        .sidebar {
            width: 72px;
        }

        /* ===== EXPANDED ===== */
        .sidebar.expanded {
            width: 260px;
        }

        .sidebar .menu-title {
            font-size: 11px;
            letter-spacing: 1px;
            margin: 12px 16px;
            color: #64748b;
            white-space: nowrap;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 14px;
            margin: 6px 10px;
            border-radius: 10px;
            color: inherit;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .sidebar a i {
            font-size: 18px;
            min-width: 24px;
            text-align: center;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: #ffffff;
        }

        /* Hide text when collapsed */
        .sidebar:not(.expanded) span,
        .sidebar:not(.expanded) .menu-title {
            display: none;
        }

        /* Center icons when collapsed */
        .sidebar:not(.expanded) a {
            justify-content: center;
        }

        /* ================= CONTENT ================= */
        .content {
            padding: 24px;
            padding-top: 88px;
            transition: margin-left .3s ease;
            margin-left: 72px;
        }

        .content.expanded {
            margin-left: 260px;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }

            .sidebar.mobile-show {
                transform: translateX(0);
            }

            .content,
            .content.expanded {
                margin-left: 0;
            }
        }

        /* ================= OVERLAY ================= */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1000;
            display: none;
        }

        .overlay.show {
            display: block;
        }
        /* ================= icon user ================= */
        /* ===== Avatar Click Indicator ===== */
        .avatar-btn {
            border: 2px solid transparent;
            background: #f1f5f9;
            transition: all 0.2s ease;
        }

        .avatar-btn:hover {
            background: #e0f2fe;
            border-color: #38bdf8;
        }

        .avatar-btn i {
            color: #334155;
        }


    </style>
</head>
<body>

{{-- OVERLAY (MOBILE) --}}
<div id="overlay" class="overlay" onclick="toggleSidebar()"></div>

{{-- TOPBAR --}}
<div class="topbar">
    <button class="btn btn-light me-3" onclick="toggleSidebar()">
        <i class="bi bi-list fs-4"></i>
    </button>

    <strong class="text-primary d-flex align-items-center gap-2">
        <i class="bi bi-car-front"></i> ParkSystem
    </strong>

   <div class="ms-auto d-flex align-items-center gap-3">

        {{-- User Name (TEXT ONLY, NOT CLICKABLE) --}}
        <div class="text-end">
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
        </div>

        {{-- Avatar Icon (CLICKABLE) --}}
        <div class="dropdown">
            <button 
                class="btn p-0 border-0 bg-transparent d-flex align-items-center gap-1"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >
                <div 
                    class="rounded-circle d-flex align-items-center justify-content-center avatar-btn"
                    style="width:42px;height:42px"
                >
                    <i class="bi bi-person fs-5"></i>
                </div>
            </button>

            {{-- Dropdown Menu --}}
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li>
                    <a class="dropdown-item" href="/profile">
                        <i class="bi bi-pencil me-2"></i> Edit Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
</div>


</div>

{{-- SIDEBAR (ICON ONLY DEFAULT) --}}
{{-- SIDEBAR --}}
<aside id="sidebar" class="sidebar">

    <div class="menu-title">MAIN MENU</div>

    {{-- ================= ADMIN ================= --}}
    @if(auth()->user()->role === 'admin')

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i><span>Dashboard</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="bi bi-person"></i><span>Manage Profile</span>
        </a>

        <a href="{{ route('admin.users.index') }}"
           class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i><span>User Management</span>
        </a>

        <a href="{{ route('admin.parking-areas.index') }}"
           class="{{ request()->routeIs('admin.parking-areas.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i><span>Parking Areas</span>
        </a>

        <a href="{{ route('admin.spaces.index') }}"
            class="{{ request()->routeIs('admin.spaces.*') ? 'active' : '' }}">
             <i class="bi bi-grid"></i><span>Parking Spaces</span>
        </a>



    @endif


    {{-- ================= STUDENT ================= --}}
    @if(auth()->user()->role === 'student')

        <a href="{{ route('student.dashboard') }}"
           class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i><span>Dashboard</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="bi bi-person"></i><span>Manage Profile</span>
        </a>

        <a href="{{ route('student.vehicles.create') }}"
           class="{{ request()->routeIs('student.vehicles.create') ? 'active' : '' }}">
            <i class="bi bi-car-front"></i><span>Register Vehicle</span>
        </a>

        <a href="{{ route('student.vehicles.index') }}"
           class="{{ request()->routeIs('student.vehicles.index') ? 'active' : '' }}">
            <i class="bi bi-list"></i><span>My Vehicles</span>
        </a>

    @endif


    {{-- ================= SAFETY ================= --}}
    @if(auth()->user()->role === 'safety')

        <a href="{{ route('safety.dashboard') }}"
           class="{{ request()->routeIs('safety.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i><span>Dashboard</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="bi bi-person"></i><span>Manage Profile</span>
        </a>

        <a href="{{ route('safety.vehicles.index') }}"
           class="{{ request()->routeIs('safety.vehicles.*') ? 'active' : '' }}">
            <i class="bi bi-shield-check"></i><span>Approve Vehicle</span>
        </a>

    @endif


    {{-- ================= LOGOUT ================= --}}
    <form method="POST" action="{{ route('logout') }}" class="px-2 mt-4">
        @csrf
        <button class="btn btn-danger w-100">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </button>
    </form>

</aside>


{{-- CONTENT --}}
<main id="content" class="content">
    @yield('content')
</main>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const overlay = document.getElementById('overlay');

        if (window.innerWidth < 992) {
            sidebar.classList.toggle('mobile-show');
            overlay.classList.toggle('show');
        } else {
            sidebar.classList.toggle('expanded');
            content.classList.toggle('expanded');
        }
    }
</script>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-4" style="z-index: 1100">
        <div class="toast align-items-center text-bg-success border-0 show shadow-lg rounded-3">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                setTimeout(() => {
                    const toast = new bootstrap.Toast(toastEl);
                    toast.hide();
                }, 3500);
            }
        });
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>
