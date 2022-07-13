<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'コースA',
                'amount' => '2000',
            ],
            [
                'name' => 'コースB',
                'amount' => '3500',
            ]
        ];

        foreach ($courses as $course){
            for($i=1; $i<=20; $i++){
                $course['shop_id'] = $i;
                Course::create($course);
            };
        };
    }
}
