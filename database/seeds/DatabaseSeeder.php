<?php

use Illuminate\Database\Seeder;
use App\Models\Pet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    

        for ($i = 0; $i < 125; $i++) {

            $gender_pool = ['male', 'female'];
            $friendliness_pool = ['friendly', 'not-friendly'];

            $assigned_height = rand(0, 20) / 10;
            $assigned_weight = rand(0, 700) / 10;

            $assigned_gender =  $gender_pool[array_rand($gender_pool, 1)];
            $assigned_friendliness =  $friendliness_pool[array_rand($friendliness_pool, 1)];

            Pet::updateOrCreate(
                [
                    'name' => $faker->firstName($assigned_gender)
                ],
                [
                    'nickname' => $faker->citySuffix,
                    'weight' => $assigned_weight,
                    'height' => $assigned_height,
                    'gender' => $assigned_gender,
                    'color' => $faker -> colorName,
                    'friendliness' => $assigned_friendliness,
                    'birthday' => $faker -> dateTimeBetween($startDate = '-10 years', $endDate = '-1 years', $timezone = null),
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ]
            );
        }

    }
}
