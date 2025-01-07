<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tracking');
});

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
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/tracking', function () {
    return view('tracking.index');
});
Route::get('/tracking-search', [TrackingController::class, 'search'])->name('tracking.search');


require __DIR__ . '/auth.php';
