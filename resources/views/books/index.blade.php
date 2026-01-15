@extends('layouts.app')

@section('title', 'Books')

@section('content')
<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .alert-box {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid;
    }

    .alert-warning {
        background-color: #fef3c7;
        border-left-color: #fcd34d;
        color: #78350f;
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

    .alert-box a {
        font-weight: 600;
        text-decoration: underline;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .book-card {
        background-color: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
    }

    .book-image {
        width: 100%;
        height: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        cursor: pointer;
        transition: opacity 0.3s ease;
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }

    .book-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-size: 4rem;
    }

    .book-image:hover {
        opacity: 0.8;
    }

    .book-image::after {
        position: absolute;
        font-size: 2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .book-image:hover::after {
        opacity: 1;
    }

    .book-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

     .reset:hover {
        background-color: #d1d5db !important;
        color: #1f2937 !important;
    }

    .filter:hover {
        background-color: #556cd6!important;
        color: white !important;
    }

    .book-meta {
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .book-meta strong {
        color: #4b5563;
    }

    .book-stock {
        display: inline-block;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .book-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: auto;
    }

    .book-actions button,
    .book-actions a {
        flex: 1;
        padding: 0.5rem 0.75rem;
        border: none;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        font-size: 0.85rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: #667eea;
        color: white;
    }

    .btn-view:hover {
        background: #5558d4;
    }

    .btn-borrow {
        background: #764ba2;
        color: white;
    }

    .btn-borrow:hover {
        background: #633987;
    }

    .btn-disabled {
        background: #d1d5db;
        color: #6b7280;
        cursor: not-allowed;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        animation: fadeIn 0.3s ease;
    }

    .lightbox.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-content {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 90%;
        max-width: 600px;
        height: 400px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 0.75rem;
        font-size: 6rem;
    }

    .lightbox-close {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .lightbox-close:hover {
        color: #ddd;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 1.75rem;
        }

        .books-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .book-image {
            height: 200px;
            font-size: 3rem;
        }

        .book-card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    }

    @media (max-width: 480px) {
        .page-container {
            padding: 1.5rem 1rem;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .books-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .book-image {
            height: 180px;
            font-size: 2.5rem;
        }

        .book-actions {
            flex-direction: column;
        }

        .book-actions button,
        .book-actions a {
            flex: none;
            width: 100%;
        }
    }
</style>

<div class="page-container">
    <div class="page-header">
        <h1><i class="fas fa-book"></i> Perpustakaan Buku</h1>
    </div>

    <!-- Search Bar -->
    <div style="background: white; padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <form method="GET" action="{{ route('books.index') }}" style="display: flex; gap: 1rem;">
            <input type="text" name="search" placeholder="Cari judul buku, pengarang, atau kategori..." 
                   value="{{ $search ?? '' }}" 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem;">
            <button type="submit" class="filter" style="padding: 0.75rem 1.5rem; background-color: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600;">
                 Cari
            </button>
            @if($search ?? false)
                <a href="{{ route('books.index') }}" class="reset" style="padding: 0.75rem 1.5rem; background-color: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @php
        $guestMode = session()->get('guest_mode');
        $userBorrowedCount = auth()->check() && !$guestMode ? auth()->user()->borrowings()->where('status', 'BORROWED')->count() : 0;
    @endphp

    @if($guestMode)
        <div class="alert-box alert-warning">
            <strong><i class="fas fa-eye"></i> Mode Guest</strong>
            <p>Anda sedang browsing dalam mode guest. <a href="{{ route('login') }}">Login</a> atau <a href="{{ route('register') }}">buat akun</a> untuk meminjam buku.</p>
        </div>
    @elseif(auth()->check() && $userBorrowedCount >= 3)
        <div class="alert-box alert-danger">
            <strong>Batas Peminjaman Tercapai</strong>
            <p>Anda sudah meminjam 3 buku (batas maksimal). Kembalikan salah satu buku terlebih dahulu sebelum meminjam yang lain.</p>
        </div>
    @endif

    <div class="books-grid">
        @forelse($books as $book)
            @php
                $userAlreadyBorrowed = auth()->check() && !$guestMode ? auth()->user()->borrowings()->where('book_id', $book->id)->where('status', 'BORROWED')->exists() : false;
            @endphp
            <div class="book-card">
                <div class="book-image" style="@if($book->cover)background-image: url('{{ asset('storage/' . $book->cover) }}');@endif">
                    @if(!$book->cover)
                        <div class="book-image-placeholder"><i class="fas fa-book-open"></i></div>
                    @endif
                </div>
                <div class="book-content">
                    <h3 class="book-title">{{ $book->title }}</h3>
                    <div class="book-meta">
                        <strong>Penulis:</strong> {{ $book->author }}
                    </div>
                    <div class="book-meta">
                        <strong>Kategori:</strong> {{ $book->categoryModel?->name ?? 'Tidak ada kategori' }}
                    </div>
                    <span class="book-stock"><i class="fas fa-chart-line"></i> {{ $book->stock }} tersedia</span>
                    <div class="book-actions">
                        <button class="btn-view" onclick="window.location.href='{{ route('books.show', $book) }}'">
                            Lihat Detail
                        </button>
                        @if($guestMode)
                            <a href="{{ route('login') }}" class="btn-borrow">Login Pinjam</a>
                        @elseif(auth()->check())
                            @if($userBorrowedCount >= 3)
                                <button class="btn-disabled" disabled title="Sudah 3 buku">Limit Tercapai</button>
                            @elseif($userAlreadyBorrowed)
                                <button class="btn-disabled" disabled title="Dipinjam">Dipinjam</button>
                            @elseif($book->stock > 0)
                                <form method="POST" action="{{ route('borrowings.store') }}" style="flex: 1;">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn-borrow" style="width: 100%; padding: 0.5rem 0.75rem;">Pinjam</button>
                                </form>
                            @else
                                <button class="btn-disabled" disabled>Stok Habis</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-borrow">Login Pinjam</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 1rem;">
                <p style="font-size: 1.1rem; color: #6b7280;"><i class="fas fa-book"></i> Tidak ada buku yang tersedia.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-container">
        @include('components.pagination', ['paginator' => $books])
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        
    </div>
</div>


@endsection
