<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirects_authenticated_user()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make a GET request to the login route
        $response = $this->get('/user/login');

        // Assert that the authenticated user is redirected to the user_homepage
        $response->assertRedirect(route('user_homepage'));
    }

    public function test_login_shows_login_form_for_unauthenticated_user()
    {
        // Make a GET request to the login route
        $response = $this->get('/user/login');

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'User.login' and contains the title 'Login'
        $response->assertViewIs('User.login');
        $response->assertViewHas('title', 'Login');
    }

    /*public function test_login_with_valid_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user, 'web');
        // Make a POST request to the login route with valid credentials
        $response = $this->post(route('login.post'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert that the user is redirected to the intended route (user_homepage)
        $response->assertRedirect(route('user_homepage'));

        // Optionally, you can assert that the user is authenticated
        $this->assertAuthenticatedAs($user);
    }*/

    public function test_login_with_invalid_credentials()
    {
        // Make a POST request to the login route with invalid credentials
        $response = $this->post(route('login.post'), [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        // Assert that the user is redirected back to the login route with an error message
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Login invalid');

        // Optionally, you can assert that the user is not authenticated
        $this->assertGuest();
    }

    public function test_register_page_is_accessible_for_guests()
    {
        // Make a GET request to the register route
        $response = $this->get(route('register'));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'User.register' and contains the title 'Register'
        $response->assertViewIs('User.register');
        $response->assertViewHas('title', 'Register');
    }

    public function test_register_with_valid_data()
    {
        // Make a POST request to the register route with valid data
        $response = $this->post(route('register.post'), [
            'fullName' => 'John Doe',
            'phoneNum' => '1234567890',
            'email' => 'john@example.com',
            'password' => 'Password123!',
            'password_confirm' => 'Password123!',
        ]);

        // Assert that the user is redirected to the login route
        $response->assertRedirect(route('login'));

        // Assert that the user is registered in the database
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_register_with_existing_email()
    {
        // Create a user with a specific email
        $existingUser = User::factory()->create(['email' => 'existing@example.com']);

        // Make a POST request to the register route with the existing email
        $response = $this->post(route('register.post'), [
            'fullName' => 'John Doe',
            'phoneNum' => '1234567890',
            'email' => 'existing@example.com',
            'password' => 'Password123!',
            'password_confirm' => 'Password123!',
        ]);

        // Assert that the user is redirected back with input and error message
        $response->assertSessionHasErrors(['email']);
    }

    public function test_profile_method_returns_profile_view()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Make a GET request to the profile route
        $response = $this->get(route('profile', $user));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'User.profile' and contains the title 'Profile'
        $response->assertViewIs('User.profile');
        $response->assertViewHas('title', 'Profile');
    }

    public function test_logout_method_logs_out_user_and_redirects_to_login()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Make a POST request to the logout route
        $response = $this->get(route('logout'));

        // Assert that the user is logged out
        $this->assertGuest();

        // Assert that the response redirects to the login route
        $response->assertRedirect(route('login'));
    }

    public function test_edit_method_returns_view_with_user_data()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Make a GET request to the edit route with the user's ID
        $response = $this->get(route('profile.edit', $user));

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'User.edit' and contains the user's data
        $response->assertViewIs('User.edit');
        $response->assertViewHas('title', 'edit');
        $response->assertViewHas('user', $user);
    }

    public function test_update_method_updates_user_data()
    {
        // Create a user for testing
        $user = User::factory()->create();

        // Authenticate the user
        $this->actingAs($user);

        // Mock a file for testing file uploads
        $cvFile = UploadedFile::fake()->create('cv_file.pdf');
        $profilePictureFile = UploadedFile::fake()->image('profile_picture.jpg');

        // Make a PUT request to the update route with user data and files
        $response = $this->put(route('profile.update', $user), [
            'phoneNum' => 'New Phone Number',
            'email' => 'new-email@example.com',
            'socMed' => 'New Social Media',
            'age' => 25,
            'edu' => 'New Education',
            'address' => 'New Address',
            'cv' => $cvFile,
            'profile_picture' => $profilePictureFile,
        ]);

        // Assert that the user data is updated in the database
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'phoneNum' => 'New Phone Number',
            'email' => 'new-email@example.com',
            'socialMedia' => 'New Social Media',
            'age' => 25,
            'education' => 'New Education',
            'address' => 'New Address',
        ]);

        // Assert that the files are stored in the public storage
        $this->assertFileExists(storage_path('app/public/cv_user/' . $user->email . '_cv_file.pdf'));
        $this->assertFileExists(storage_path('app/public/image_user/' . $user->email . '_profile_picture.jpg'));

        // Assert that the user is redirected to the profile route with success message
        $response->assertRedirect(route('profile', $user));
        $response->assertSessionHas('success', 'Update Success');
    }

    public function test_delete_user(){
        $user = User::factory()->create();

        // Act: Make a DELETE request to the delete endpoint
        $response = $this->delete(route('profile.delete', ['user' => $user]));

        // Assert: Check that the user is deleted
        //$this->assertDeleted($user);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

        // Assert: Check for a successful redirect to the login page
        $response->assertRedirect(route('login'))->assertSessionHas('success', 'Delete Success');
    }
}
