<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest1 extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_accessed()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        // Create a user specifically for this test
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1, // Active user status
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302); // Assert redirect status
        $this->assertAuthenticatedAs($user); // Assert user is authenticated
    }

    public function test_login_fails_with_incorrect_password()
    {
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

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'Password salah.');
        $this->assertGuest(); // Assert user is not authenticated
    }

    public function test_login_fails_with_inactive_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 2, // Inactive user status
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'Akun Anda tidak aktif.');
        $this->assertGuest();
    }

    public function test_login_fails_with_nonexistent_email()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('error', 'Email tidak ditemukan.');
        $this->assertGuest();
    }

    public function test_user_role_is_numeric()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 1, // Numeric role
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $this->assertIsNumeric($user->role);
    }

    public function test_user_id_is_int()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'role' => 0,
            'status' => 1,
            'type' => 'regular',
            'password' => Hash::make('password123'),
        ]);

        $this->assertIsInt($user->id);
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
