<?php

namespace Database\Factories;

use App\Models\Accounts;
use App\Models\Background;
use Illuminate\Database\Eloquent\Factories\Factory;

class BackgroundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Background::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "background" => $this->faker->imageUrl(),
            "accounts_id" => Accounts::first()->id,
        ];
    }
}
