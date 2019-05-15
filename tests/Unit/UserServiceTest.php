<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->userService = new UserService();

        $this->user = [
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'testuser@email.com',
            'password' => 'Password'
        ];

        $this->credentials = [
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'testuser@email.com',
            'password' => 'Password',
            'confirmedPassword' => 'Password'
        ];

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->userService->createUser($this->credentials);
        $user = User::first();
        $this->assertEquals($user['firstName'], $this->credentials['firstName']);
        $this->assertEquals($user['lastName'], $this->credentials['lastName']);
        $this->assertEquals($user['email'], $this->credentials['email']);
        $this->assertTrue(Hash::check($this->credentials['password'], $user['password']));
    }

    //
}
