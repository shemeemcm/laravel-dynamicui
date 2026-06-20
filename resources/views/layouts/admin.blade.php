<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'Dynamic Blocks') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #0f172a;
            color: #94a3b8;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
            border-radius: 0.375rem;
            margin: 0.2rem 0.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        .navbar-admin {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
            margin-left: 260px;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.02);
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -260px;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .navbar-admin {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-ui-checks-grid text-primary"></i>
            <span>AdminPanel</span>
        </div>
        <div class="py-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.blocks.index') }}" class="nav-link {{ request()->is('admin/blocks*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> UI Blocks
            </a>
            <a href="{{ url('/') }}" class="nav-link" target="_blank">
                <i class="bi bi-arrow-up-right-circle"></i> Live Site
            </a>
        </div>
    </div>

    <!-- Top Navbar -->
    <nav class="navbar navbar-admin d-flex justify-content-between align-items-center">
        <button class="btn btn-outline-secondary d-lg-none" type="button" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="d-none d-lg-block">
            <h5 class="m-0 fw-bold">Welcome back, Admin</h5>
        </div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle fw-semibold rounded-pill px-3" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-2">
                            <i class="bi bi-box-arrow-right"></i> Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        // CSRF Token setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Toggle Sidebar in Mobile
        $('#sidebarToggle').on('click', function() {
            $('.sidebar').toggleClass('show');
        });
    </script>
    @yield('scripts')
</body>
</html>
