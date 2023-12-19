<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Company;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_authenticated_admin()
    {
        // Assume an authenticated admin
        $admin = Admin::create([
            'id' => 1,
            'name' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $this->actingAs($admin, 'admins');

        // Act: Make a GET request to the login endpoint
        $response = $this->get(route('admin_login'));

        // Assert: Check for a successful redirect to the intended page
        $response->assertRedirect(route('landing_page'));
    }

    public function test_login_returns_login_view_for_guest()
    {
        // Act: Make a GET request to the login endpoint
        $response = $this->get(route('admin_login'));

        // Assert: Check for a successful response
        $response->assertSuccessful();

        // Assert: Check that the correct view is returned
        $response->assertViewIs('Admin.login');

        // Assert: Check that the title is passed to the view
        $response->assertViewHas('title', 'Admin');
    }
}
