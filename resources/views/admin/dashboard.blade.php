@extends('layouts.admin')

@section('content')
<div class="admin-header">
    <h1>Admin Dashboard</h1>
    <p>Kelola semua transaksi peminjaman buku di sini</p>
</div>

<!-- Filter Section -->
<div class="filter-section" style="background-color: var(--color-bg-secondary); border-radius: 0.5rem; margin-bottom: 2rem;">
    
    <form method="GET" action="{{ route('admin.dashboard') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem; align-items: end;">
        <!-- Status Filter -->
        <div style="display: flex; flex-direction: column;">
            <select name="status" style="padding: 0.75rem; background-color: var(--color-bg); border: 1px solid var(--color-border); border-radius: 0.375rem; color: var(--color-text); font-size: 0.95rem;">
                <option value="">Semua Status</option>
                <option value="BORROWED" {{ request('status') === 'BORROWED' ? 'selected' : '' }}>BORROWED</option>
                <option value="RETURNED" {{ request('status') === 'RETURNED' ? 'selected' : '' }}>RETURNED</option>
            </select>
        </div>

        <!-- Category Filter -->
        <div style="display: flex; flex-direction: column; ">
            <select name="category" style="padding: 0.75rem; background-color: var(--color-bg); border: 1px solid var(--color-border); border-radius: 0.375rem; color: var(--color-text); font-size: 0.95rem;">
                <option value="">Semua Kategori</option>
                <option value="Fiction" {{ request('category') === 'Fiction' ? 'selected' : '' }}>Fiction</option>
                <option value="Non-Fiction" {{ request('category') === 'Non-Fiction' ? 'selected' : '' }}>Non-Fiction</option>
                <option value="Science" {{ request('category') === 'Science' ? 'selected' : '' }}>Science</option>
                <option value="Technology" {{ request('category') === 'Technology' ? 'selected' : '' }}>Technology</option>
                <option value="History" {{ request('category') === 'History' ? 'selected' : '' }}>History</option>
            </select>
        </div>

        <!-- Keyword Search -->
        <div style="display: flex; flex-direction: column;">
            <input type="text" name="keyword" placeholder="Judul buku" value="{{ request('keyword') }}" style="padding: 0.75rem; background-color: var(--color-bg); border: 1px solid var(--color-border); border-radius: 0.375rem; color: var(--color-text); font-size: 0.95rem;">
        </div>

        <div class="extra-actions">
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <button type="submit" class="filter" style="padding: 0.75rem 1.25rem; background: #667eea; border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; font-size: 0.9rem;">
                    Cari
                </button>
                @if(request()->hasAny(['status', 'category', 'keyword']))

                <a href="{{ route('admin.dashboard') }}" class="reset" style="padding: 0.75rem 1.25rem; background-color: #e5e7eb; color: #1f2937;  border: none; border-radius: 0.375rem; color: var(--color-text); text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                    Reset
                </a>
                @endif
                <a href="{{ route('admin.borrowings.export', request()->query()) }}"
                class="export" style="padding: 0.75rem 1.25rem; background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%); color: white; border-radius: 0.375rem; font-weight: 600; text-decoration: none; font-size: 0.9rem;">
                    Export CSV
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Transactions Table -->
<div style="background-color: var(--color-bg-secondary); border-radius: 0.5rem; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: rgba(255, 255, 255, 0.1); border-bottom: 2px solid var(--color-border);">
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">User</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Judul Buku</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Status</th>
                    <th style="padding: 1rem; text-align: center; color: var(--color-primary); font-weight: 600;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                    <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)'" onmouseout="this.style.backgroundColor = 'transparent'">
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->user->name }}</td>
                        <td style="padding: 1rem; color: var(--color-text);">{{ $borrowing->book->title }}</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.5rem 1rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600; white-space: nowrap;
                                {{ $borrowing->status === 'BORROWED' ? 'background-color: rgba(59, 130, 246, 0.2); color: #60a5fa;' : 'background-color: rgba(16, 185, 129, 0.2); color: #4ade80;' }}">
                                {{ $borrowing->status }}
                            </span>
                        </td>
                       <td style="padding: 1rem;">
    <div class="action-group">
        @if($borrowing->status === 'BORROWED')
            <form method="POST"
                  action="{{ route('admin.borrowings.updateStatus', $borrowing->id) }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="RETURNED">
                <button type="submit" class="kembalikan" style="padding: 0.6rem 1rem;background-color: var(--color-success); color: white; border: none; cursor: pointer;">
                    Kembalikan
                </button>
            </form>
        @else
            <button class="btn-disabled" disabled style="padding: 0.6rem 1rem;">
                Kembalikan
            </button>
        @endif

        <a href="{{ route('admin.borrowings.show', $borrowing->id) }}"
           class="detail" style="background: #667eea; color: white;">
            <i class="fas fa-file-alt"></i>
            <span>Detail</span>
        </a>
    </div>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 2rem; text-align: center; color: var(--color-text-light);">
                            Tidak ada transaksi ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

   
</div>

<style>
    :root {
        --color-primary: #667eea;
        --color-secondary: #764ba2;
        --color-danger: #ef4444;
        --color-bg-secondary: #ffffffff;
        --color-text: #000000ff;
        --color-text-light: #696969ff;
        --color-border: #d8d8d8ff;
        --color-edit: #10b981;
        --color-detail: #5a67d8;
        --hover-edit: #179b68ff;
    }

    .action-group {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

.action-group form {
    margin: 0;
}

.kembalikan,
.detail,
.btn-disabled {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    white-space: nowrap;
    border:none
}

.btn-disabled {
    background-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
    border: none;
}


    .filter:hover {
        background-color: #5a67d8 !important;
        color: white !important;
    }

    .export:hover {
        background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        color: white !important;
        opacity: 0.9;
    }

    .reset:hover {
        background-color: #d1d5db !important;
        color: #1f2937 !important;
    }


    .detail:hover {
        background-color: var(--color-detail) !important;
        color: white !important;
    }

    .kembalikan:hover {
        background-color: var(--hover-edit) !important;
        color: white !important;
    }

    .filter-section input,
    .filter-section select {
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .filter-section input:focus,
    .filter-section select:focus {
        outline: none;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    @media (max-width: 768px) {
        .filter-section form {
            grid-template-columns: 1fr !important;
        }

        .extra-actions {
            display: flex;
            justify-content: flex-start;
        }

        .action-group {
        flex-direction: column;
        align-items: stretch;
    }

    .action-group a,
    .action-group button {
        width: 100%;
        justify-content: center;
    }
    }

    
</style>
@endsection
