<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = 
        [
            [
                'name' => '寿司'
            ],
            [
                'name' => '焼肉'
            ],
            [
                'name' => '居酒屋'
            ]
            ,[
                'name' => 'イタリアン'
            ],
            [
                'name' => 'ラーメン'
            ],
            ];

            foreach ($categories as $category) 
            {
                Category::create($category);
            }
    }
}
