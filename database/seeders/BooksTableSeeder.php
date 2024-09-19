<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++) {
            Book::create([
                'name' => $faker->sentence(3),
                'author' => $faker->name,
                'year_of_publication' => $faker->year,
                'publisher' => $faker->company,
            ]);
        }
    }
}
