@extends('layouts.app')

@section('title', $book->title . ' - Guest View')

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

    .book-image-large:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
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
        background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
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

    .alert-box {
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-top: 2rem;
        border-left: 4px solid #fcd34d;
        background-color: #fef3c7;
        color: #78350f;
    }

    .alert-box h3 {
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .alert-box p {
        margin: 0.5rem 0;
    }

    .alert-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .alert-btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background-color: #e5e7eb;
        color: #4b5563;
    }

    .btn-secondary:hover {
        background-color: #d1d5db;
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

        .alert-buttons {
            flex-direction: column;
        }

        .alert-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="page-container">
    <div class="book-detail-container">
        <div class="book-image-section">
            <div class="book-image-large" style="@if($book->cover)background-image: url('{{ asset('storage/' . $book->cover) }}');@endif">
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
                    <span class="book-meta-value">{{ $book->category }}</span>
                </div>
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-book-open"></i> ISBN:</span>
                    <span class="book-meta-value">{{ $book->isbn ?? 'N/A' }}</span>
                </div>
                <div class="book-meta-item">
                    <span class="book-meta-label"><i class="fas fa-calendar-days"></i> Terbit:</span>
                    <span class="book-meta-value">{{ $book->published_date->translatedFormat('d F Y') ?? $book->year }}</span>
                </div>
                @if($book->publisher)
                    <div class="book-meta-item">
                        <span class="book-meta-label"><i class="fas fa-building"></i> Penerbit:</span>
                        <span class="book-meta-value">{{ $book->publisher }}</span>
                    </div>
                @endif
            </div>

            <span class="book-stock-badge">
                <i class="fas fa-chart-line"></i> {{ $book->stock }} Tersedia
            </span>

            @if($book->description)
                <div class="description-section" style="margin: 0">
                    <h3><i class="fas fa-file-lines"></i> Deskripsi</h3>
                    <p class="description-text">{{ $book->description }}</p>
                </div>
            @endif

             <a href="{{ route('guest.dashboard') }}" class="btn btn-primary" style="width: 100px; ">Kembali</a>

            <!-- Guest Mode Alert -->
            <div class="alert-box">
                <h3><i class="fas fa-eye"></i> Mode Guest - Peminjaman Tidak Tersedia</h3>
                <p>Anda perlu login atau membuat akun untuk meminjam buku ini dan mengelola peminjaman Anda.</p>
                <div class="alert-buttons">
                    <a href="{{ route('login') }}" class="alert-btn btn-primary"> <i class="fas fa-right-to-bracket"></i> Login</a>
                    <a href="{{ route('register') }}" class="alert-btn btn-secondary"> <i class="fas fa-user-plus"></i>  Buat Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
