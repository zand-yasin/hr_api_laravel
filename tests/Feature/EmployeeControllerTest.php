<?php

namespace Tests\Feature;

use App\Models\User;
use DB;
use Tests\TestCase;
use App\Models\Employee;
use Faker\Generator as Faker;

class EmployeeControllerTest extends TestCase
{

    public function testDeleteEmployee()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // create an employee for test
            $employee = Employee::factory(Employee::class)->create();

            // Send a DELETE request to delete the employee created before
            $response = $this->delete('/api/v1/employee/' . $employee->id . '');

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }
    public function testDeleteIfNoEmployeeFound()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // assume undefined employee id will be set
            $undefinedEmployeeId = -1;

            // Send a DELETE request to delete the employee created before
            $response = $this->delete('/api/v1/employee/' . $undefinedEmployeeId . '');

            // Assert the response status
            $response->assertStatus(404);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testRgister()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // create employee object
            $employee = $this->getUniqEmployee();

            // Send a post request to create the employee
            $response = $this->post('/api/v1/employee/', $employee);

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }
    public function testAddDuplicateEmployeeByEmail()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // get a user record at user model
            $user = User::first();
            // create employee object
            $employeeDuplicate = $this->getUniqEmployee();
            // set the email property as an exist one
            $employeeDuplicate['email'] = $user->email;

            // Send a post request to create the employee
            $response = $this->post('/api/v1/employee/', $employeeDuplicate);

            // Assert the response status
            $response->assertStatus(409);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testUpdateEmployee()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // get an employee recored at employee model
            $employee = Employee::first();

            // create employee object
            $updatedBody = $this->getUpdateEmployeeBody();

            // Send a patch request to update the employee
            $response = $this->patch('/api/v1/employee/' . $employee->id . '', $updatedBody);

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('Update is faild.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testUpdateIfNoEmployeeFound()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // crete employee object to update the value
            $updatedBody = $this->getUpdateEmployeeBody();
            // assume undefined employee id will be set
            $undefinedEmployeeId = -1;

            // Send a patch request to update the employee
            $response = $this->patch('/api/v1/employee/' . $undefinedEmployeeId . '', $updatedBody);

            // Assert the response status
            $response->assertStatus(404);
        } else {
            $this->markTestSkipped('Update is faild.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function getUniqEmployee()
    {
        // create a fake employee object at the employee factory
        $faker = \Faker\Factory::create();

        // creat a fake password
        $password = $faker->password(6, 20);
        // create an unique employee
        $employee = [
            "name" => $faker->unique()->name,
            'email' => $faker->unique()->email(),
            "password" => $password,
            "password_confirmation" => $password,
            "salary" => $faker->numberBetween(20000, 100000)
        ];

        return $employee;
    }
    public function getUpdateEmployeeBody()
    {
        // employee body object to be retrieved.
        $updatedBody = [
            "name" => 'chnagedName',
            "salary" => 1
        ];

        return $updatedBody;
    }
}
