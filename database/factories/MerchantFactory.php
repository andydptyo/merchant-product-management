<?php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Merchant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Merchant $merchant) {
            $random = $this->faker->numberBetween(1, 50);
            $randomPrice = $this->faker->numberBetween(10000, 1000000);

            $products = [];
            for ($i = 1; $i < $random; $i++) {
                $products[$i] = ['price' => $randomPrice];
            }

            $merchant->products()->syncWithoutDetaching($products);

        });
    }
}
