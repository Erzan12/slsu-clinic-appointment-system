<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {

    /**
     * TODO: Must be inside the controller
     * So that in the future if we pass some data to this route
     * it won't make the route messy
     */
    Route::get('/', function () {
        return view('homepage');
    });
    


    /**
     * controller function helps to group the routes
     * and calling the controller once.
     * Instead of keep on calling the controller.
     */
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('authenticate');
    });
 
    Route::get('/register', [PatientController::class, 'index']);
    Route::post('/register', [PatientController::class, 'store'])->name('patients.store');


    Route::prefix('/admin')->group(function () {
        Route::get('/', [AuthController::class, 'adminLogin']);
        Route::post('/', [AuthController::class, 'adminAuthenticate'])->name('admin.authenticate');
    });
});


Route::middleware('auth')->group(function () {

    /**
     * TODO: Must be inside the controller
     * So that in the future if we pass some data to this route
     * it won't make the route messy
     */
    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile/information', [ProfileController::class, 'information'])->name('profile.information');
    Route::put('/profile/information', [ProfileController::class, 'update'])->name('profile.update');

    /**
     * NOTE: Add here all route related to patient
     */
    Route::middleware('patient')->group(function () {
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
        Route::get('/ratings/{id}', [RatingController::class, 'create'])->name('ratings.create');
        Route::post('/ratings/{id}', [RatingController::class, 'store'])->name('ratings.store');
    });


    /**
     * NOTE: ADd here all route related to admin
     */
    Route::middleware('admin')->group(function () {
        Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists.index');
        Route::get('/specialists/create', [SpecialistController::class, 'create'])->name('specialists.create');
        Route::get('/specialists/{id}/edit', [SpecialistController::class, 'edit'])->name('specialists.edit');
        Route::post('/specialists', [SpecialistController::class, 'store'])->name('specialists.store');
        Route::put('/specialists/{id}', [SpecialistController::class, 'update'])->name('specialists.update');
        Route::delete('/specialist/{id}', [SpecialistController::class, 'delete'])->name('specialists.delete');
        Route::get('/specialist/{id}/restore', [SpecialistController::class, 'restore'])->name('specialists.restore');
        Route::get('/patients', [PatientController::class, 'list'])->name('patients.list');
        Route::delete('/patients/{id}', [PatientController::class, 'delete'])->name('patients.delete');
        Route::get('/patients/{id}', [PatientController::class, 'restore'])->name('patients.restore');
        Route::resource('services', ServiceController::class);
    });

    /**
     * NOTE: Add here all route related to specialist
     */
    Route::middleware('specialist')->group(function () {
        Route::resource('schedules', ScheduleController::class);
        Route::get('/appointments/{id}/reject', [AppointmentController::class, 'reject'])->name('appointments.reject');
        Route::get('/appointments/{id}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
        Route::get('/findings/{id}', [FindingController::class, 'create'])->name('findings.create');
        Route::post('/findings/{id}', [FindingController::class, 'store'])->name('findings.store');
    });

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
});