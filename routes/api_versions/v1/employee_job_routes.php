<?php

use App\Http\Controllers\EmployeeJobController;
use Illuminate\Support\Facades\Route;

Route::prefix('employeeJob')->group(function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::get("{id?}", [EmployeeJobController::class, 'findEmployeeJob']);
        Route::patch("{id}", [EmployeeJobController::class, 'updateEmployeeJob']);
        Route::delete("{id}", [EmployeeJobController::class, 'deleteEmployeeJob']);
        Route::post('', [EmployeeJobController::class, 'addEmployeeJob']);

    });
});