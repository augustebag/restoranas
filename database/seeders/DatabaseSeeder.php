<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'name' => 'Auguste',
            'email' => 'abagdzeviciute@gmail.com',
            'password' => Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'name' => 'bette',
            'email' => 'bette@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $title = ['Kijevas', 'Kotletai', 'Omletas', 'Agurku sriuba', 'Lasisa', 'Obuoliu pyragas', 'Aviena'];
        foreach(range(1, 100) as $_) {

            DB::table('menus')->insert([
                'title' => $title[rand(0, count($title) -1)], 
                'price' => rand(1, 50),
                'weight' => rand(1, 1000),
                'meat' => rand(1, 1000),
                'photo' => rand(0, 2) ? $faker->imageUrl(200, 300) : null,
                'about' => $faker->realText(300, 5)
            ]);
        }

        $title = ['Pusynelis', 'Toskana', 'Talutti', 'CityPica', 'Blue', 'Kibinine', 'London Grill'];
        foreach(range(1, 100) as $_) {

            DB::table('restaurants')->insert([
                'title' => $title[rand(0, count($title) -1)],
                'customers' => rand(1, 50),
                'employees' => rand(1, 10),
                'menu_id' => rand(1, 20) 
            ]);
        }
    }
}
