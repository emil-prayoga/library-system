@extends('layouts.app')

@section('title', 'Contact Us')

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

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .contact-card {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .contact-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .contact-card h3 {
        color: #667eea;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }

    .contact-card p {
        color: #6b7280;
        margin: 0.5rem 0;
        line-height: 1.6;
    }

    .contact-card a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-card a:hover {
        color: #764ba2;
    }

    .contact-form-container {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .contact-form-container h2 {
        color: #667eea;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        font-family: inherit;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .submit-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .faq-section {
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 3rem;
    }

    .faq-section h2 {
        color: #667eea;
        margin-bottom: 2rem;
        font-size: 1.5rem;
    }

    .faq-item {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .faq-item:last-child {
        border-bottom: none;
    }

    .faq-question {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .faq-answer {
        color: #6b7280;
        line-height: 1.6;
        display: none;
    }

    .faq-answer.show {
        display: block;
    }

    .faq-toggle {
        display: inline-block;
        width: 24px;
        height: 24px;
        background-color: #667eea;
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .map-section {
        margin-top: 3rem;
        background-color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .map-section h2 {
        color: #667eea;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .map-placeholder {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        height: 400px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        text-align: center;
    }

    @media (max-width: 1024px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1.5rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        .contact-info {
            grid-template-columns: 1fr;
        }

        .page-container {
            padding: 1.5rem 1rem;
        }

        .map-placeholder {
            height: 300px;
        }
    }

    @media (max-width: 640px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .contact-form-container,
        .faq-section,
        .map-section {
            padding: 1.5rem;
        }
    }
</style>

<div class="page-container">
    <!-- Header -->
    <div class="page-header">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu menjawab pertanyaan Anda</p>
    </div>

    <!-- Contact Info & Form Grid -->
    <div class="contact-grid">
        <!-- Contact Info Column -->
        <div class="contact-info">
            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                <h3>Alamat</h3>
                <p>Jl. Perpustakaan No. 123</p>
                <p>Kota Sumenep, Jawa Timur 12345</p>
                <p>Indonesia</p>
            </div>

            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                <h3>Telepon</h3>
                <p><strong>Umum:</strong></p>
                <p>
                    <a href="tel:+62211234567">(021) 123-4567</a>
                </p>
                <p><strong>Support:</strong></p>
                <p>
                    <a href="tel:+62211234568">(021) 123-4568</a>
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                <h3>Email</h3>
                <p>
                    <a href="mailto:info@perpustakaan.local">info@perpustakaan.local</a>
                </p>
                <p>
                    <a href="mailto:support@perpustakaan.local">support@perpustakaan.local</a>
                </p>
                <p style="margin-top: 0.75rem; font-size: 0.9rem;">
                    <strong>Respon: 24 Jam</strong>
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                <h3>Jam Operasional</h3>
                <p><strong>Senin - Jumat:</strong></p>
                <p>09:00 - 17:00 WIB</p>
                <p style="margin-top: 0.75rem;"><strong>Sabtu:</strong></p>
                <p>10:00 - 14:00 WIB</p>
                <p style="margin-top: 0.75rem; color: #ea580c;"><strong>Minggu: Tutup</strong></p>
            </div>

            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-globe"></i></div>
                <h3>Media Sosial</h3>
                <p>
                    <a href="#">Facebook</a> | <a href="#">Instagram</a>
                </p>
                <p>
                    <a href="#">Twitter</a> | <a href="#">LinkedIn</a>
                </p>
            </div>

            <div class="contact-card">
                <div class="contact-icon"><i class="fas fa-comment-dots"></i></div>
                <h3>Chat Support</h3>
                <p>Hubungi kami langsung melalui live chat</p>
                <p>di website kami untuk bantuan cepat</p>
            </div>
        </div>

        <!-- Contact Form Column -->
        <div>
            <div class="contact-form-container">
                <h2>Kirim Pesan</h2>
                
                @if ($errors->any())
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
                        <p style="font-weight: 600; margin-bottom: 0.5rem;">Terjadi kesalahan:</p>
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
                        <p style="font-weight: 600; margin: 0;"><i class="fas fa-check"></i> {{ session('success') }}</p>
                    </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                        @error('name')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                        @error('email')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda" value="{{ old('phone') }}">
                        @error('phone')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" name="message" placeholder="Masukkan pesan Anda" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <h2>Pertanyaan Umum (FAQ)</h2>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span class="faq-toggle">+</span>
                Bagaimana cara meminjam buku?
            </div>
            <div class="faq-answer">
                Caranya sangat mudah! Cukup login ke akun Anda, pilih buku yang ingin dipinjam, dan klik tombol "Pinjam". 
                Anda dapat meminjam maksimal 3 buku sekaligus dengan jangka waktu 7 hari.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span class="faq-toggle">+</span>
                Berapa lama jangka waktu peminjaman?
            </div>
            <div class="faq-answer">
                Jangka waktu peminjaman adalah 7 hari dari tanggal peminjaman. Anda akan mendapatkan denda jika belum mengembalikan buku setelah peminjaman.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span class="faq-toggle">+</span>
                Apa itu denda keterlambatan?
            </div>
            <div class="faq-answer">
                Jika Anda mengembalikan buku setelah deadline, akan ada denda sebesar Rp 2.000 per hari untuk setiap 
                buku yang terlambat. Denda akan ditampilkan di sistem dan dapat dilihat di halaman "Borrowings".
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span class="faq-toggle">+</span>
                Apa yang harus dilakukan jika buku hilang atau rusak?
            </div>
            <div class="faq-answer">
                Silakan segera hubungi tim support kami untuk melaporkan kejadian tersebut. Anda mungkin perlu 
                mengganti buku dengan yang baru atau membayar kompensasi sesuai dengan nilai buku.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question" onclick="toggleFAQ(this)">
                <span class="faq-toggle">+</span>
                Bagaimana cara reset password?
            </div>
            <div class="faq-answer">
                Pada halaman login, klik link "Forgot Password". Masukkan email Anda, password baru, dan konfirmasi password. 
                Anda dapat langsung mengakses akun Anda setelah reset password berhasil.
            </div>
        </div>
    </div>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const toggle = element.querySelector('.faq-toggle');
        
        // Close other FAQs
        document.querySelectorAll('.faq-answer.show').forEach(item => {
            if (item !== answer) {
                item.classList.remove('show');
                item.previousElementSibling.querySelector('.faq-toggle').textContent = '+';
            }
        });

        // Toggle current FAQ
        answer.classList.toggle('show');
        toggle.textContent = answer.classList.contains('show') ? '−' : '+';
    }
</script>

@endsection
