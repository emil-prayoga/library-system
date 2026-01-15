<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display user's borrowings.
     */
    public function index()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show a single borrowing detail.
     */
    public function show(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== Auth::id()) {
            abort(403, 'Tidak dapat melihat peminjaman orang lain');
        }
        $borrowing->load('book');
        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Store a new borrowing.
     */
    public function store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        // Check if book is available
        if ($book->stock < 1) {
            return back()->with('error', 'Buku tidak tersedia. Stok habis.');
        }

        // Check if user already has 3 active borrowings
        $activeBorrowings = Borrowing::where('user_id', Auth::id())
            ->where('status', 'BORROWED')
            ->count();

        if ($activeBorrowings >= 3) {
            return back()->with('error', 'Anda sudah meminjam 3 buku. Kembalikan salah satu buku terlebih dahulu sebelum meminjam buku lain.');
        }

        // Check if user already borrowed this book (and not returned)
        $alreadyBorrowed = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'BORROWED')
            ->first();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini. Kembalikan terlebih dahulu sebelum meminjam lagi.');
        }

        $borrowing = Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => Carbon::now(),
            'return_deadline' => Carbon::now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        // Kurangi stock buku
        $book->decrement('stock');

        // Log activity
        ActivityLog::log('BORROW', "Borrowed book: {$book->title}", 'Borrowing', $borrowing->id);

        return back()->with('success', 'Buku berhasil dipinjam! Deadline pengembalian 7 hari.');
    }

    /**
     * Return a borrowed book.
     */
    public function return(Request $request, Borrowing $borrowing)
    {
        // Check if user owns this borrowing
        if ($borrowing->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        if ($borrowing->status === 'RETURNED') {
            return back()->with('error', 'Book already returned.');
        }

        // Calculate fine if overdue
        $fine = 0;
        $returnDate = Carbon::now();

        if ($returnDate->greaterThan($borrowing->return_deadline)) {
            $daysOverdue = $returnDate->diffInDays($borrowing->return_deadline);
            $fine = $daysOverdue * 2000; // Rp 2.000 per day
        }

        $borrowing->update([
            'return_date' => $returnDate,
            'status' => 'RETURNED',
            'fine' => $fine,
        ]);

        // Kembalikan stock buku
        $borrowing->book->increment('stock');

        // Log activity
        ActivityLog::log('RETURN', "Returned book: {$borrowing->book->title}" . ($fine > 0 ? " (Fine: Rp " . number_format($fine, 0, ',', '.') . ")" : ""), 'Borrowing', $borrowing->id);

        $message = $fine > 0 
            ? "Book returned! You have an overdue fine of Rp " . number_format($fine, 0, ',', '.')
            : 'Book returned successfully!';

        return back()->with('success', $message);
    }

    /**
     * Export borrowing transactions to CSV.
     */
    public function export()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'asc')
            ->get();

        $filename = 'borrowing_transactions_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = array(
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($borrowings) {
            $file = fopen('php://output', 'w');
            
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, ['Book Title', 'Author', 'Category', 'Borrow Date', 'Return Deadline', 'Return Date', 'Status', 'Fine (Rp)'], ';');

            foreach ($borrowings as $borrowing) {
                $borrowDate = $borrowing->borrow_date instanceof \DateTime 
                    ? $borrowing->borrow_date->format('Y-m-d') 
                    : $borrowing->borrow_date;
                
                $returnDeadline = $borrowing->return_deadline instanceof \DateTime 
                    ? $borrowing->return_deadline->format('Y-m-d') 
                    : $borrowing->return_deadline;
                
                $returnDate = $borrowing->return_date instanceof \DateTime 
                    ? $borrowing->return_date->format('Y-m-d') 
                    : ($borrowing->return_date ?? '-');

                $fine = (float) $borrowing->fine;

                fputcsv($file, [
                    $borrowing->book->title,
                    $borrowing->book->author,
                    $borrowing->book->category,
                    $borrowDate ?? '-',
                    $returnDeadline ?? '-',
                    $returnDate,
                    $borrowing->status,
                    number_format($fine, 0, ',', '.'),
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
