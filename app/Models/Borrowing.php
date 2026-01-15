<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_deadline',
        'return_date',
        'status',
        'fine',
    ];

    protected $casts = [
        'borrow_date'     => 'date',
        'return_deadline' => 'date',
        'return_date'     => 'date',
        'fine'            => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        return $this->status === 'BORROWED'
            && $this->return_deadline
            && now()->isAfter($this->return_deadline);
    }

    public function calculateFine(): float
    {
        if (!$this->return_date || $this->return_date->lte($this->return_deadline)) {
            return 0;
        }

        return $this->return_deadline->diffInDays($this->return_date) * 2000;
    }

    public function markAsReturned(): void
    {
        $this->return_date = now();
        $this->status = 'RETURNED';
        $this->fine = $this->calculateFine();
        $this->save();

        $this->book->incrementStock();
    }
}
