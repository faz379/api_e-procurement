<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // use RefreshDatabase;
    public function testRegisterSuccess()
    {
        $this->post('api/users', [
            'username' => 'joko',
            'password' => 'test',
            'name' => 'joko'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'username' => 'joko',
                    'name' => 'joko'
                ]
            ]);
    }

    public function testRegisterFailed()
    {

    }

    public function testRegisterUsernameAlreadyExists()
    {

    }

    public function testLoginSuccess()
    {
        //$this->seed([UserSeeder::class]);
        $this->post('api/users/login', [
            'username' => 'joni',
            'password' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'joni',
                    'name' => 'joni'
                ]
            ]);
            
            $user = User::where('username', 'test')->first();
            self::assertNotNull($user->token);
    }

    public function testGetSuccess()
    {
        $this->get('/api/users/current', [
            'Authorization' => 'bagus'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'bagus',
                    'name' => 'bagus'
                ]
            ]);
    }

    public function testLogoutSuccess()
    {
        $this->seed([UserSeeder::class]);
    
        $this->withHeaders([
            'Authorization' => 'joni'
        ])->delete('/api/users/logout')
          ->assertStatus(200)
          ->assertJson([
              'data' => true
          ]);
    }

    
}
