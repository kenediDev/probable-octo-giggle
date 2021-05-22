<?php

namespace Tests\Unit;

use App\Models\ListCoverInformation;
use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class ListCoverInformationTest extends TestCase
{
    public function test_information_create()
    {
        $auth = User::first();
        $faker = Faker::create();
        if ($auth) {
            $response = $this->actingAs($auth, "api")->post("/api/v1/information", [
                'description' => $faker->text(200)
            ]);
            $response->assertStatus(201);
            $this->assertEquals($response['message'], "List cover informasi telah dibuat");
            $this->assertNotEquals($response['message'], null);
        } else $this->markTestSkipped("User not have data");
    }
    public function test_information_destroy()
    {
        $auth = User::first();
        $information = ListCoverInformation::first();
        if ($auth) {
            if ($information) {
                $response = $this->actingAs($auth, 'api')->delete("/api/v1/information/" . $information->id);
                $response->assertStatus(200);
                $this->assertEquals($response['message'], 'List cover informasi telah dihapus');
            } else $this->markTestSkipped("Information not have data");
        } else $this->markTestSkipped("User not have data");
    }
    public function test_information_update()
    {
        $auth = User::first();
        $information = ListCoverInformation::first();
        $faker = Faker::create();
        if ($auth) {
            if ($information) {
                $response = $this->actingAs($auth, 'api')->post('/api/v1/information/' . $information->id, [
                    'description' => $faker->text(200)
                ]);
                $response->assertStatus(200);
                $this->assertEquals($response['message'], 'List cover informasi telah diperbarui');
            } else $this->markTestSkipped("Information not have data");
        } else $this->markTestSkipped("User not have data");
    }
}
