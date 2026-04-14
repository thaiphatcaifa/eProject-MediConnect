<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller {
    public function index(Request $request) {
        $specialties = Specialty::all();
        $query = Doctor::with(['user', 'specialty', 'schedules' => function($q) {
            $q->where('is_booked', false)->orderBy('date', 'asc');
        }]);

        if ($request->has('specialty_id') && $request->specialty_id != '') {
            $query->where('specialty_id', $request->specialty_id);
        }

        $doctors = $query->get();
        return view('patient.index', compact('doctors', 'specialties'));
    }

    public function book(Request $request) {
        try {
            DB::transaction(function () use ($request) {
                $schedule = DoctorSchedule::lockForUpdate()->findOrFail($request->schedule_id);
                if ($schedule->is_booked) throw new \Exception("Lịch này vừa có người đặt!");

                $schedule->is_booked = true; $schedule->save();

                Appointment::create([
                    'patient_id' => Auth::id(),
                    'doctor_id' => $request->doctor_id,
                    'schedule_id' => $schedule->id,
                    'status' => 'Confirmed'
                ]);
            });
            return back()->with('success', 'Đặt lịch thành công! Bác sĩ đã nhận được thông báo.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}