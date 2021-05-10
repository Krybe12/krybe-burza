<?php

namespace Database\Factories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Storage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'material_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->numberBetween(1, 50)
        ];
    }
}
