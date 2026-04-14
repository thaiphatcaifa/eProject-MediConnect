<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller {
    public function dashboard() {
        $doctor = Auth::user()->doctor; 
        if(!$doctor) abort(403, 'Khu vực chỉ dành cho Bác sĩ!');

        $schedules = DoctorSchedule::where('doctor_id', $doctor->id)->orderBy('date', 'desc')->get();
        $appointments = Appointment::where('doctor_id', $doctor->id)->orderBy('created_at', 'desc')->get();

        return view('doctor.dashboard', compact('schedules', 'appointments'));
    }

    public function storeSchedule(Request $request) {
        $request->validate(['date' => 'required|date', 'time_slot' => 'required|string']);
        DoctorSchedule::create([
            'doctor_id' => Auth::user()->doctor->id,
            'date' => $request->date,
            'time_slot' => $request->time_slot,
            'is_booked' => false
        ]);
        return back()->with('success', 'Đã thêm lịch trống thành công!');
    }
}