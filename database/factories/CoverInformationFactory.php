<?php

namespace Database\Factories;

use App\Models\Accounts;
use App\Models\CoverInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoverInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoverInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title(),
            "child_title" => $this->faker->jobTitle(),
            "description" => $this->faker->text(200),
            "accounts_id" => Accounts::first()->id
        ];
    }
}
