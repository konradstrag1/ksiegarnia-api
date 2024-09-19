<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Client;
use App\Models\Rental;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RentalControllerTest extends TestCase
{
    use RefreshDatabase;

    #[TEST]
    public function it_can_rent_a_book()
    {
        $book = Book::factory()->create();
        $client = Client::factory()->create();
        $response = $this->post('/api/rentals/rent', [
            'book_id' => $book->id,
            'client_id' => $client->id,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('rentals', [
            'book_id' => $book->id,
            'client_id' => $client->id,
        ]);
    }

    #[TEST]
    public function it_can_return_a_book()
    {
        $rental = Rental::factory()->create([
            'returned_at' => null,
        ]);

        $response = $this->put('/api/rentals/return/' . $rental->book_id);
        $response->assertStatus(200);
        $this->assertDatabaseHas('rentals', [
            'book_id' => $rental->book_id,
            'returned_at' => now(),
        ]);
    }
}
