<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OtpController;

Route::get('/', function () {
    return view('welcome');
});

// OTP routes
Route::middleware(['auth'])->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.show');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify');
    Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});

// Protected user routes
Route::middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [TaskController::class, 'analytics'])->name('tasks.analytics');
    Route::get('/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');
    Route::get('/settings', [TaskController::class, 'settings'])->name('tasks.settings');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});

// Admin routes
Route::middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/tasks/{task}', [AdminController::class, 'deleteTask'])->name('admin.deleteTask');
});
