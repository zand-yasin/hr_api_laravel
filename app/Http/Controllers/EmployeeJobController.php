<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Models\EmployeeJob;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Generator\DuplicateMethodException;
use Response;

class EmployeeJobController extends Controller
{
    public function addEmployeeJob(Request $request)
    {

        try {
            // column validation
            $fields = $request->validate([
                'name' => 'required|string',
            ]);

            // Find the employeeJob
            $employeeJob = EmployeeJob::where('name', $fields['name'])->first();

            if ($employeeJob) {
                $response = [
                    'error' => 'The record with certain name is already exists',
                ];

                return response($response, 409);
            }

            $employeeJob = EmployeeJob::create([
                'name' => $fields['name']
            ]);

            $response = [
                'employeeJob' => $employeeJob,
            ];

            return response($response, 201);
        } catch (Exception $e) {

            $response = [
                'error' => 'Failed to add EmployeeJob'
            ];
            return response($response, 500);
        }
    }

    public function findEmployeeJob($id = null)
    {
        try {
            if ($id == null) {
                // find all employeeJob
                $employeeJob = EmployeeJob::get();


            } else {
                // find employeeJob by id
                $employeeJob = EmployeeJob::find($id);
                if (!$employeeJob)
                    throw new ModelNotFoundException();
            }
            return response($employeeJob);


        } catch (ModelNotFoundException $e) {
            $response = [
                'error' => 'EmployeeJob not found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Fetching employeeJob failed'
            ];
            return response($response, 404);
        }
    }

    // Update operation
    public function updateEmployeeJob(Request $request, $id)
    {
        try {
            // column validation
            $fields = $request->validate([
                'name' => 'string',
            ]);

            // Find the employeeJob
            $employeeJob = EmployeeJob::find($id);

            if (!$employeeJob) {
                throw new ModelNotFoundException();
            }

            // Update employeeJob attributes
            $employeeJob->fill($fields); // Fill with validated fields
            $employeeJob->save();

            $response = [
                'employeeJob' => $employeeJob,
                'message' => 'EmployeeJob updated successfully'
            ];

            return response($response, 201);
        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'EmployeeJob not found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'message' => 'Update employeeJob failed'
            ];
            return response($response, 404);
        }
    }

    // Delete operation
    public function deleteEmployeeJob($id)
    {
        try {
            // Find the employeeJob
            $employeeJob = EmployeeJob::findOrFail($id);

            // Delete the employeeJob
            $employeeJob->delete();

            $response = [
                'employeeJob' => $employeeJob,
                'message' => 'EmployeeJob deleted successfully'
            ];

            return response($response, 201);
        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'EmployeeJob not found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'message' => 'Delete employeeJob failed'
            ];
            return response($response, 404);
        }
    }

}
