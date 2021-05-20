<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_login()
    {
        $user = User::first();
        if ($user) {
            $response = $this->post('/api/v1/auth', [
                'email' => $user->email,
                'password' => 'Password'
            ]);
            $this->assertNotEquals($response['token'], null);
            $response->assertStatus(200);
        } else $this->markTestSkipped("User not have data");
    }

    public function test_user_reset()
    {
        $user = User::first();
        if ($user) {
            $response = $this->post('/api/v1/auth/reset/', [
                'token' => $user->email
            ]);
            $this->assertEquals($response['message'], 'Akun telah direset, silahkan periksa inbox email anda untuk mendapatkan kata sandi baru');
            $response->assertStatus(200);
        } else $this->markTestSkipped("User not have data");
    }
}
