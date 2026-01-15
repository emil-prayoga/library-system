@extends('layouts.app')

@section('content')
<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .detail-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
    }

    .detail-header h1 {
        margin: 0 0 0.5rem 0;
        font-size: 2rem;
        color: white;
    }

    .detail-header p {
        margin: 0;
        opacity: 0.9;
    }

    .detail-card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .detail-card h2 {
        background-color: #f9fafb;
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        margin: 0;
        font-size: 1.25rem;
        color: #1f2937;
    }

    .detail-content {
        padding: 2rem;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-table td:first-child {
        padding: 1rem;
        width: 35%;
        font-weight: 600;
        color: #667eea;
        background-color: #f9fafb;
    }

    .detail-table td:last-child {
        padding: 1rem;
        color: #1f2937;
    }

    .badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .badge-primary {
        background-color: #f0f4ff;
        color: #667eea;
    }

    .badge-success {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background-color: #667eea;
        color: white;
    }

    .btn-primary:hover {
        background-color: #5a67d8;
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

    

    .btn-danger {
        background-color: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }

    @media (max-width: 768px) {
        .detail-container {
            padding: 1rem;
        }

        .detail-header {
            padding: 1.5rem;
        }

        .detail-header h1 {
            font-size: 1.5rem;
        }

        .detail-content {
            padding: 1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1><i class="fas fa-book-open"></i> Detail Peminjaman</h1>
        <p>Informasi lengkap tentang peminjaman buku</p>
    </div>

    <!-- Book Information -->
    <div class="detail-card">
        <h2><i class="fas fa-book"></i> Informasi Buku</h2>
        <div class="detail-content">
            <table class="detail-table">
                <tr>
                    <td>Judul Buku</td>
                    <td>
                        <strong>{{ $borrowing->book->title }}</strong>
                    </td>
                </tr>
                <tr>
                    <td>Pengarang</td>
                    <td>{{ $borrowing->book->author }}</td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td>{{ $borrowing->book->publisher }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>
                        <span class="badge badge-primary">
                            {{ $borrowing->book->categoryModel?->name ?? '-' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td>{{ $borrowing->book->year ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Borrowing Information -->
    <div class="detail-card">
        <h2><i class="fas fa-list"></i> Informasi Peminjaman</h2>
        <div class="detail-content">
            <table class="detail-table">
                <tr>
                    <td>ID Peminjaman</td>
                    <td>#{{ $borrowing->id }}</td>
                </tr>
                <tr>
                    <td>Tanggal Peminjaman</td>
                    <td>{{ $borrowing->borrow_date?->format('d M Y') ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Deadline Pengembalian</td>
                    <td>
                        @if($borrowing->return_deadline)
                            @php
                                $isOverdue = $borrowing->status === 'BORROWED' && now()->isAfter($borrowing->return_deadline);
                            @endphp
                            <span style="color: {{ $isOverdue ? '#ef4444' : '#1f2937' }}; font-weight: 600;">
                                {{ $borrowing->return_deadline->format('d M Y') }}
                            </span>
                            @if($isOverdue)
                                <span class="badge badge-danger" style="margin-left: 0.5rem;">
                                    <i class="fas fa-circle"></i> Terlambat
                                </span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pengembalian</td>
                    <td>{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        @if($borrowing->status === 'RETURNED')
                            <span class="badge badge-success">
                                <i class="fas fa-check"></i> Dikembalikan
                            </span>
                        @elseif($borrowing->status === 'BORROWED' && now()->isAfter($borrowing->return_deadline ?? now()->addDay()))
                            <span class="badge badge-danger">
                                <i class="fas fa-circle"></i> Terlambat
                            </span>
                        @else
                            <span class="badge badge-warning">
                                <i class="fas fa-hourglass-end"></i> Sedang Dipinjam
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Denda</td>
                    <td>
                        @if($borrowing->fine > 0)
                            <span style="font-weight: 600; color: #dc2626;">Rp {{ number_format($borrowing->fine, 0, ',', '.') }}</span>
                        @else
                            <span style="font-weight: 600; color: #10b981;">Rp 0</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('borrowings.index') }}" class="btn btn-primary" style="margin:0 auto; justify-items: center;">
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
