<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate([
            'name' => 'Water',
        ]);

        Category::updateOrCreate([
            'name' => 'Milk',
        ]);

        Category::updateOrCreate([
            'name' => 'Beer',
        ]);

        Category::updateOrCreate([
            'name' => 'Soft Drinks',
        ]);

        Category::updateOrCreate([
            'name' => 'Juice',
        ]);
    }
}
