@extends('layouts.admin')

@section('content')
<div class="admin-header">
    <h1>Pengembalian Buku</h1>
    <p>Proses pengembalian buku dan ubah status transaksi</p>
</div>

<!-- Filter Section -->
<div class="filter-section" style="background-color: var(--color-bg-secondary); border-radius: 0.5rem; margin-bottom: 2rem; width: ;">
    
    <form method="GET" action="{{ route('admin.returns.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
        <!-- User Filter -->
        <div style="display: flex; flex-direction: column;">
            <input type="text" name="user" placeholder="Cari nama user" value="{{ request('user') }}" style="padding: 0.75rem; background-color: var(--color-bg); border: 1px solid var(--color-border); border-radius: 0.375rem; color: var(--color-text);">
        </div>

        <!-- Book Title Filter -->
        <div style="display: flex; flex-direction: column; ">
            <input type="text" name="book_title" placeholder="Cari judul buku" value="{{ request('book_title') }}" style="padding: 0.75rem; background-color: var(--color-bg); border: 1px solid var(--color-border); border-radius: 0.375rem; color: var(--color-text);">
        </div>

        <!-- Filter Button -->
        <div style="display: flex; gap: 0.5rem; ">
            <button type="submit" class="filter" style="padding: 0.75rem 1.5rem; background: #667eea; border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer;">
                Cari
            </button>
            @if(request()->hasAny(['book_title', 'user']))
                <a href="{{ route('admin.returns.index') }}" class="reset" style="padding: 0.75rem 1.5rem; background-color: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block;">Reset</a>
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Returns Table -->
<div style="background-color: var(--color-bg-secondary); border-radius: 0.5rem; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: rgba(102, 126, 234, 0.1); border-bottom: 2px solid var(--color-border);">
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">User</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Judul Buku</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Tgl Pinjam</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Deadline Kembali</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Denda</th>
                    <th style="padding: 1rem; text-align: center; color: var(--color-primary); font-weight: 600;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                    <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)'" onmouseout="this.style.backgroundColor = 'transparent'">
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->user->name }}</td>
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->book->title }}</td>
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->borrow_date ? $borrowing->borrow_date->format('d M Y') : 'N/A' }}</td>
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->return_deadline ? $borrowing->return_deadline->format('d M Y') : 'N/A' }}</td>
                        <td style="padding: 1rem;">
                            @php
                                $fine = 0;
                                if ($borrowing->status === 'BORROWED' && $borrowing->return_deadline && now() > $borrowing->return_deadline) {
                                    $days = now()->diffInDays($borrowing->return_deadline);
                                    $fine = abs($days) * 5000;
                                }
                            @endphp
                            <span style="padding: 0.5rem 1rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600; 
                                {{ $fine > 0 ? 'background-color: rgba(239, 68, 68, 0.2); color: #fca5a5;' : 'background-color: rgba(16, 185, 129, 0.2); color: #4ade80;' }}">
                                Rp {{ number_format($fine, 0, ',', '.') }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            @if($borrowing->status === 'BORROWED')
                                <form method="POST" action="{{ route('admin.borrowings.updateStatus', $borrowing->id) }}" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="RETURNED">
                                    <button type="submit" style="padding: 0.5rem 1rem; background-color: var(--color-success); border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; font-size: 0.85rem;">
                                        <i class="fas fa-check"></i> Terima
                                    </button>
                                </form>
                            @else
                                <span style="padding: 0.5rem 1rem; background-color: rgba(16, 185, 129, 0.2); color: #4ade80; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600;">
                                    Sudah Dikembalikan
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 2rem; text-align: center; color: var(--color-text-light);">
                            Tidak ada peminjaman yang sedang berlangsung
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($borrowings->hasPages())
        <div style="padding: 1.5rem; text-align: center; border-top: 1px solid var(--color-border);">
            {{ $borrowings->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
    :root {
        --color-primary: #667eea;
        --color-secondary: #764ba2;
        --color-danger: #ef4444;
        --color-success: #10b981;
        --color-bg: #ffffffff;
        --color-bg-secondary: #ffffffff;
        --color-text: #000000ff;
        --color-text-light: #696969ff;
        --color-border: #d8d8d8ff;
    }
    .filter:hover {
        background-color: #5a67d8 !important;
        color: white !important;
    }

    .reset:hover {
        background-color: #d1d5db !important;
        color: #1f2937 !important;
    }

    .filter-section input {
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .filter-section input:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
</style>
@endsection
