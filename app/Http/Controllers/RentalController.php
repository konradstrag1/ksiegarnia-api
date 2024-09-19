<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{

    public function rent(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'client_id' => 'required|exists:clients,id',
        ]);

        $book = Book::with('currentRental')->findOrFail($request->book_id);
        if ($book->currentRental) {
            return response()->json([
                'message' => 'This book is already rented out.'
            ], 400);
        }

        $rental = Rental::create([
            'book_id' => $request->input('book_id'),
            'client_id' => $request->input('client_id'),
            'rented_at' => now(),
        ]);

        return response()->json([
            'message' => 'Book rented successfully!',
            'rental' => $rental
        ], 201);
    }

    public function returnBook($id)
    {
        $rental = Rental::where('book_id', $id)
            ->whereNull('returned_at')
            ->firstOrFail();

        $rental->update([
            'returned_at' => now(),
        ]);

        return response()->json([
            'message' => 'Book returned successfully!',
            'rental' => $rental
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
