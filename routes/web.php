<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users', [UserController::class, 'index'])->name('user.index');

    Route::prefix('permissions')->group(function () {
        Route::post('/createPermission', [PermissionsController::class, 'createPermission'])->name('createPermission');
        Route::post('/setUserPermissions', [PermissionsController::class, 'setUserPermissions'])->name('setUserPermissions');
        Route::post('/revokeUserPermissions', [PermissionsController::class, 'revokeUserPermissions'])->name('revokeUserPermissions');
        Route::post('/setUserRole', [PermissionsController::class, 'setUserRole'])->name('setUserRole');
    });

    Route::prefix('roles')->group(function () {
        Route::post('/createRole', [RoleController::class, 'createRole'])->name('createRole');
        Route::post('/setRolePermisson', [RoleController::class, 'setRolePermisson'])->name('setRolePermisson');
    });

    Route::prefix('notification')->group(function () {
        Route::post('/sendNotification', [NotificationController::class, 'sendNotification'])->name('sendNotification');
    });
});


require __DIR__ . '/auth.php';
