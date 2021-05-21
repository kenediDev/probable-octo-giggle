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

    public function test_user_update()
    {
        $user = User::first();
        if ($user) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/auth/update', [
                'first_name' => 'Bengkel mobil sangkut',
                'last_name' => 'Kota Lubuklinggau',
                'description' => 'Bengkel Mobil sangkut kini sudah menjadi bengkel mobil terbaik dikota lubuklinggau, untuk melayani anda ahli dalam memeliharaan untuk ban, layanan memeliharaan rem, baterai, shock, absorber, suspensi mobil, sistem pendingin udara, dan penggantian oli, dan kami menawarkan penuh dari mekanik terlatih dan proffesional yang merupakan spesialis di bidang masing - masing, mekanik kami siap memberikan anda saran, memberikan layanan terbaik dan dibengkel sangkut siap untuk melayan perbaikan kendaraan anda diluar lokasi kota lubuklinggau, dan kami akan mengirimkan mekanik yang handal untuk memperbaiki kendaraan anda.'
            ]);
            $this->assertEquals($response['message'], 'Profil telah diperbarui');
            $this->assertNotEquals($response['message'], null);
            $response->assertStatus(200);
        } else $this->markTestSkipped("User not have data");
    }

    public function test_user_me()
    {
        $user = User::first();
        if ($user) {
            $response = $this->actingAs($user, 'api')->get('/api/v1/auth/me');
            $this->assertNotEquals($response, null);
            $response->assertStatus(200);
        } else $this->markTestSkipped("User not have data");
    }
}
