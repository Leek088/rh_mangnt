<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (): void {
    Route::redirect('/', '/home');
    Route::view('/home', 'home')->name('home');

    Route::controller(ProfileController::class)->group(function (): void {
        Route::get('/user/profile', 'index')->name('user.profile');
        Route::post('/user/update-password', 'updatePassword')->name('user.update.password');
        Route::post('/user/update-data', 'updateData')->name('user.update.data');
    });

    Route::controller(DepartmentController::class)->group(function (): void {
        Route::get('/departments', 'index')->name('department.index');
        Route::get('/departments/new-department', 'newDepartment')->name('department.new-department');
        Route::post('/departments/store-department', 'storeDepartment')->name('department.store-department');
        Route::get('/departments/edit-department/{id}', 'editDepartment')->name('department.edit-department');
        Route::post('/departments/update-department', 'updateDepartment')->name('department.update-department');
        Route::get('/departments/delete-department/{id}', 'deleteDepartment')->name('department.delete-department');
        Route::get('/departments/destroy-department/{id}', 'destroyDepartment')->name('department.destroy-department');
    });
});
