<?php

use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\ConfirmAccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
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

    Route::controller(RhUserController::class)->group(function (): void {
        Route::get('/rh-users', 'index')->name('rh-user.index');
        Route::get('/rh-users/new-rh-user', 'newRhUser')->name('rh-user.new-rh-user');
        Route::post('/rh-users/store-rh-user', 'storeRhUser')->name('rh-user.store-rh-user');
        Route::get('/rh-users/edit-rh-user/{id}', 'editRhUser')->name('rh-user.edit-rh-user');
        Route::post('/rh-users/update-rh-user', 'updateRhUser')->name('rh-user.update-rh-user');
        Route::get('/rh-users/delete-rh-user/{id}', 'deleteRhUser')->name('rh-user.delete-rh-user');
        Route::get('/rh-users/destroy-rh-user/{id}', 'destroyRhUser')->name('rh-user.destroy-rh-user');
    });

    Route::controller(ColaboratorsController::class)->group(function (): void {
        Route::get('/colaborators', 'index')->name('colaborators.index');
        Route::get('/colaborators/{id}', 'show')->name('colaborators.show');
        Route::get('/colaborators/delete/{id}', 'delete')->name('colaborators.delete');
        Route::get('/colaborators/destroy/{id}', 'destroy')->name('colaborators.destroy');
    });
});

Route::middleware('guest')->group(function (): void {
    Route::controller(ConfirmAccountController::class)->group(function (): void {
        Route::get('/confirm-account/{token}', 'confirmAccount')->name('confirm-account');
        Route::post('/confirm-account', 'submitConfirmAccount')->name('confirm-account.submit');
    });
});
