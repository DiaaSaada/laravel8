<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }


    public function test_user_regsiter(){

        $response = $this->post('/register', [
            'name' => 'Test User333',
            'email' => 'test@example222.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            ] );
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

    }
}
