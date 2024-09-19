<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/books', [BookController::class, 'index']);
Route::get('/api/books/search', [BookController::class, 'search']);
Route::get('/api/books/{id}', [BookController::class, 'show']);
Route::get('/api/clients', [ClientController::class, 'index']);
Route::get('/api/clients/{id}', [ClientController::class, 'show']);
Route::post('/api/clients', [ClientController::class, 'store']);
Route::delete('/api/clients/{id}', [ClientController::class, 'destroy']);
Route::post('/api/rentals/rent', [RentalController::class, 'rent']);
Route::put('/api/rentals/return/{id}', [RentalController::class, 'returnBook']);
