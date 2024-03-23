<?php

namespace App\Http\Controllers;

use App\Helpers\EmployeeLogHelper;
use App\Models\Employee;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string|confirmed'
            ]);


            $userexist = User::where('email', $fields['email'])->first();

            if ($userexist) {
                $response = [
                    'error' => 'Plese try a unique email',
                ];

                return response($response, 409);
            }

            // Add new employee
            $employee = new Employee();
            $employee->name = $fields['name'];

            $employee->save();

            $user = new User();
            $user->email = $fields['email'];
            $user->password = bcrypt($fields['password']);
            $user->employee()->associate($employee); // Associate user with employee
            $user->save();

            $token = $user->createToken('myapptoken')->plainTextToken;

            // Log the employee
            EmployeeLogHelper::logEmployeeOperation($employee->id, 'POST', 'Employee created at User POST endpoint');

            // Commit transaction if everything succeeds
            DB::commit();

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            $response = [
                'error' => 'Failed to add Employee'
            ];
            return response($response, 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            // Check email
            $user = User::where('email', $fields['email'])->first();

            // Check password
            if (!$user || !Hash::check($fields['password'], $user->password)) {
                return response([
                    'message' => 'Auhtentication faild'
                ], 401);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        } catch (Exception $e) {
            $response = [
                'error' => 'Failed to login'
            ];
            return response($response, 500);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
