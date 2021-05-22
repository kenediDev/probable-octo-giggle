<?php

namespace Database\Factories;

use App\Models\CoverInformation;
use App\Models\ListCoverInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListCoverInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListCoverInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "description" => $this->faker->text(200),
            "cover_information_id" => CoverInformation::first()->id,
        ];
    }
}
