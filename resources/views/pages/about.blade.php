@extends('layouts.app')

@section('title', 'About Us')

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

    .team-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .team-member {
        background-color: #f9fafb;
        padding: 1.5rem;
        border-radius: 0.75rem;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .team-avatar {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .team-member h4 {
        color: #1f2937;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .team-member p {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .team-member span {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .values-list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-top: 1.5rem;
}


    .value-item {
        display: flex;
        gap: 1rem;
    }

    .value-icon {
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .value-text h4 {
        color: #1f2937;
        margin: 0 0 0.25rem 0;
    }

    .value-text p {
        color: #6b7280;
        margin: 0;
        font-size: 0.9rem;
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

        .team-section {
            grid-template-columns: 1fr;
        }

        .values-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-container">
    <!-- Header -->
    <div class="page-header">
        <h1>Tentang Kami</h1>
        <p>Mengenal lebih jauh tentang Perpustakaan Mini dan komitmen kami</p>
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

    <!-- Core Values -->
    <div class="content-section">
        <h2>Nilai-Nilai Inti</h2>
        <div class="values-list">
            <div class="value-item">
                <div class="value-icon"><i class="fas fa-book"></i></div>
                <div class="value-text">
                    <h4>Akses Pengetahuan</h4>
                    <p>Memastikan semua orang bisa mengakses buku</p>
                </div>
            </div>

            <div class="value-item">
                <div class="value-icon"><i class="fas fa-handshake"></i></div>
                <div class="value-text">
                    <h4>Kepercayaan</h4>
                    <p>Transparansi dalam setiap transaksi</p>
                </div>
            </div>

            <div class="value-item">
                <div class="value-icon"><i class="fas fa-bolt"></i></div>
                <div class="value-text">
                    <h4>Efisiensi</h4>
                    <p>Proses cepat dan mudah digunakan</p>
                </div>
            </div>

            <div class="value-item">
                <div class="value-icon"><i class="fas fa-wand-magic-sparkles"></i></div>
                <div class="value-text">
                    <h4>Inovasi</h4>
                    <p>Terus berkembang dan berinovasi</p>
                </div>
            </div>

            <div class="value-item">
                <div class="value-icon"><i class="fas fa-heart"></i></div>
                <div class="value-text">
                    <h4>Dedikasi</h4>
                    <p>Komitmen penuh kepada pengguna</p>
                </div>
            </div>

            <div class="value-item">
                <div class="value-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="value-text">
                    <h4>Pembelajaran</h4>
                    <p>Mendorong pertumbuhan melalui buku</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="content-section">
        <h2>Tim Pengembang</h2>
        <p>Tim yang mengembangkan sistem perpustakaan digital ini dengan dedikasi tinggi.</p>
        
        <div class="team-section">
            <div class="team-member">
                <div class="team-avatar" ><i class="fas fa-user-tie" style="color: #667eea"></i></div>
                <h4>Emil Prayoga Albani</h4>
                <p>2402510031</p>
                <span>Memimpin pengembangan sistem</span>
            </div>

            <div class="team-member">
                <div class="team-avatar"><i class="fas fa-user-cog" style="color: #667eea"></i></div>
                <h4>Wardatul Hasanah</h4>
                <p>2402510035</p>
                <span>Bertanggung jawab atas desain</span>
            </div>

            <div class="team-member">
                <div class="team-avatar"><i class="fas fa-paint-brush" style="color: #667eea"></i></div>
                <h4>Dela Ayu Wulandari</h4>
                <p>2402510037</p>
                <span>Dokumentasi dan pengelolaan sistem</span>
            </div>
        </div>
    </div>
@endsection