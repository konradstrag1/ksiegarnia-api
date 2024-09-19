<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Client;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    protected $model = Rental::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'client_id' => Client::factory(),
            'rented_at' => now(),
            'returned_at' => null
        ];
    }
}
