<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Company;
use App\Models\Job;
use App\Models\Admin;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_homepage()
    {
        $response = $this->get('/company/index');

        $response->assertStatus(302);
    }

    public function test_company_login_redirects_authenticated_user()
    {
        // Create a company and authenticate them
        $company = Company::factory()->create();
        $this->actingAs($company, 'company');

        // Make a GET request to the login route
        $response = $this->get('/company/login');

        // Assert that the authenticated company is redirected to the company_homepage
        $response->assertRedirect(route('company_homepage'));
    }

    public function test_company_login_shows_login_form_for_unauthenticated_user()
    {
        // Make a GET request to the login route
        $response = $this->get('/company/login');

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'Company.login' and contains the title 'Login'
        $response->assertViewIs('Company.login');
        $response->assertViewHas('title', 'Login');
    }

    /*public function test_company_login_post_redirects_authenticated_user()
    {
        // Assuming you have a company in the database
        $company = Company::factory()->create();
        $this->actingAs($company, 'company');

        $response = $this->post(route('company_login.post'), [
            'email' => $company->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'verified' => 1,
        ]);

        // Assert: Check for a successful redirect to the company homepage
        $response->assertRedirect(route('company_homepage'))->assertSessionHas('success', 'You are Logged in successfully.');

        // Assert: Check that the user is authenticated
        $this->assertTrue(Auth::guard('company')->check());
    }*/

    public function test_company_login_post_shows_error_for_invalid_credentials()
    {
        // Make a POST request to the login route with invalid credentials
        $response = $this->post('/company/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert that the response has a status code of 302 (redirect)
        $response->assertStatus(302);

        // Assert that there is an error message in the session
        $this->assertTrue(session()->has('error'));

        // Assert that the user is not authenticated
        $this->assertGuest('company');
    }

    public function test_company_register_redirects_authenticated_user()
    {
        // Create a company
        $company = Company::factory()->create();

        // Authenticate the company
        $this->actingAs($company, 'company');

        // Make a GET request to the register route
        $response = $this->get('/company/register');

        // Assert that the authenticated company is redirected to the company_homepage
        $response->assertRedirect(route('company_homepage'));
    }

    public function test_company_register_shows_register_form_for_unauthenticated_user()
    {
        // Make a GET request to the register route
        $response = $this->get('/company/register');

        // Assert that the response has a status code of 200 (OK)
        $response->assertStatus(200);

        // Assert that the view is 'Company.register' and contains the title 'Register'
        $response->assertViewIs('Company.register');
        $response->assertViewHas('title', 'Register');
    }

    public function test_company_register_post_redirects_and_creates_company()
    {
        // Prepare test data
        $requestData = [
            'companyName' => 'Test Company',
            'address' => 'Test Address',
            'email' => 'test@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Replace with the actual password
            'password_confirm' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Replace with the actual password
        ];

        // Act: Make a POST request to the register endpoint
        $response = $this->post(route('company_register.post'), $requestData);

        // Assert: Check for a successful redirect to the login page
        $response->assertRedirect(route('company_login'))->assertSessionHas('success', 'Registration Successfull, Waiting For Approval');

        // Assert: Check that the company was created in the database
        $this->assertDatabaseHas('company', ['email' => 'test@example.com']);

        // Optionally, you can add more assertions based on your application's registration logic
    }

    public function testCompanyIndex()
    {
        // Assuming you have a company in the database
        $company = Company::factory()->create();

        // Acting as the authenticated company
        $this->actingAs($company, 'company');

        // Act: Make a GET request to the company job index endpoint
        $response = $this->get(route('job.index.company'));

        // Assert: Check for a successful response and the view
        $response->assertSuccessful();
        $response->assertViewIs('Job.index_company');
        $response->assertViewHas('title', 'job');
    }

    public function test_verifies_company()
    {
        // Create a job in the database
        $company = Company::factory()->create(['verified' => 0]);
        $admin = Admin::create([
            'id' => 1,
            'name' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $this->actingAs($admin, 'admins');
        // Act: Make a PUT request to the allow endpoint
        $response = $this->put(route('admin.verif', $company));

        // Assert: Check for a successful redirect
        $response->assertRedirect();

        // Assert: Check that the job in the database has been updated
        $this->assertDatabaseHas('company', [
            'id' => $company->id,
            'verified' => 1,
        ]);
    }
}
