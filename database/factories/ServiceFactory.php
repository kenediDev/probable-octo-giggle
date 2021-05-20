<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title(),
            "photo" => $this->faker->image(),
            "description" => $this->faker->text(200),
            "user_id" => User::first()->id,
        ];
    }
}
