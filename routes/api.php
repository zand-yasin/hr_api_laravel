<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API V1 ----
Route::prefix('v1')->group(function () {

    // Include routes for EmployeeController
    include __DIR__ . '/api_versions/v1/employee_routes.php';

    // Include routes for EmployeeJobController
    include __DIR__ . '/api_versions/v1/employee_job_routes.php';

    // Include routes for AuthController
    include __DIR__ . '/api_versions/v1/auth_routes.php';
});

