<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->group(function () {

    Route::group(['middleware' => ['auth:sanctum']], function () {

        // GET
        Route::get("findEmployee/{id?}", [EmployeeController::class, 'findEmployee']);
        Route::get("findManagerChainByEmployeeId/{id}", [EmployeeController::class, 'findManagerChainByEmployeeId']);
        Route::get("findManagerChainWithSalaries/{id}", [EmployeeController::class, 'findManagerChainWithSalaries']);
        Route::get("employeeAndTheirManager/{id}", [EmployeeController::class, 'employeeAndTheirManager']);
        Route::get("downloadAsCsv", [EmployeeController::class, 'downloadAsCsv']);

        // POST
        Route::post("/uploadEmployees", [EmployeeController::class, 'uploadEmployees']);
        Route::post('', [EmployeeController::class, 'addEmployee']);

        // PATCH
        Route::patch("{id}", [EmployeeController::class, 'updateEmployee']);

        // DELETE
        Route::delete("{id}", [EmployeeController::class, 'deleteEmployee']);

    });
});