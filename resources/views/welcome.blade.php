@extends('layouts.app')
@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <i class="bi bi-heart-pulse text-primary-dark" style="font-size: 5rem;"></i>
            <h1 class="text-primary-dark fw-bold mt-3">MediConnect</h1>
            <p class="lead text-muted mb-5">Nền tảng C2C kết nối Bác sĩ và Bệnh nhân thông minh, nhanh chóng.</p>
            
            @auth
                @if(Auth::user()->role == 2)
                    <a href="{{ route('doctor.dashboard') }}" class="btn btn-primary-dark btn-lg px-5 py-3 shadow"><i class="bi bi-calendar-check icon-thin me-2"></i>Quản lý lịch khám</a>
                @else
                    <a href="{{ route('patient.index') }}" class="btn btn-primary-dark btn-lg px-5 py-3 shadow"><i class="bi bi-search icon-thin me-2"></i>Tìm Bác sĩ ngay</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary-dark btn-lg px-5 py-3 shadow me-2"><i class="bi bi-box-arrow-in-right icon-thin me-2"></i>Đăng Nhập</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-5 py-3"><i class="bi bi-person-plus icon-thin me-2"></i>Đăng Ký</a>
            @endauth

            <div class="card mt-5 bg-white text-start shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary-dark border-bottom pb-2"><i class="bi bi-diagram-3 icon-thin me-2"></i>Sitemap Hệ thống</h5>
                    <div class="row mt-3">
                        <div class="col-6 col-md-4">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-dot"></i><a href="{{ url('/') }}" class="text-decoration-none text-secondary">Trang chủ</a></li>
                                <li class="mb-2"><i class="bi bi-dot"></i><a href="{{ route('login') }}" class="text-decoration-none text-secondary">Đăng nhập</a></li>
                                <li class="mb-2"><i class="bi bi-dot"></i><a href="{{ route('register') }}" class="text-decoration-none text-secondary">Đăng ký</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <strong class="text-primary-dark">Khu vực Bệnh nhân</strong>
                            <ul class="list-unstyled mt-2">
                                <li class="mb-2"><i class="bi bi-dot"></i><a href="{{ route('patient.index') }}" class="text-decoration-none text-secondary">Tìm & Đặt lịch</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 mt-3 mt-md-0">
                            <strong class="text-primary-dark">Khu vực Bác sĩ</strong>
                            <ul class="list-unstyled mt-2">
                                <li class="mb-2"><i class="bi bi-dot"></i><a href="{{ route('doctor.dashboard') }}" class="text-decoration-none text-secondary">Quản lý lịch & Lịch sử</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection