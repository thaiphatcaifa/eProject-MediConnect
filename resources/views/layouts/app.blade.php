<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediConnect - Healthcare Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-dark: #0f4c81; /* Màu xanh dương đậm chuẩn y tế */
            --primary-light: #e6f0fa;
            --bg-gray: #f4f7f6;
        }
        body { background-color: var(--bg-gray); font-family: 'Segoe UI', system-ui, sans-serif; }
        .text-primary-dark { color: var(--primary-dark) !important; }
        .bg-primary-dark { background-color: var(--primary-dark) !important; color: white; }
        .btn-primary-dark { background-color: var(--primary-dark); color: white; border: none; border-radius: 8px; font-weight: 500; transition: 0.3s; }
        .btn-primary-dark:hover { background-color: #0b3861; color: white; transform: translateY(-1px); }
        .card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); overflow: hidden; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 15px; border: 1px solid #dee2e6; }
        .icon-thin { font-size: 1.2rem; font-weight: 300; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand text-primary-dark fw-bold fs-4" href="{{ url('/') }}">
                    <i class="bi bi-heart-pulse icon-thin"></i> MediConnect
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Đăng ký</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-primary-dark" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    @if(Auth::user()->role == 2)
                                        <a class="dropdown-item" href="{{ route('doctor.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard Bác sĩ</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('patient.index') }}"><i class="bi bi-calendar2-plus"></i> Đặt Lịch Khám</a>
                                    @endif
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>