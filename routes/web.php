<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () { return view('welcome'); });

Auth::routes();
Route::get('/home', function() { return redirect('/'); });

Route::middleware(['auth'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::post('/doctor/schedule', [DoctorController::class, 'storeSchedule'])->name('doctor.schedule.store');
    
    Route::get('/patient/doctors', [PatientController::class, 'index'])->name('patient.index');
    Route::post('/patient/book', [PatientController::class, 'book'])->name('patient.book');
});