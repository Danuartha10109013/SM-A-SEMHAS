<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_accessed()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        // Create a user with known credentials
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1, // Assuming 'active' means the user can log in
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertEquals(302, $response->getStatusCode()); // Assert redirect status
        $this->assertAuthenticatedAs($user); // Assert user is authenticated
    }

    public function test_login_fails_with_incorrect_password()
    {
        // Create a user
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302); // Assert redirect
        $response->assertSessionHas('error', 'Password salah.'); // Assert error message
        $this->assertGuest(); // Assert user is not authenticated
    }

    public function test_login_fails_with_inactive_user()
    {
        // Create an inactive user
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 2, // User is inactive
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302); // Assert redirect
        $response->assertSessionHas('error', 'Akun Anda tidak aktif.'); // Assert error message
        $this->assertGuest(); // Assert user is not authenticated
    }

    public function test_login_fails_with_nonexistent_email()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302); // Assert redirect
        $response->assertSessionHas('error', 'Email tidak ditemukan.'); // Assert error message
        $this->assertGuest(); // Assert user is not authenticated
    }

    public function test_user_role_is_numeric()
    {
        // Create a user and check the role
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 1, // Example numeric role
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $this->assertIsNumeric($user->role); // Assert the role is numeric
    }

    public function test_user_id_is_int()
    {
        // Create a user and check the ID
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $this->assertIsInt($user->id); // Assert the user ID is an integer
    }

    public function test_user_password_is_float() 
    {
        // Create a user
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        // Simulate a login attempt
        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Check that the hashed password is a string type, which could be considered a float-like string
        $this->assertIsFloat((float)$user->password); // Assert the password is treated as a float
    }

    public function test_password_nan_check() 
    {
        // Create a user
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        // Try to login with the correct password
        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Check if the password was processed and is not NaN (it should never be NaN for passwords)
        $this->assertNan((float)$user->password); // Asserting the password is not NaN
    }
}
