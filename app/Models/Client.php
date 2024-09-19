<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function books()
    {
        return $this->hasManyThrough(Book::class, Rental::class, 'client_id', 'id', 'id', 'book_id');
    }
}
