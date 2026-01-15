@extends('layouts.admin')

@section('content')
<style>
    .detail-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    .detail-table tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-table td {
        padding: 1rem;
    }

    .detail-table td:first-child {
        width: 30%;
        font-weight: 600;
        color: #667eea;
        background-color: #f9fafb;
    }

    .detail-table td:last-child {
        color: #1f2937;
    }

    .badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        font-weight: 600;
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
</style>

<div class="admin-header">
    <h1>Detail Peminjaman</h1>
    <p>Informasi peminjaman buku</p>
</div>

<!-- Detail Card -->
<div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-top: 1.5rem;">
    <table class="detail-table">
        <!-- User Information -->
        <tr>
            <td>Nama Pengguna</td>
            <td>{{ $borrowing->user->name }}</td>
        </tr>
        <tr>
            <td>Email Pengguna</td>
            <td>{{ $borrowing->user->email }}</td>
        </tr>

        <!-- Book Information -->
        <tr>
            <td>Judul Buku</td>
            <td><strong>{{ $borrowing->book->title }}</strong></td>
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
            <td>{{ $borrowing->book->category }}</td>
        </tr>

        <!-- Borrowing Information -->
        <tr>
            <td>ID Peminjaman</td>
            <td>#{{ $borrowing->id }}</td>
        </tr>
        <tr>
            <td>Tanggal Peminjaman</td>
            <td>{{ $borrowing->borrow_date?->format('d M Y') ?? 'Belum Dikembalikan' }}</td>
        </tr>
        <tr>
            <td>Deadline Pengembalian</td>
            <td>
                @if($borrowing->return_deadline)
                    @php
                        $isOverdue = $borrowing->status === 'BORROWED' && now()->isAfter($borrowing->return_deadline);
                    @endphp
                    <span style="color: {{ $isOverdue ? '#dc2626' : '#1f2937' }}; font-weight: 600;">
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

<!-- Action Buttons -->
 <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
   
    <a href="{{ route('admin.dashboard') }}" class="button">
         Kembali
    </a>
</div>
@endsection
<style>
        .button {
        padding: 0.75rem 1.5rem;
        background-color: #667eea;
        color: white;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
        text-align: center;
    }

    .button:hover {
        background-color: #5a67d8;
        color: white;
    }

    @media (max-width: 768px) {
        .admin-header  {
            text-align: right;
            flex-direction: column;
        }
    }
</style>