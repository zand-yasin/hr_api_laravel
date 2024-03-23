<?php

namespace Tests\Feature;

use App\Models\User;
use DB;
use Tests\TestCase;
use Faker\Generator as Faker;

class AuthControllerTest extends TestCase
{

    public function testRegister()
    {
        DB::beginTransaction();

        // create user object
        $user = $this->getUniqUser();

        // Send a post request to create the user
        $response = $this->post('/api/v1/auth/register', $user);

        // Assert the response status
        $response->assertStatus(201);

        DB::rollBack();
    }
    public function testRegisterAsDuplicateEmail()
    {
        DB::beginTransaction();

        $user = User::first();

        // create user object
        $userDuplicate = $this->getUniqUser();
        $userDuplicate['email'] = $user->email;
        // Send a post request to create the user
        $response = $this->post('/api/v1/auth/register', $userDuplicate);

        // Assert the response status
        $response->assertStatus(409);

        DB::rollBack();
    }

    public function testLogin()
    {
        DB::beginTransaction();

        // create user object
        $user = $this->getUniqUser();
        // register a user to the db
        $response = $this->post('/api/v1/auth/register', $user);

        // get the previeus user credintial to login
        $credential = [
            'email' => $user['email'],
            'password' => $user['password'],
        ];

        // Send a post request to login
        $response = $this->post('/api/v1/auth/login', $credential);

        // Assert the response status
        $response->assertStatus(201);

        DB::rollBack();
    }

    public function testLoginWithFalseCredential()
    {
        DB::beginTransaction();

        // create user object
        $user = $this->getUniqUser();

        // get the previeus user credintial to login
        $credential = [
            'email' => $user['email'],
            'password' => $user['password'],
        ];

        // Send a post request to login
        $response = $this->post('/api/v1/auth/login', $credential);

        // Assert the response status
        $response->assertStatus(401);

        DB::rollBack();
    }
    public function testLogout()
    {
        DB::beginTransaction();
        // Retrieve an existing user from the database 
        $user = User::first();

        // Check if a user exists
        if ($user) {
            // Authenticate the user for the test
            $this->actingAs($user);

            // Send a post request to logout
            $response = $this->post('/api/v1/auth/logout');

            // Assert the response status
            $response->assertStatus(200);
        } else {
            $this->markTestSkipped('Update is faild.'); // Skip the test if no user is found
        }
        DB::rollBack();
    }

    public function getUniqUser()
    {
        // create a fake user object at the user factory
        $faker = \Faker\Factory::create();

        // creat a fake password
        $password = $faker->password(6, 20);
        // create an unique user
        $user = [
            "name" => $faker->unique()->name,
            'email' => $faker->unique()->email(),
            "password" => $password,
            "password_confirmation" => $password,
        ];

        return $user;
    }
}
