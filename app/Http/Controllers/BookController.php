<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $search = request('search');
        $query = Book::query();
        
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhereHas('categoryModel', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }
        
        $books = $query->orderBy('created_at', 'asc')->paginate(8);
        return view('books.index', compact('books', 'search'));
    }

    public function show(Book $book)
    {
        if (auth()->user() && auth()->user()->is_admin) {
            return view('admin.books.show', compact('book'));
        }
        return view('books.show', compact('book'));
    }

    

    public function create()
    {
        $this->authorize('create', Book::class);
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
        
    }

    public function store(BookRequest $request)
    {
        $this->authorize('create', Book::class);

        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Set year from published_date if not provided
        if (!isset($data['year']) && isset($data['published_date'])) {
            $data['year'] = date('Y', strtotime($data['published_date']));
        } elseif (!isset($data['year'])) {
            $data['year'] = date('Y');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $data = $request->validated();

        if ($request->hasFile('cover')) {
            // Hapus cover lama
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Set year from published_date if not provided
        if (!isset($data['year']) && isset($data['published_date'])) {
            $data['year'] = date('Y', strtotime($data['published_date']));
        } elseif (!isset($data['year'])) {
            $data['year'] = date('Y');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        // Hapus cover jika ada
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}



