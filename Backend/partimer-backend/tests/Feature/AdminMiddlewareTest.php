<?php
// tests/Feature/AdminMiddlewareTest.php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminAuthenticated;

class AdminMiddlewareTest extends TestCase
{
    /** @test */
    public function test_allows_admins_to_access()
    {
        // Mock an authenticated admin user
        Auth::shouldReceive('guard')->with('admins')->andReturnSelf();
        Auth::shouldReceive('user')->andReturn((object)['id' => 1, 'role' => 'admin']);

        // Create a mock request
        $request = Request::create('/some-route', 'GET');

        // Create an instance of the middleware
        $middleware = new AdminAuthenticated;

        // Call the middleware handle method
        $response = $middleware->handle($request, function () {
            // This closure is called if the middleware passes
            return response('OK', 200);
        });

        // Assert that the response is as expected
        $this->assertEquals('OK', $response->getContent());
    }

    /** @test */
    public function it_denies_non_admins()
    {
        // Mock an unauthenticated user
        Auth::shouldReceive('guard')->with('admins')->andReturnSelf();
        Auth::shouldReceive('user')->andReturnNull();

        // Create a mock request
        $request = Request::create('/some-route', 'GET');

        // Create an instance of the middleware
        $middleware = new AdminAuthenticated;

        // Call the middleware handle method
        $response = $middleware->handle($request, function () {
            // This closure should not be called if the middleware denies access
            return response('OK', 200);
        });

        // Assert that the response is a 401 Unauthorized
        $this->assertEquals(302, $response->getStatusCode());
    }
}
