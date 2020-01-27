<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */

    use RefreshDatabase;
    use WithFaker;

    public function test_userLogin()
    {

        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@test',
            'password' => bcrypt('qwerty12'),
        ]);

        $response = $this->post('/login',[
            'identity' => 'test',
            'password' => 'qwerty12',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_UserLoginWithStatusActive() {

        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@test',
            'status' => '1',
            'password' => bcrypt('qwerty12'),
        ]);

        $response = $this->post('/login',[
            'identity' => 'test',
            'password' => 'qwerty12',
        ]);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_UserLoginWithStatusLocked() {

        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@test',
            'status' => '0',
            'password' => bcrypt('qwerty12'),
        ]);

        $response = $this->post('/login',[
            'identity' => 'test',
            'password' => 'qwerty12',
        ]);

        $response = $this->get(route('home'));
        $response->assertStatus(302);
    }
}
