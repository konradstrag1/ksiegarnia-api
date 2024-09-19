<?php

namespace Tests\Unit;

use App\Models\Rental;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    #[TEST]
    public function it_can_list_clients()
    {
        Client::factory()->count(3)->create();
        $response = $this->get('/api/clients');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    #[TEST]
    public function it_can_show_a_client()
    {
        $client = Client::factory()->create();
        $response = $this->get('/api/clients/' . $client->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $client->id,
            'name' => $client->name,
        ]);
    }

    #[TEST]
    public function it_can_create_a_client()
    {
        $response = $this->post('/api/clients', [
            'name' => 'John Doe',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('clients', ['name' => 'John Doe']);
    }

    #[TEST]
    public function it_can_delete_a_client()
    {
        $client = Client::factory()->create();
        $response = $this->delete('/api/clients/' . $client->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }

    #[TEST]
    public function it_cannot_delete_a_client_with_active_rentals()
    {
        $rental = Rental::factory()->create([
            'returned_at' => null,
        ]);
        $response = $this->delete('/api/clients/' . $rental->client_id);
        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Cannot delete client with active rentals.'
        ]);
        $this->assertDatabaseHas('clients', [
            'id' => $rental->client_id
        ]);
    }
}
