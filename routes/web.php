<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard.index');
});

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('shipment', ShippingController::class);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::resource('tracking', TrackingController::class)->except(['store']);
        Route::resource('users', UserController::class);
        Route::get('/label-edit/{shipment}/edit', [LabelController::class, 'editLabel'])->name('label.edit');
        Route::post('/label-print/{shipment}', [LabelController::class, 'printLabel'])->name('label.print');
    });

    Route::get('/filter-index/{month}', [DashboardController::class, 'filterIndex'])->name('filter.index');
    Route::post('/filter-process', [DashboardController::class, 'filterProcess'])->name('filter.process');

    Route::get('/filter-index-tracking/{month}', [TrackingController::class, 'filterIndex'])->name('filter.index-tracking');
    Route::post('/filter-process-tracking', [TrackingController::class, 'filterProcess'])->name('filter.process-tracking');

    Route::get('/export-dashboard', [DashboardController::class, 'export'])->name('export.dashboard');
    Route::get('/export-dashboard-filter', [DashboardController::class, 'exportFilter'])->name('export.dashboard-filter');
    Route::get('/export-shipments', [TrackingController::class, 'export'])->name('export.tracking');
    Route::get('/export-shipments-filter', [TrackingController::class, 'exportFilter'])->name('export.tracking-filter');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/tracking', function () {
    return view('tracking.index');
})->name('tracking');
Route::get('/tracking-search', [TrackingController::class, 'search'])->name('tracking.search');


require __DIR__ . '/auth.php';
