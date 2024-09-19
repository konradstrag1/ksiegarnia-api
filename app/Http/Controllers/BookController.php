<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('currentRental.client:name')->select('id', 'name', 'author')->paginate(20);
        $books->getCollection()->transform(function ($book) {
            $isRented = $book->currentRental ? true : false;
            $clientName = $book->currentRental ? $book->currentRental->client->name : null;

            return [
                'id' => $book->id,
                'name' => $book->name,
                'author' => $book->author,
                'is_rented' => $isRented,
                'rented_by' => $clientName
            ];
        });

        return response()->json($books);
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
    public function show($id)
    {
        $book = Book::with('currentRental.client:name')->findOrFail($id);

        $isRented = $book->currentRental ? true : false;
        $clientName = $book->currentRental ? $book->currentRental->client->name : null;

        return response()->json([
            'id' => $book->id,
            'name' => $book->name,
            'author' => $book->author,
            'year_of_publication' => $book->year_of_publication,
            'publisher' => $book->publisher,
            'is_rented' => $isRented,
            'rented_by' => $clientName
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public function search(Request $request)
    {
        $bookName = $request->input('name');
        $author = $request->input('author');
        $clientName = $request->input('rented_by');

        $query = Book::query();

        if ($bookName) {
            $query->where('name', 'like', '%' . $bookName . '%');
        }

        if ($author) {
            $query->where('author', 'like', '%' . $author . '%');
        }

        if ($clientName) {
            $query->whereHas('currentRental.client', function ($q) use ($clientName) {
                $q->where('name', 'like', '%' . $clientName . '%');
            });
        }

        $books = $query->with('currentRental.client:name')->select('id', 'name', 'author')->paginate(20);

        $books->getCollection()->transform(function ($book) {
            $isRented = $book->currentRental ? true : false;
            $clientName = $book->currentRental ? $book->currentRental->client->name : null;

            return [
                'id' => $book->id,
                'name' => $book->name,
                'author' => $book->author,
                'is_rented' => $isRented,
                'rented_by' => $clientName
            ];
        });

        return response()->json($books);
    }


}
