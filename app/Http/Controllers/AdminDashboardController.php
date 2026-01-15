<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard with borrowing transactions
     */
    public function index(Request $request)
    {
        $query = Borrowing::with('book', 'user');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('book', function ($q) {
                $q->where('category', request('category'));
            });
        }

        // Filter by keyword (book title)
        if ($request->filled('keyword')) {
            $query->whereHas('book', function ($q) {
                $q->where('title', 'like', '%' . request('keyword') . '%');
            });
        }

        $borrowings = $query->paginate(10);

        return view('admin.dashboard', [
            'borrowings' => $borrowings,
            'pageTitle' => 'Admin Dashboard'
        ]);
    }

    /**
     * Show books management page
     */
    public function booksIndex(Request $request)
    {
        $search = $request->get('search');
        $query = Book::query();
        
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhere('publisher', 'like', '%' . $search . '%')
                  ->orWhereHas('categoryModel', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
        }
        
        $books = $query->paginate(10);

        return view('admin.books.index', [
            'books' => $books,
            'search' => $search,
            'pageTitle' => 'Manajemen Buku'
        ]);
    }

    /**
     * Show returns management page
     */
    public function returnsIndex(Request $request)
    {
        $query = Borrowing::with('book', 'user')->where('status', 'BORROWED');

        // Filter by user name
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request('user') . '%');
            });
        }

        // Filter by book title
        if ($request->filled('book_title')) {
            $query->whereHas('book', function ($q) {
                $q->where('title', 'like', '%' . request('book_title') . '%');
            });
        }

        $borrowings = $query->paginate(10);

        return view('admin.returns.index', [
            'borrowings' => $borrowings,
            'pageTitle' => 'Pengembalian Buku'
        ]);
    }

    /**
     * Show borrowing detail page
     */
    public function showBorrowing($id)
    {
        $borrowing = Borrowing::with('book', 'user')->findOrFail($id);
        
        return view('admin.borrowings.show', [
            'borrowing' => $borrowing,
            'pageTitle' => 'Detail Peminjaman'
        ]);
    }

    /**
     * Update borrowing status and increment stock
     */
    public function updateStatus(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);

        $borrowing->status = $request->status;
        $borrowing->save();

        // If status is RETURNED, increment book stock
        if ($request->status === 'RETURNED') {
            $borrowing->book->increment('stock');
        }

        return back()->with('status', 'Status transaksi berhasil diperbarui!');
    }

    /**
     * Export all borrowing transactions to CSV.
     */
    public function exportTransactions(Request $request)
    {
        try {
            $query = Borrowing::with('book', 'user');

            // Apply same filters as dashboard
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('category')) {
                $query->whereHas('book', function ($q) {
                    $q->where('category', request('category'));
                });
            }

            if ($request->filled('keyword')) {
                $query->whereHas('book', function ($q) {
                    $q->where('title', 'like', '%' . request('keyword') . '%');
                });
            }

            $borrowings = $query->orderBy('created_at', 'desc')->get();

            $filename = 'admin_borrowing_transactions_' . date('Y-m-d_H-i-s') . '.csv';

            $headers = array(
                "Content-type" => "text/csv; charset=UTF-8",
                "Content-Disposition" => "attachment; filename={$filename}",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $callback = function() use ($borrowings) {
                $file = fopen('php://output', 'w');
                
                if (!$file) {
                    throw new \Exception('Tidak dapat membuka output stream');
                }
                
                // BOM for UTF-8
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                
                // Header
                fputcsv($file, ['User', 'Email', 'Book Title', 'Author', 'Category', 'Borrow Date', 'Return Deadline', 'Return Date', 'Status', 'Fine (Rp)'], ';');

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
                        $borrowing->user->name,
                        $borrowing->user->email,
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
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengekspor data: ' . $e->getMessage());
        }
    }
}
