<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::select('id', 'name')->get();
        // Zwracamy dane w formacie JSON
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $client = Client::create([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'message' => 'Client created successfully!',
            'client' => $client
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Client::with('books')->findOrFail($id);

        return response()->json([
            'id' => $client->id,
            'name' => $client->name,
            'books' => $client->books->map(function ($book) {
                return [
                    'id' => $book->id,
                    'name' => $book->name,
                    'author' => $book->author
                ];
            })
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        if ($client->rentals()->whereNull('returned_at')->exists()) {
            return response()->json([
                'message' => 'Cannot delete client with active rentals.'
            ], 400);
        }

        $client->delete();

        return response()->json([
            'message' => 'Client deleted successfully!'
        ], 200);
    }
}
