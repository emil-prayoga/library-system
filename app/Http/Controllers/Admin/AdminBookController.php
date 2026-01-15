<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBookController extends Controller
{
    public function show(Book $book)
    {
        return view('admin.books.show', [
            'book' => $book,
            'pageTitle' => 'Detail Buku'
        ]);
    }
}
