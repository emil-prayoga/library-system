<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminBorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('manage-borrowings')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        // Filter by keyword (title)
        if ($request->filled('keyword')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%');
            });
        }

        $borrowings = $query->latest()->paginate(15);
        $categories = \App\Models\Book::distinct()->pluck('category');

        return view('admin.borrowings.index', compact('borrowings', 'categories'));
    }

    public function updateStatus(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'status' => 'required|in:BORROWED,RETURNED',
        ]);

        $oldStatus = $borrowing->status;
        $borrowing->status = $request->status;

        // Jika diubah ke RETURNED, set return_date dan hitung denda
        if ($request->status === 'RETURNED' && $oldStatus === 'BORROWED') {
            $borrowing->return_date = now();
            $fine = $borrowing->calculateFine();
            $borrowing->setAttribute('fine', $fine);
            $borrowing->book->incrementStock();
        }

        // Jika diubah kembali ke BORROWED dari RETURNED
        if ($request->status === 'BORROWED' && $oldStatus === 'RETURNED') {
            $borrowing->return_date = null;
            $borrowing->setAttribute('fine', 0);
            $borrowing->book->decrementStock();
        }

        $borrowing->save();

        return back()->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        // Apply same filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('category', $request->category);
            });
        }

        if ($request->filled('keyword')) {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%');
            });
        }

        $borrowings = $query->get();

        $filename = 'borrowings_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($borrowings) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, ['ID', 'Peminjam', 'Email', 'Judul Buku', 'Kategori', 'Tanggal Pinjam', 'Deadline', 'Tanggal Kembali', 'Status', 'Denda (Rp)']);

            // Data
            foreach ($borrowings as $b) {
                fputcsv($file, [
                    $b->id,
                    $b->user->name,
                    $b->user->email,
                    $b->book->title,
                    $b->book->category,
                    $b->borrow_date->format('Y-m-d'),
                    $b->return_deadline->format('Y-m-d'),
                    $b->return_date ? $b->return_date->format('Y-m-d') : '-',
                    $b->status,
                    number_format((float) $b->fine, 0, ',', '.'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}