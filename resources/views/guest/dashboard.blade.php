@extends('layouts.app')

@section('title', 'Guest - Browse Books')

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
        margin: 0;
    }

    .page-header p {
        color: #6b7280;
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
    }

    .guest-status {
        background-color: #dbeafe;
        color: #0c4a6e;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        text-align: center;
        font-weight: 600;
    }

    .alert-box {
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .alert-warning {
        background-color: #fef3c7;
        border-left-color: #fcd34d;
        color: #78350f;
    }

    .alert-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .alert-content p {
        margin: 0;
    }

    .alert-content p:first-child {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .alert-content a {
        color: #78350f;
        text-decoration: underline;
        font-weight: 600;
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

    .book-image:hover {
        opacity: 0.8;
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
        margin-top: auto;
    }

    .btn-view {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #667eea;
        color: white;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .btn-view:hover {
        color: white;
        background: #5558d4;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem 1rem;
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
    }
</style>

<div class="page-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
        <div class="page-header">
            <h1><i class="fas fa-book"></i> Jelajahi Perpustakaan</h1>
            <p>Mode Guest - Browsing tanpa membuat akun</p>
        </div>
        <div class="guest-status">
            <div><i class="fas fa-eye"></i> Mode Guest</div>
            <div style="font-size: 0.875rem; margin-top: 0.5rem;">
                <a href="{{ route('guest.logout') }}" style="color: #0c4a6e; text-decoration: underline;">Keluar</a>
                atau
                <a href="{{ route('login') }}" style="color: #0c4a6e; text-decoration: underline;">Login</a> untuk pinjam
            </div>
        </div>
    </div>

    <div class="alert-box alert-warning">
        <span class="alert-icon"><i class="fas fa-circle-info"></i></span>
        <div class="alert-content">
            <p>Mode Guest - Peminjaman Tidak Tersedia</p>
            <p>Anda sedang browsing dalam mode guest. Untuk meminjam buku dan mengelola peminjaman Anda, silakan <a href="{{ route('login') }}">login</a> atau <a href="{{ route('register') }}">buat akun</a>.</p>
        </div>
    </div>

    <div class="books-grid">
        @forelse($books as $book)
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
                        <strong>Kategori:</strong> {{ $book->category }}
                    </div>
                    <span class="book-stock"><i class="fas fa-chart-line"></i> {{ $book->stock }} tersedia</span>
                    <div class="book-actions">
                        <a href="{{ route('guest.show', $book) }}" class="btn-view">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p style="font-size: 1.1rem; color: #6b7280;"><i class="fas fa-book"></i> Tidak ada buku yang tersedia.</p>
            </div>
        @endforelse
    </div>

  

    
    <div class="pagination-container">
        @include('components.pagination', ['paginator' => $books])
    </div>
</div>
@endsection
