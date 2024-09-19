<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    #[TEST]
    public function it_can_list_books()
    {
        Book::factory()->count(3)->create();
        $response = $this->get('/api/books');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    #[TEST]
    public function it_can_show_a_book()
    {
        $book = Book::factory()->create();
        $response = $this->get('/api/books/' . $book->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
        ]);
    }
}
