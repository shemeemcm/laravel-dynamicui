<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dynamic Blocks') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }

        .hover-lift {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.075) !important;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3">
            <div class="container">
                <a class="navbar-brand text-primary fs-3" href="{{ url('/') }}">
                    <i class="bi bi-ui-checks-grid me-2"></i>DynamicUI
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center gap-2 mt-3 mt-lg-0">
                       
                        
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary px-4 rounded-pill fw-semibold shadow-sm">
                                            <i class="bi bi-speedometer2 me-1"></i> Admin Panel
                                        </a>
                                    @else
                                        <span class="me-2 text-muted fw-medium">Welcome, {{ Auth::user()->name }}</span>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill fw-semibold">
                                                Log Out
                                            </button>
                                        </form>
                                    @endif
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 rounded-pill fw-semibold me-2">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill fw-semibold shadow-sm">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-top py-5 mt-5">
        <div class="container text-center">
            <p class="text-secondary mb-2">&copy; {{ date('Y') }} DynamicUI. All rights reserved.</p>
            <p class="text-muted small">Generated entirely from database records according to display order.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
