<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
        return $this->afterCreating(function (Product $product) {
            $category = $this->faker->numberBetween(1, 5);

            $categories = [];
            // random attach product's category
            for ($i = 1; $i < $category; $i++) {
                $categories[] = $i;
            }

            $product->categories()->sync($categories);
        });
    }
}
