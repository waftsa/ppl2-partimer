<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleLoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_redirects_to_google()
    {
        // Mock the Socialite driver for Google
        Socialite::shouldReceive('driver->stateless->redirect')->andReturn(
            redirect('http://fake-google.com') // Replace with a fake URL
        );

        // Simulate a request to the 'redirectToGoogle' method
        $response = $this->get(route('login_google'));

        // Assert that the response is a redirect
        $response->assertStatus(302);

        // Assert that the response redirects to the fake Google URL
        $response->assertRedirect('http://fake-google.com');
    }
}
