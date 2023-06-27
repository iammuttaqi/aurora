<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Beauty & Personal Care',
            'Health & Fitness',
            'Baby & Kids',
            'Books & Literature',
            'Sports & Outdoors',
            'Automotive',
            'Tools & Home Improvement',
            'Movies & Entertainment',
            'Music',
            'Art & Crafts',
            'Food & Beverages',
            'Pet Supplies',
            'Office & School Supplies',
            'Furniture',
            'Travel & Luggage',
            'Garden & Outdoor',
            'Toys & Games',
            'Jewelry & Accessories',
            'Watches',
            'Mobile Phones & Accessories',
            'Computers & Accessories',
            'Cameras & Photography',
            'Home Appliances',
            'Musical Instruments',
            'Party & Event Supplies',
            'Industrial & Scientific',
            'Stationery & Office Supplies',
        ];

        foreach ($categories as $key => $category) {
            Category::create([
                'title' => $category,
                'slug'  => str()->slug($category),
            ]);
        }
    }
}
