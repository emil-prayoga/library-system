@extends('layouts.app')

@section('title', 'My Borrowings')

@section('content')
<style>
    /* Borrowing page specific - make footer stick to bottom */

    body {
        display: flex !important;
        flex-direction: column !important;
        overflow-y: scroll !important;
    }

    main {
        flex: 1 !important;
    }

    .navbar {
        position: sticky !important;
        top: 0 !important;
        z-index: 100 !important;
    }

    main {
        max-width: 100% !important;
        padding: 0 !important;
    }

    .page-container {
    width: 100%;
    max-width: 1200px;
    padding: 2rem 1.5rem;
    margin: 0 auto;
}


    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin: 0;
    }

    .status-badge {
        background-color: #dbeafe;
        color: #0c4a6e;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
    }

    .alert-box {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid;
    }

    .alert-danger {
        background-color: #fef2f2;
        border-left-color: #fecaca;
        color: #991b1b;
    }

    .alert-box strong {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .alert-box p {
        margin: 0;
        font-size: 0.875rem;
    }

    .table-container {
        background-color: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        border-bottom: 2px solid #e5e7eb;
    }

    th {
        padding: 1rem;
        text-align: left;
        color: #667eea;
        font-weight: 600;
        font-size: 0.95rem;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
    }

    tbody tr {
        transition: background-color 0.3s ease;
    }

    tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }

    .book-title {
        font-weight: 600;
        color: #1f2937;
    }

    .min-h-screen {
        display: flex; 
        flex-direction: column; 
        min-height: 100vh;
    }

    .date-text {
        font-size: 0.9rem;
    }

    .status-badge-table {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 0.375rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-returned {
        background: rgba(16, 185, 129, 0.2);
        color: #059669;
    }

    .status-borrowed {
        background: rgba(59, 130, 246, 0.2);
        color: #2563eb;
    }

    .detail-button {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .detail-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        opacity: 0.95;
        color: white;
    }

    .detail-button:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(102, 126, 234, 0.3);
    }

    .return-button-disabled {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #d1d5db;
        color: #6b7280;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: inherit;
        cursor: not-allowed;
        opacity: 0.6;
    }
    

    .overdue-text {
        color: #dc2626;
        font-weight: 600;
    }

    .warning-text {
        color: #ea580c;
        font-weight: 600;
    }

    .success-text {
        color: #10b981;
        font-weight: 600;
    }

    .fine-text {
        font-weight: 600;
    }

    .fine-overdue {
        color: #dc2626;
    }

    .fine-clear {
        color: #10b981;
    }

    .action-button {
        padding: 0.6rem 1rem;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: inherit;
        cursor: not-allowed;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-state-text {
        font-size: 1.1rem;
        color: #6b7280;
        margin-bottom: 1.5rem;
    }

    .empty-state-link {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        th, td {
            padding: 0.75rem 0.5rem;
            font-size: 0.9rem;
        }

        th {
            font-size: 0.85rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .action-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .page-container {
            padding: 1.5rem 1rem;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .table-container {
            border-radius: 0.5rem;
        }

        th, td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
        }

        th {
            font-size: 0.75rem;
        }

        .date-text {
            font-size: 0.75rem;
        }

        .status-badge {
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h1><i class="fas fa-book-open"></i> Peminjaman Saya</h1>
        @php
            $activeBorrowings = $borrowings->filter(fn($b) => $b->status === 'BORROWED')->count();
        @endphp
        <div class="status-badge">
            <i class="fas fa-chart-line"></i> Aktif: {{ $activeBorrowings }}/3
        </div>
    </div>

    @if($activeBorrowings >= 3)
        <div class="alert-box alert-danger">
            <strong><i class="fas fa-triangle-exclamation"></i> Batas Peminjaman Penuh</strong>
            <p>Anda sudah meminjam 3 buku (batas maksimal). Kembalikan salah satu buku untuk meminjam yang lain.</p>
        </div>
    @endif

    @if($borrowings->isEmpty())
        <div style="text-align: center; padding: 3rem 1rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;"><i class="fas fa-book"></i></div>
            <p style="font-size: 1.1rem; color: #6b7280; margin-bottom: 1.5rem;">
                Anda belum meminjam buku apapun.
            </p>
            <a href="{{ route('books.index') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 0.5rem; font-weight: 600;">
                <i class="fas fa-magnifying-glass"></i> Jelajahi Buku
            </a>
        </div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowings as $borrowing)
                        @php
                            $isOverdue = $borrowing->status === 'BORROWED' && $borrowing->return_deadline && now()->isAfter($borrowing->return_deadline);
                            $daysUntilDeadline = $borrowing->return_deadline
                                ? now()->startOfDay()->diffInDays(
                                    $borrowing->return_deadline->startOfDay(),
                                    false
                                )
                                : null;
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('books.show', $borrowing->book) }}" style="color: #667eea; text-decoration: none; font-weight: 600; transition: color 0.3s;" onmouseover="this.style.color='#764ba2'" onmouseout="this.style.color='#667eea'">
                                    {{ $borrowing->book->title }}
                                </a>
                            </td>
                           
                            <td>
                                <span class="status-badge-table {{ $borrowing->status === 'RETURNED' ? 'status-returned' : 'status-borrowed' }}">
                                    {{ $borrowing->status === 'RETURNED' ? 'RETURNED' : ' BORROWED' }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('borrowings.show', $borrowing) }}" class="detail-button">
                                        <i class="fas fa-file-alt"></i> Detail
                                    </a>
                                    @if($borrowing->status === 'BORROWED')
                                        <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-button">
                                                <i class="fas fa-redo"></i> Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="return-button-disabled" disabled>
                                           <i class="fas fa-redo"></i> Kembalikan
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
    @media (max-width: 768px) {
        table {
            font-size: 0.9rem;
        }
        
        table th,
        table td {
            padding: 0.75rem !important;
        }
        
        h1 {
            font-size: 1.5rem !important;
        }
    }

    @media (max-width: 640px) {
        table {
            font-size: 0.85rem;
        }
        
        table th,
        table td {
            padding: 0.5rem !important;
        }

        button {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    }
</style>
@endsection