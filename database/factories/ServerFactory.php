<?php

namespace Database\Factories;

use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model' => $this->faker->word,
            'ram' => $this->faker->randomElement(['8GB', '16GB', '32GB']),
            'hdd' => $this->faker->randomElement(['2x500GBSSD', '4x500GBSSD']),
            'location' => $this->faker->city,
            'price' => $this->faker->randomElement(['$100', '$200', '$300']),
        ];
    }
}
?>
