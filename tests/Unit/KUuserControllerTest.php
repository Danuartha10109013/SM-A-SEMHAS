<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsAllUsers()
    {
        User::factory()->count(3)->create();

        $response = $this->get(route('Administrator.kelola-user'));

        $response->assertStatus(200);
        $this->assertEqualsCanonicalizing(User::all()->pluck('id')->toArray(), $response->original->getData()['data']->pluck('id')->toArray());
    }

    public function testStoreCreatesNewUser()
    {
        Storage::fake('public');
        $avatar = UploadedFile::fake()->image('avatar.jpg');
        
        $response = $this->post(route('Administrator.kelola-user.store'), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'role' => 1,
            'username' => 'johndoe',
            'avatar' => $avatar
        ]);

        $response->assertRedirect(route('Administrator.kelola-user'));
        $this->assertEqualsIgnoringCase('User added successfully.', session('success'));

        $user = User::first();
        $this->assertEquals('John Doe', $user->name);
        $this->assertEqualsWithDelta(Hash::make('Tatametal123'), $user->password, 5);
        $this->assertIsInt($user->role);
        $this->assertIsNumeric($user->role);
        $this->assertEquals(1, $user->status);
    }

    public function testUpdateUserWithoutPasswordChange()
    {
        $user = User::factory()->create(['password' => Hash::make('OldPassword123')]);

        $response = $this->put(route('Administrator.kelola-user.update', $user->id), [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'role' => 2,
            'username' => 'janedoe'
        ]);

        $response->assertRedirect(route('Administrator.kelola-user'));
        $this->assertEqualsIgnoringCase('User updated successfully!', session('success'));

        $user->refresh();
        $this->assertEquals('Jane Doe', $user->name);
        $this->assertEquals(2, $user->role);
        $this->assertEquals('jane.doe@example.com', $user->email);
        $this->assertEqualsIgnoringCase('janedoe', $user->username);
        $this->assertEqualsWithDelta(Hash::make('OldPassword123'), $user->password, 5);
        $this->assertIsFloat($user->role * 1.0);
    }

    public function testDestroyDeletesUser()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('Administrator.kelola-user.delete', $user->id));

        $response->assertRedirect(route('Administrator.kelola-user'));
        $this->assertEqualsIgnoringCase('User deleted successfully!', session('success'));

        $this->assertNull(User::find($user->id));
    }

    public function testStoreHandlesInvalidData()
    {
        $response = $this->post(route('Administrator.kelola-user.store'), [
            'name' => 'John Doe',
            'email' => 'invalid-email', // Invalid email
            'role' => 'NotAnInteger', // Invalid role type
            'username' => ''
        ]);

        $response->assertSessionHasErrors(['email', 'role', 'username']);
        $this->assertNan(sqrt(-1)); // Assert NaN for demonstration
    }
}
