<?php

namespace Tests\Feature;

use App\Models\User;
use DB;
use Tests\TestCase;
use App\Models\EmployeeJob;
use Faker\Generator as Faker;

class EmployeeJobControllerTest extends TestCase
{
    public function testDeleteEmployeeJob()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // create an employeeJob for test
            $employeeJob = EmployeeJob::factory(EmployeeJob::class)->create();

            // Send a DELETE request to delete the employeeJob created before
            $response = $this->delete('/api/v1/employeeJob/' . $employeeJob->id . '');

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }
    public function testDeleteIfNoEmployeeJobFound()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // assume undefined employee id will be set
            $wrongEmployeeJobId = -1;

            // Send a DELETE request to delete the employeeJob created before
            $response = $this->delete('/api/v1/employeeJob/' . $wrongEmployeeJobId . '');

            // Assert the response status
            $response->assertStatus(404);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testAddEmployeeJob()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // create employee job object
            $employeeJob = $this->getUniqEmployeeJob();

            // Send a post request to create the employee job
            $response = $this->post('/api/v1/employeeJob/', $employeeJob);

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testAddDuplicateEmployeeJobByName()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // get a user record at user model
            $employeeJob = EmployeeJob::first();
            // create employee object
            $employeeJobDuplicate = $this->getUniqEmployeeJob();
            // set the email property as an exist one
            $employeeJobDuplicate['name'] = $employeeJob->name;

            // Send a post request to create the employee job
            $response = $this->post('/api/v1/employeeJob/', $employeeJobDuplicate);

            // Assert the response status
            $response->assertStatus(409);
        } else {
            $this->markTestSkipped('No user found in the database.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function testUpdateEmployeeJob()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // get an employee job recored at employee job model
            $employeeJob = EmployeeJob::first();

            // create employee job object
            $updatedBody = $this->getUpdateEmployeeJobBody();

            // Send a patch request to update the employee job
            $response = $this->patch('/api/v1/employeeJob/' . $employeeJob->id . '', $updatedBody);

            // Assert the response status
            $response->assertStatus(201);
        } else {
            $this->markTestSkipped('Update is faild.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }
    public function testUpdateIfNoEmployeeJobFound()
    {
        DB::beginTransaction();

        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // crete employee job object to update the value
            $updatedBody = $this->getUpdateEmployeeJobBody();
            // assume undefined employee job id will be set
            $undefinedEmployeeJobId = -1;

            // Send a patch request to update the employee job
            $response = $this->patch('/api/v1/employeeJob/' . $undefinedEmployeeJobId . '', $updatedBody);

            // Assert the response status
            $response->assertStatus(404);
        } else {
            $this->markTestSkipped('Update is faild.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function getUniqEmployeeJob()
    {

        // create a fake employee job object at the employeeJob factory
        $faker = \Faker\Factory::create();

        // create an unique employeeJob
        $employeeJob = [
            "name" => $faker->unique()->name,
        ];

        return $employeeJob;
    }
    public function getUpdateEmployeeJobBody()
    {
        // employee job body object to be retrieved.
        $updatedBody = [
            "name" => 'chnagedName'
        ];

        return $updatedBody;
    }
}
