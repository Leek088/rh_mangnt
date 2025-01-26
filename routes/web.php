<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/home');
    Route::view('/home', 'home')->name('home');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/user/profile', 'index')->name('user.profile');
        Route::post('/user/update-password', 'updatePassword')->name('user.update.password');
        Route::post('/user/update-data', 'updateData')->name('user.update.data');
    });

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('department.index');
        Route::get('/departments/new-department', 'newDepartment')->name('department.new-department');
        Route::post('/departments/store-department', 'storeDepartment')->name('department.store-department');
    });
});
