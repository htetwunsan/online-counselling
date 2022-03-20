<?php

use App\Http\Controllers\Admin\CounsellorDetailController as AdminCounsellorDetailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CounsellorDetailController;
use Illuminate\Http\Request;
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

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

    Route::get('/counsellors/create', [AdminCounsellorDetailController::class, 'create'])->name('admin.counsellors.create');
    Route::post('/counsellors', [AdminCounsellorDetailController::class, 'store'])->name('admin.counsellors.store');

    Route::get('/counsellors/{counsellorDetail}/edit', [AdminCounsellorDetailController::class, 'edit'])->name('admin.counsellors.edit');
    Route::match(['put', 'patch'], '/counsellors/{counsellorDetail}', [AdminCounsellorDetailController::class, 'update'])->name('admin.counsellors.update');

    Route::delete('/counsellors/{counsellorDetail}', [AdminCounsellorDetailController::class, 'destroy'])->name('admin.counsellors.destroy');
});

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/', HomeController::class)->name('home');

    Route::get('/counsellors/{counsellorDetail}', [CounsellorDetailController::class, 'show'])->name('counsellors.show');

    Route::post('/bookings', [BookingController::class, 'store'])
        ->middleware('role:client')
        ->name('bookings.store');
});

require __DIR__ . '/auth.php';
