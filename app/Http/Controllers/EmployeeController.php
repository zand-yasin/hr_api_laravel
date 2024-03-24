<?php

namespace App\Http\Controllers;

use App\Helpers\EmployeeLogHelper;
use App\Mail\MailNotify;
use App\Models\Employee;
use App\Models\EmployeeJob;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;
use Response;

class EmployeeController extends Controller
{
    //

    public function addEmployee(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // column validation
            $fields = $request->validate([
                'name' => 'required|string',
                'salary' => 'required|numeric',
                'manager_id' => 'numeric',
                'employee_job_id' => 'numeric',
                'email' => 'required|string',
                'password' => 'required|string|confirmed'
            ]);

            // Add new employee
            $employee = new Employee();
            $employee->name = $fields['name'];
            $employee->salary = $fields['salary'];

            if ($request->input('employee_job_id')) {

                $employeeJob = EmployeeJob::find($fields['employee_job_id']);
                if (!$employeeJob) {
                    $response = [
                        'error' => 'Faild, no EmployeeJob found with that certain id'
                    ];

                    return response($response, 500);
                } else {
                    $employee->employee_job_id = $fields['employee_job_id'];
                }
            }
            if ($request->input('manager_id')) {

                $manager = Employee::where('manager_id', $fields['manager_id'])->first();
                if (!$manager) {
                    $response = [
                        'error' => 'Faild, no Manager found with that certain id'
                    ];

                    return response($response, 500);
                } else {
                    $employee->manager_id = $fields['manager_id'];
                }
            }

            $employee->save();
            // ticking employeeJob to the employee object if exist else null will be tick instead
            $employee->employeeJob = $employeeJob ?? null;
            // ticking manager to the employee object if exist else null will be tick instead 
            $employee->manager = $manager ?? null;

            $userexist = User::where('email', $fields['email'])->first();

            if ($userexist) {
                $response = [
                    'error' => 'Plese try a unique email',
                ];

                return response($response, 409);
            }

            $user = new User();
            $user->email = $fields['email'];
            $user->password = bcrypt($fields['password']);
            $user->employee()->associate($employee); // Associate user with employee
            $user->save();


            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($employee->id, 'POST', 'Employee created');

            // Commit transaction if everything succeeds
            DB::commit();

            $response = [
                'user' => $user,
                'message' => 'Employee added successfully'
            ];

            return response($response, 201);
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            $response = [
                'error' => 'Faild to add Employee'
            ];
            return response($response, 500);
        }
    }

    public function findEmployee($id = null)
    {
        $description = null;
        $employeeId = null;

        try {
            if ($id == null) {
                // find all employee by join to user
                $employee = Employee::with('user')->get();
                $description = 'Get All Employees';

            } else {
                // find employee by id by join to user
                $employee = Employee::with('user')->find($id);
                if ($employee) {
                    $description = 'Get Employees by id';
                    $employeeId = $employee->id;
                } else {
                    // if no employee found by id, then try to find employee by salary by join to user
                    $employee = Employee::with('user')->where('salary', $id)->first();
                    if ($employee) {
                        $description = 'Get Employees by salary';
                        $employeeId = $employee->id;
                    } else {
                        return throw new ModelNotFoundException();
                    }
                }
            }

            // Log the employee if any employee found
            EmployeeLogHelper::logEmployeeOperation($employeeId, 'GET', $description);

            return response($employee);
        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'No Employee found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Failed'
            ];
            return response($response, 500);
        }
    }

    public function employeeAndTheirManager($id = null)
    {
        try {
            $employee = Employee::with('manager')->find($id);
            $response = [
                'employee' => $employee
            ];

            if (!$employee) {
                return throw new ModelNotFoundException();
            }

            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($id, 'GET', 'Find Employee Manager');

            return response($response);

        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'No Employee found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Failed'
            ];
            return response($response, 500);
        }
    }

    // Function to recursively retrieve the chain of managers
    private function getManagerChain($id, &$result)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $result[] = $employee->name;

            if ($employee->manager) {
                $this->getManagerChain($employee->manager->id, $result);
            }
        }
    }

    // find an employee's manager up to founder
    public function findManagerChainByEmployeeId($id)
    {
        try {
            $result = [];
            $this->getManagerChain($id, $result);

            if (count($result) == 0) {
                return throw new ModelNotFoundException();
            }

            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($id, 'GET', 'Find Employee Manager Chain');

            return response()->json($result);

        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'No Employee found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Failed'
            ];
            return response($response, 500);
        }
    }

    // Function to recursively retrieve the chain of managers with salaries
    private function getManagerChainWithSalaries($id, &$result)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $result[$employee->name] = $employee->salary; // Store name and salary as key-value pair

            if ($employee->manager) {
                $this->getManagerChainWithSalaries($employee->manager->id, $result);
            }
        }
    }

    // Function to find an employee's manager and the manager's chain of managers with salaries
    public function findManagerChainWithSalaries($id)
    {
        try {
            $result = [];
            $this->getManagerChainWithSalaries($id, $result);


            if (count($result) == 0) {
                return throw new ModelNotFoundException();
            }


            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($id, 'GET', 'Find Employee Manager Chain With Salaries');

            return response()->json($result);

        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'No Employee found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Failed'
            ];
            return response($response, 500);
        }
    }


    public function downloadAsCsv()
    {
        // Define the filename for the CSV file
        $filename = "employees.csv";

        // Retrieve all employees from the database
        $table = Employee::all();

        // Open or create the CSV file for writing
        $handle = fopen($filename, 'w+');

        // Write the header row to the CSV file
        $headers = array('NAME', 'SALARY', 'DATE CREATED', 'DATE UPDATED');
        fputcsv($handle, $headers);

        // Iterate over each employee and write their data to the CSV file
        foreach ($table as $row) {
            $column_names = array($row['name'], $row['salary'], $row['created_at'], $row['updated_at']);
            fputcsv($handle, $column_names);
        }

        // Close the CSV file handle
        fclose($handle);

        // Define headers for the HTTP response
        $headers = array(
            'Content-Type' => 'text/csv',
        );

        // Log the employee
        EmployeeLogHelper::logEmployeeOperation(null, 'GET', 'Download Employee records as CSV file');

        // Return a downloadable response containing the CSV file
        return Response::download($filename, $filename, $headers);
    }

    // Update operation
    public function updateEmployee(Request $request, $id)
    {

        try {
            // column validation
            $fields = $request->validate([
                'name' => 'required|string',
                'salary' => 'required|numeric',
                'manager_id' => 'numeric',
                'employee_job_id' => 'numeric',
            ]);


            // Start a database transaction
            DB::beginTransaction();

            // Find the employee
            $employee = Employee::findOrFail($id);

            if (!$employee) {
                return throw new ModelNotFoundException();
            }


            // Update employee attributes
            $employee->fill($fields); // Fill with validated fields

            if ($request->input('employee_job_id')) {

                $employeeJob = EmployeeJob::find($request->input('employee_job_id'));
                if (!$employeeJob) {
                    $response = [
                        'error' => 'Faild, no EmployeeJob found with that certain id'
                    ];

                    return response($response, 500);
                } else {
                    $employee->employee_job_id = $request->input('employee_job_id');
                }
            }
            if ($request->input('manager_id')) {

                $manager = Employee::where('manager_id', $request->input('manager_id'))->first();
                if (!$manager) {
                    $response = [
                        'error' => 'Faild, no Manager found with that certain id'
                    ];

                    return response($response, 500);
                } else {
                    $employee->manager_id = $request->input('manager_id');
                }
            }



            $employee->save();
            // ticking employeeJob to the employee object if exist else null will be tick instead
            $employee->employeeJob = $employeeJob ?? null;
            // ticking manager to the employee object if exist else null will be tick instead 
            $employee->manager = $manager ?? null;


            $user = $employee->user;


            // Update user email if provided
            if ($request->has('email')) {

                $userexist = User::where('email', $request->input('email'))->first();

                if ($userexist) {
                    $response = [
                        'error' => 'Plese try a unique email',
                    ];

                    return response($response, 409);
                }


                if ($user) {
                    $user->email = $request->input('email');
                    $user->save();
                }
            }


            // Send email notification to the employee if it's salary changed
            if ($request->has('salary')) {
                // email sender commented out because mailer credential are not set up to ignore the error
                // $this->sendMail($employee, $user);
            }

            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($employee->id, 'PATCH', 'Update Employee');


            // Commit the transaction if everything succeeds
            DB::commit();

            $response = [
                'employee' => $employee,
                'message' => 'Employee updated successfully'
            ];

            return response($response, 201);
        } catch (ModelNotFoundException $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();
            $response = [
                'error' => 'No Employee found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();
            $response = [
                'error' => 'Update employee faild'
            ];
            return response($response, 404);
        }
    }

    public function sendMail($employee, $user)
    {

        $title = 'Salary changed';
        $body = "Dear $employee->name your salary changed to $employee->salary";
        $to = $user->email;

        Mail::to($to)->send(new MailNotify($title, $body, array($to)));
    }

    // Delete operation
    public function deleteEmployee($id)
    {
        try {
            // Find the employee
            $employee = Employee::findOrFail($id);

            // Delete the corresponding user
            $employee->user()->delete();

            // Delete the employee
            $employee->delete();

            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($id, 'DELETE', 'Delete Employee');

            $response = [
                'employee' => $employee,
                'message' => 'Employee deleted successfully'
            ];

            return response($response, 201);
        } catch (ModelNotFoundException $e) {
            $response = [
                'message' => 'Employee not found'
            ];
            return response($response, 404);
        } catch (Exception $e) {
            $response = [
                'error' => 'Delete employee failed'
            ];
            return response($response, 404);
        }
    }

    // Function to handle CSV file upload and insert records into the employees table
    public function uploadEmployees(Request $request)
    {

        try {
            // Start a database transaction
            DB::beginTransaction();


            $insertedEmployees = array();
            $redudantEmployees = array();
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|file|mimes:csv,txt|max:2048',
            ]);

            // Get the uploaded file
            $file = $request->file('file');
            $existingEmployee = null;

            // Read the CSV file and insert records into the employees table
            if (($handle = fopen($file->getPathname(), 'r')) !== false) {

                // Iterate through each row in the CSV file
                while (($data = fgetcsv($handle)) !== false) {
                    // Extract data from the CSV row
                    $name = $data[0];
                    $salary = $data[1];
                    // useing Carbon to parse and format the dates:
                    $createdAt = Carbon::parse($data[2])->format('Y-m-d H:i:s');
                    $updatedAt = Carbon::parse($data[3])->format('Y-m-d H:i:s');


                    // Check if the employee already exists by name
                    $existingEmployee = Employee::where('name', $name)->first();

                    // If the employee doesn't exist, insert a new record
                    if (!$existingEmployee) {
                        $employee = new Employee();
                        $employee->name = $name;
                        $employee->salary = $salary;
                        $employee->created_at = $createdAt; // Set created_at field
                        $employee->updated_at = $updatedAt; // Set updated_at field

                        $employee->save();
                        $insertedEmployees[] = $employee;

                    } else {
                        $redudantEmployees[] = $existingEmployee;
                    }
                }

                fclose($handle);
            }

            if (count($insertedEmployees) > 0) {

                $employees_to_log = array();
                foreach ($insertedEmployees as $employee_log) {
                    $employees_to_log[] = [
                        'employee_id' => $employee_log->id,
                        'method' => 'POST',
                        'description' => 'Bulk employee insertion By CSV file',
                    ];
                }

                EmployeeLogHelper::logEmployeeOperations($employees_to_log);
            }

            // Commit the transaction if everything succeeds
            DB::commit();

            $insetCounter = count($insertedEmployees);
            $redudantCounter = count($redudantEmployees);
            $response = [
                'message' => "Adding $insetCounter new records and Avoiding $redudantCounter redudant records.",
                'redudantEmployees' => $redudantEmployees,
                '$insertedEmployees' => $insertedEmployees,
            ];

            return response($response, 201);
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            $response = [
                'message' => 'Employee seeding faild'
            ];
            return response($response, 404);
        }
    }
}
