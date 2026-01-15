@extends('layouts.app')

@section('title', $book->title)

@section('content')
<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .back-link {
        display: inline-block;
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 2rem;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: #764ba2;
    }

    .book-detail-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .book-image-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .book-image-large {
        width: 100%;
        aspect-ratio: 3/4;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8rem;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        background-size: cover;
        background-position: center;
    }

    .book-image-large-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        font-size: 8rem;
        border-radius: 0.75rem;
    }

    .book-image-large:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .book-info-section {
        display: flex;
        flex-direction: column;
    }

    .book-info-section h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .book-meta-group {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .book-meta-item {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        font-size: 1rem;
    }

    .book-meta-label {
        font-weight: 600;
        color: #667eea;
        min-width: 120px;
    }

    .book-meta-value {
        color: #4b5563;
    }

    .book-stock-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .stock-available {
        background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
        color: white;
    }

    .stock-limited {
        background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
        color: white;
    }

    .stock-unavailable {
        background: linear-gradient(90deg, #ef4444 0%, #f87171 100%);
        color: white;
    }

    .description-section {
        margin-bottom: 2rem;
    }

    .description-section h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .description-text {
        color: #4b5563;
        line-height: 1.6;
        font-size: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .action-button {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary-action {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary-action {
        background-color: #e5e7eb;
        color: #4b5563;
    }

    .btn-secondary-action:hover {
        background-color: #d1d5db;
    }

    .btn-danger-action {
        background-color: #ef4444;
        color: white;
    }

    .btn-danger-action:hover {
        background-color: #dc2626;
    }

    .btn-disabled {
        background-color: #d1d5db;
        color: #6b7280;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .info-message {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
        font-size: 0.95rem;
    }

    .info-warning {
        background-color: #fef3c7;
        border-left: 4px solid #fcd34d;
        color: #78350f;
    }

    .admin-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #e5e7eb;
    }

    .admin-section h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 1rem;
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
        aspect-ratio: 3/4;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 0.75rem;
        font-size: 8rem;
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

    @media (max-width: 1024px) {
        .book-detail-container {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .book-info-section h1 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .book-info-section h1 {
            font-size: 1.75rem;
        }

        .book-image-large {
            font-size: 6rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .page-container {
            padding: 1.5rem 1rem;
        }

        .book-info-section h1 {
            font-size: 1.5rem;
        }

        .book-meta-label {
            min-width: auto;
        }

        .book-image-large {
            font-size: 4rem;
            min-height: 300px;
        }
    }
</style>

<div class="page-container">
    <div class="book-detail-container">
        <div class="book-image-section">
            <div class="book-image-large"  style="@if($book->cover)background-image: url('{{ asset('storage/' . $book->cover) }}');@endif">
                @if(!$book->cover)
                    <div class="book-image-large-placeholder"><i class="fas fa-book-open"></i></div>
                @endif
            </div>
        </div>

        <div class="book-info-section">
            <h1>{{ $book->title }}</h1>

            <div class="book-meta-group">
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-pen-nib"></i> Penulis:</span>
                    <span class="book-meta-value">{{ $book->author }}</span>
                </div>
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-book"></i> Kategori:</span>
                    <span class="book-meta-value">{{ $book->categoryModel?->name ?? 'Tidak ada kategori' }}</span>
                </div>
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-book-open"></i> ISBN:</span>
                    <span class="book-meta-value">{{ $book->isbn }}</span>
                </div>
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-calendar-days"></i> Terbit:</span>
                    <span class="book-meta-value">{{ $book->published_date->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            @php
                $stockClass = $book->stock > 2
                    ? 'stock-available'
                    : ($book->stock > 0 ? 'stock-limited' : 'stock-unavailable');

                $stockText = $book->stock > 0
                    ? "<i class='fas fa-chart-line'></i> {$book->stock} Tersedia"
                    : "<i class='fas fa-ban'></i> Stok Habis";
            @endphp

            <span class="book-stock-badge {{ $stockClass }}">
                {!! $stockText !!}
            </span>



            <div class="description-section">
                <h3><i class="fas fa-file-lines"></i> Deskripsi</h3>
                <p class="description-text">
                    {{ $book->description ?? 'Tidak ada deskripsi yang tersedia untuk buku ini.' }}
                </p>
            </div>

            @php
                $userBorrowedCount = auth()->check() ? auth()->user()->borrowings()->where('status', 'BORROWED')->count() : 0;
                $userAlreadyBorrowed = auth()->check() ? auth()->user()->borrowings()->where('book_id', $book->id)->where('status', 'BORROWED')->exists() : false;
            @endphp

            <div class="action-buttons">
                <button type="button" class="action-button btn-primary-action" onclick="window.location.href='{{ route('books.index') }}'">
                    ← Lihat Buku Lain
                </button>

                @if(auth()->check())
                    @if($userBorrowedCount >= 3)
                        <button class="action-button btn-disabled" disabled>
                            ⚠️ Limit Peminjaman (3/3)
                        </button>
                        <p class="info-message info-warning">
                            Anda sudah meminjam 3 buku (batas maksimal). Kembalikan salah satu buku terlebih dahulu untuk meminjam yang lain.
                        </p>
                    @elseif($userAlreadyBorrowed)
                        <button class="action-button btn-disabled" disabled>
                            <i class="fas fa-check"></i> Sudah Anda Pinjam
                        </button>
                        <p class="info-message info-warning">
                            Anda sudah meminjam buku ini. Cek halaman "Peminjaman Saya" untuk melihat detail.
                        </p>
                    @elseif($book->stock > 0)
                        <form method="POST" action="{{ route('borrowings.store') }}" style="flex: 1;">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="action-button btn-primary-action" style="width: 100%;">
                                <i class="fas fa-arrow-up"></i> Pinjam Sekarang
                            </button>
                        </form>
                        <p class="info-message" style="background-color: #dbeafe; border-left: 4px solid #3b82f6; color: #0c4a6e;">
                            <i class="fas fa-stopwatch"></i> Durasi peminjaman: 7 hari
                        </p>
                    @else
                        <button class="action-button btn-disabled" disabled>
                            ❌ Stok Habis
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="action-button btn-primary-action">
                        🔑 Login untuk Pinjam
                    </a>
                @endif
            </div>

            @auth
                @if(auth()->user()->isAdmin())
                    <div class="admin-section">
                        <h3>🔧 Manajemen Admin</h3>
                        <div class="action-buttons">
                            <a href="{{ route('admin.books.edit', $book) }}" class="action-button btn-primary-action">
                                ✏️ Edit Buku
                            </a>
                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button btn-danger-action" style="width: 100%;">
                                    🗑️ Hapus Buku
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
        <div><i class="fas fa-book-open"></i></div>
    </div>
</div>

@endsection
