<?php

namespace Tests\Unit;

use App\Models\Service;
use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class ServiceTest extends TestCase
{
    public function test_service_create()
    {
        $user = User::first();
        $faker = Faker::create();
        if ($user) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/service', [
                'title' => $faker->title(),
                'description' => $faker->text(200),
                'photo' => $faker->imageUrl()
            ]);
            $this->assertEquals($response['message'], 'Service telah dibuat');
            $this->assertNotEquals($response['message'], null);
            $response->assertStatus(201);
        } else $this->markTestSkipped("User not have data");
    }

    public function test_service_destroy()
    {
        $user = User::first();
        $service = Service::first();
        if ($service) {
            $response = $this->actingAs($user, 'api')->delete('/api/v1/service/' . $service->id);
            $this->assertEquals($response['message'], 'Service telah dihapus');
            $this->assertNotEquals($response['message'], null);
            $response->assertStatus(200);
        } else $this->markTestSkipped("Service not have data");
    }

    public function test_service_update()
    {
        $user = User::first();
        $service = Service::first();
        $faker = Faker::create();
        if ($service) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/service/' . $service->id, [
                'title' => $faker->title(),
                'description' => $faker->text(200),
                'photo' => $faker->imageUrl()
            ]);
            $this->assertEquals($response['message'], "Service telah diperbarui");
            $this->assertNotEquals($response['message'], null);
            $response->assertStatus(200);
        } else $this->markTestSkipped("Service not have data");
    }

    public function test_service_active_animation()
    {
        $user = User::first();
        if ($user->accounts) {
            $response = $this->actingAs($user, 'api')->post('/api/v1/auth/animation/', [
                'type' => 'service',
                'active' => !$user->accounts->animation_service
            ]);
            $response->assertStatus(200);
        } else $this->markTestSkipped("Accounts not have data");
    }

    public function test_service_move_to_animation()
    {
        $user = User::first();
        $service = Service::first();
        if ($user) {
            if ($service) {
                $response = $this->actingAs($user, 'api')->post('/api/v1/service/active/' . $service->id, [
                    'active' => !$service->animation,
                ]);
                $response->assertStatus(200);
            } else $this->markTestSkipped("Service not have data");
        } else $this->markTestSkipped("User not have data");
    }
}
