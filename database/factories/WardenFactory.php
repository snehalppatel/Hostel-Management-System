<?php

namespace Database\Factories;

use App\Models\Warden;
use Illuminate\Database\Eloquent\Factories\Factory;

class WardenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warden::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->word,
        'last_name' => $this->faker->word,
        'phone' => $this->faker->word,
        'email_verified_at' => $this->faker->word,
        'password' => $this->faker->word,
        'email' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
