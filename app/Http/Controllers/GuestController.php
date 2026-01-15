<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    /**
     * Show guest dashboard (browse books without borrowing)
     */
    public function dashboard()
    {
        // Set session flag for guest mode
        Session::put('guest_mode', true);

        $books = Book::paginate(8);

        return view('guest.dashboard', compact('books'));
    }

    /**
     * Show about page in guest mode
     */
    public function about()
    {
        // Set session flag for guest mode
        Session::put('guest_mode', true);

        return view('guest.about');
    }

    /**
     * Show guest book detail
     */
    public function show(Book $book)
    {
        // Ensure guest mode is set
        if (!Session::get('guest_mode')) {
            Session::put('guest_mode', true);
        }

        return view('guest.show', compact('book'));
    }

    /**
     * Exit guest mode and redirect to login
     */
    public function logout()
    {
        Session::forget('guest_mode');
        return redirect()->route('login')->with('status', 'Mode Guest dihentikan. Silakan login untuk meminjam buku.');
    }
}
