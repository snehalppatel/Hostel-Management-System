<?php

namespace Database\Factories;

use App\Models\Outing;
use Illuminate\Database\Eloquent\Factories\Factory;

class OutingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Outing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'in_time' => $this->faker->word,
        'out_time' => $this->faker->word,
        'remarks' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
