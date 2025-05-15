<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        for ($i = 0; $i < 1000; $i++) {
            $name = fake()->unique()->words(10, true); // Nombre más corto para evitar slugs muy largos

            Product::create([
                'category_id' => fake()->randomElement($categories), // Asigna una categoría aleatoria
                'brand_id' => fake()->randomElement($brands), // Asigna una marca aleatoria
                'name' => ucfirst($name),
                'slug' => Str::slug($name . '-' . $i), // Evita duplicados
                'description' => fake()->paragraph(),
                'price' => fake()->randomFloat(2,5,500), // Precio principal
                'stock' => fake()->numberBetween(100, 1000), // Stock entre 100 y 1000
                'image' => fake()->imageUrl(400,400,'technics',true), // Asigna una imagen aleatoria
                'status' => fake()->randomElement(['active', 'inactive']),
            ]);
        }
    }
}
