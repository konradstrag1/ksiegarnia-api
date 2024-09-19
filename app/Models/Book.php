<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author'];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function currentRental()
    {
        return $this->hasOne(Rental::class)->whereNull('returned_at');
    }
}
