@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .welcome-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 2rem;
        border-radius: 1rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .welcome-section h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-weight: bold;
        color: white;
    }

    .welcome-section p {
        font-size: 1.25rem;
        opacity: 0.95;
        margin-bottom: 2rem;
    }

    .welcome-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .welcome-buttons .btn {
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-white {
        background-color: white;
        color: #667eea;
    }

    

    .btn-white:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

      .btn-secondary {
                background: var(--color-bg);
                color: var(--color-text);
                border: 1px solid var(--color-border);
            }

            .btn-secondary:hover {
                border-color: var(--color-primary);
                color: var(--color-primary);
            }

    .btn-outline {
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-outline:hover {
        background-color: white;
        color: #667eea;
    }

    .features-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .feature-card {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .feature-card h3 {
        color: #667eea;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }

    .feature-card p {
        color: #6b7280;
        line-height: 1.6;
    }

    .stats-section {
        background-color: #f3f4f6;
        padding: 3rem 2rem;
        border-radius: 1rem;
        margin-bottom: 3rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
    }

    .stat-item h4 {
        color: #667eea;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .stat-item p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .welcome-section {
            padding: 2.5rem 1.5rem;
        }

        .welcome-section h1 {
            font-size: 1.75rem;
        }

        .welcome-section p {
            font-size: 1rem;
        }

        .welcome-buttons {
            gap: 0.75rem;
        }

        .welcome-buttons .btn {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
        }

        .page-container {
            padding: 1.5rem 1rem;
        }
    }

    @media (max-width: 640px) {
        .welcome-section h1 {
            font-size: 1.5rem;
        }

        .welcome-section p {
            font-size: 0.95rem;
        }

        .welcome-buttons {
            flex-direction: column;
        }

        .welcome-buttons .btn {
            width: 100%;
            text-align: center;
        }

        .features-section {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>

<div class="page-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h1> <i class="fas fa-university"></i> Selamat datang di Perpustakaan Mini, {{ auth()->user()->name }}!</h1>
        <p>Platform digital untuk meminjam dan mengelola koleksi buku Anda dengan mudah</p>
        <div class="welcome-buttons">
            <a href="{{ route('books.index') }}" class="btn btn-white">
                <i class="fas fa-book"></i> Jelajahi Buku
            </a>
            <a href="{{ route('borrowings.index') }}" class="btn btn-outline">
                <i class="fas fa-book-open"></i> Peminjaman Saya
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-magnifying-glass"></i></div>
            <h3>Cari Buku Mudah</h3>
            <p>Temukan buku favorit Anda dengan fitur pencarian yang canggih dan filter kategori yang lengkap.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-paper-plane"></i></div>
            <h3>Peminjaman Cepat</h3>
            <p>Pinjam buku dalam satu klik dengan batas maksimal 3 buku sekaligus dan jangka waktu 7 hari.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-clock"></i></div>
            <h3>Notifikasi Deadline</h3>
            <p>Dapatkan notifikasi otomatis ketika deadline peminjaman Anda mendekati atau sudah jatuh tempo.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-money-bill-wave"></i></div>
            <h3>Transparansi Denda</h3>
            <p>Lihat perhitungan denda secara real-time jika ada keterlambatan pengembalian buku Anda.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
            <h3>Riwayat Lengkap</h3>
            <p>Akses riwayat peminjaman lengkap Anda kapan saja dan ekspor data untuk keperluan administrasi.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon"><i class="fas fa-handshake"></i></div>
            <h3>Dukungan Pelanggan</h3>
            <p>Tim support kami siap membantu menjawab pertanyaan Anda 24 jam sehari, 7 hari seminggu.</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <h4>1000+</h4>
                <p>Koleksi Buku</p>
            </div>
            <div class="stat-item">
                <h4>500+</h4>
                <p>Pengguna Aktif</p>
            </div>
            <div class="stat-item">
                <h4>5000+</h4>
                <p>Transaksi Bulanan</p>
            </div>
            <div class="stat-item">
                <h4>98%</h4>
                <p>Kepuasan Pelanggan</p>
            </div>
        </div>
    </div>
</div>

@endsection
