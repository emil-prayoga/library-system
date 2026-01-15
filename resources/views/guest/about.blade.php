@extends('layouts.app')

@section('title', 'About - Guest Mode')

@section('content')
<style>
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 1rem;
        margin-bottom: 3rem;
        text-align: center;
    }

    .page-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: white;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .content-section {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .content-section h2 {
        color: #667eea;
        font-size: 1.75rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .content-section h3 {
        color: #1f2937;
        font-size: 1.25rem;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .content-section p {
        color: #4b5563;
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .mission-vision {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .mission-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .mission-card h3 {
        color: white;
        margin-top: 0;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .mission-card p {
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 0;
    }

    .features-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .feature-item {
        background-color: #f9fafb;
        padding: 1.5rem;
        border-radius: 0.75rem;
        border-left: 4px solid #667eea;
    }

    .feature-item h4 {
        color: #667eea;
        margin-top: 0;
        margin-bottom: 0.5rem;
    }

    .feature-item p {
        color: #6b7280;
        margin: 0;
        font-size: 0.95rem;
    }

    .cta-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 1rem;
        text-align: center;
        margin-top: 2rem;
    }

    .cta-section h2 {
        color: white;
        border-bottom: none;
        margin-bottom: 1rem;
    }

    .cta-section p {
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 1.5rem;
    }

    .cta-button {
        display: inline-block;
        background-color: white;
        color: #667eea;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1.5rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        .content-section {
            padding: 1.5rem;
        }

        .page-container {
            padding: 1.5rem 1rem;
        }
    }

    @media (max-width: 640px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .mission-vision {
            grid-template-columns: 1fr;
        }

        .features-section {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-container">
    <!-- Header -->
    <div class="page-header">
        <h1>Tentang Kami</h1>
        <p>Pelajari lebih lanjut tentang Perpustakaan Mini</p>
    </div>

    <!-- About Content -->
    <div class="content-section">
        <h2>Siapa Kami?</h2>
        <p>
            Perpustakaan Mini adalah platform digital modern yang didedikasikan untuk membuat akses koleksi buku 
            menjadi lebih mudah dan efisien. Kami percaya bahwa setiap orang berhak memiliki akses ke pengetahuan 
            dan hiburan melalui membaca.
        </p>
        <p>
            Dengan teknologi terkini dan desain yang user-friendly, kami menyediakan solusi manajemen perpustakaan 
            yang komprehensif untuk memenuhi kebutuhan peminjaman buku modern.
        </p>
    </div>

    <!-- Mission & Vision -->
    <div class="mission-vision">
        <div class="mission-card">
            <h3><i class="fas fa-bullseye"></i> Misi Kami</h3>
            <p>
                Menyediakan platform perpustakaan digital yang mudah digunakan dan terpercaya untuk meningkatkan 
                literasi masyarakat melalui akses buku yang lebih luas dan efisien.
            </p>
        </div>

        <div class="mission-card">
            <h3><i class="fas fa-star"></i> Visi Kami</h3>
            <p>
                Menjadi sistem perpustakaan terdepan yang menghubungkan pembaca dengan koleksi buku berkualitas 
                dan menciptakan komunitas literasi yang kuat.
            </p>
        </div>
    </div>

    <!-- Features -->
    <div class="content-section">
        <h2>Fitur Utama Kami</h2>
        <div class="features-section">
            <div class="feature-item">
                <h4><i class="fas fa-book"></i> Koleksi Lengkap</h4>
                <p>Ribuan buku dari berbagai kategori dan penulis terkemuka</p>
            </div>

            <div class="feature-item">
                <h4><i class="fas fa-magnifying-glass"></i> Pencarian Mudah</h4>
                <p>Temukan buku dengan fitur pencarian dan filter yang canggih</p>
            </div>

            <div class="feature-item">
                <h4><i class="fas fa-laptop-code"></i>  Platform Modern</h4>
                <p>Interface yang user-friendly dan responsif di semua perangkat</p>
            </div>

            <div class="feature-item">
                <h4><i class="fas fa-bolt"></i> Proses Cepat</h4>
                <p>Peminjaman dan pengembalian buku yang mudah dan transparan</p>
            </div>

            <div class="feature-item">
                <h4><i class="fas fa-chart-line"></i> Manajemen Transaksi</h4>
                <p>Pantau riwayat peminjaman dan deadline dengan mudah</p>
            </div>

            <div class="feature-item">
                <h4><i class="fas fa-handshake"></i> Dukungan 24/7</h4>
                <p>Tim customer support yang siap membantu kapan saja</p>
            </div>
        </div>
    </div>

    <!-- Why Join Us -->
    <div class="content-section">
        <h2>Mengapa Bergabung dengan Kami?</h2>
        <p>
            Perpustakaan Mini menawarkan pengalaman unik dalam dunia perpustakaan digital. Kami berkomitmen untuk 
            memberikan layanan terbaik dengan fokus pada kepuasan pelanggan dan inovasi berkelanjutan.
        </p>
        <h3><i class="fas fa-check"></i> Akses Pengetahuan Tanpa Batas</h3>
        <p>Nikmati akses ke koleksi buku yang terus berkembang setiap hari.</p>

        <h3><i class="fas fa-check"></i> Kemudahan Penggunaan</h3>
        <p>Platform kami dirancang untuk memberikan pengalaman yang intuitif dan menyenangkan bagi semua usia.</p>

        <h3><i class="fas fa-check"></i> Keamanan Data</h3>
        <p>Data pribadi Anda dijaga dengan sistem keamanan tingkat enterprise.</p>

        <h3><i class="fas fa-check"></i> Komunitas Pembaca</h3>
        <p>Bergabunglah dengan ribuan pembaca lain dan bagikan pengalaman membaca Anda.</p>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h2>Siap untuk Bergabung?</h2>
        <p>Login sekarang untuk membuka akses penuh ke semua fitur Perpustakaan Mini dan mulai peminjaman buku Anda!</p>
        <a href="{{ route('login') }}" class="cta-button">Login Sekarang</a>
    </div>
</div>

@endsection
