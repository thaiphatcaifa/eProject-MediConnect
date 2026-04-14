@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-speedometer2 text-primary-dark fs-2 me-3"></i>
        <h3 class="text-primary-dark fw-bold mb-0">Khu Vực Quản Lý Của Bác Sĩ</h3>
    </div>
    @if(session('success')) <div class="alert alert-success border-0 shadow-sm"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div> @endif

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary-dark py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle icon-thin me-2"></i>Đăng lịch trống</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('doctor.schedule.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="text-muted small fw-bold mb-1"><i class="bi bi-calendar-event me-1"></i> Ngày khám</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted small fw-bold mb-1"><i class="bi bi-clock me-1"></i> Khung giờ</label>
                            <input type="text" name="time_slot" class="form-control" placeholder="Ví dụ: 08:00 - 09:00" required>
                        </div>
                        <button type="submit" class="btn btn-primary-dark w-100 py-2"><i class="bi bi-send me-2"></i>Đăng Lịch Khám</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card mb-4 border border-danger shadow-sm">
                <div class="card-header bg-danger text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-bell icon-thin me-2"></i>Cuộc hẹn mới!</h5>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light"><tr><th class="ps-4">Bệnh nhân</th><th>Ngày hẹn</th><th>Khung giờ</th></tr></thead>
                        <tbody>
                            @forelse($appointments as $app)
                            <tr>
                                <td class="ps-4 fw-bold text-primary-dark">{{ $app->patient->name }}</td>
                                <td><i class="bi bi-calendar3 me-2"></i>{{ date('d/m/Y', strtotime($app->schedule->date)) }}</td>
                                <td><span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-clock me-1"></i>{{ $app->schedule->time_slot }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-muted">Chưa có ai đặt lịch.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="text-primary-dark mb-0 fw-bold"><i class="bi bi-card-list icon-thin me-2"></i>Lịch bạn đã đăng</h5>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light"><tr><th class="ps-4">Ngày</th><th>Khung giờ</th><th>Trạng thái</th></tr></thead>
                        <tbody>
                            @foreach($schedules as $s)
                            <tr>
                                <td class="ps-4">{{ date('d/m/Y', strtotime($s->date)) }}</td>
                                <td>{{ $s->time_slot }}</td>
                                <td>
                                    @if($s->is_booked) <span class="badge bg-danger rounded-pill px-3 py-2">Đã có người đặt</span>
                                    @else <span class="badge bg-success rounded-pill px-3 py-2">Đang trống</span> @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection