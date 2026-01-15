<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'category_id',
        'year',
        'published_date',
        'description',
        'stock',
        'cover',
    ];

    protected $casts = [
        'year' => 'integer',
        'stock' => 'integer',
        'published_date' => 'date',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function categoryModel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }

    public function decrementStock()
    {
        $this->decrement('stock');
    }

    public function incrementStock()
    {
        $this->increment('stock');
    }
}