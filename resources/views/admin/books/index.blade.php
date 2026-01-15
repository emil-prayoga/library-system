@extends('layouts.admin')

@section('content')
<div class="admin-header">
    <div class="admin-header-top">
        <h1>Manajemen Buku</h1>

        <a href="{{ route('admin.books.create') }}" class="btn-add">
            <span class="btn-plus">+</span> Tambah Buku
        </a>
    </div>

    <p class="admin-subtitle">
        Tambah, edit, atau hapus buku dari sistem
    </p>
</div>



<!-- Search Bar -->
<div style="border-radius: 0.75rem; margin-bottom: 2rem; margin-top: 1.5rem;">
    <form action="{{ route('admin.books.index') }}" method="GET" style="display: flex; gap: 1rem;">
        <input type="text" name="search" placeholder="Cari judul buku, pengarang, penerbit, atau kategori" 
               value="{{ $search ?? '' }}" 
               style="flex: 1; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem;">
        <button type="submit" class="filter" style="padding: 0.75rem 1.5rem; background-color: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600;">
             Cari
        </button>
        @if($search ?? false)
            <a href="{{ route('admin.books.index') }}" class="reset" style="padding: 0.75rem 1.5rem; background-color: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block;">
                Reset
            </a>
        @endif
    </form>
</div>



<!-- Books Table -->
<div style="background-color: var(--color-bg-secondary); border-radius: 0.5rem; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: rgba(102, 126, 234, 0.1); border-bottom: 2px solid var(--color-border);">
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Judul</th>
                    <th style="padding: 1rem; text-align: left; color: var(--color-primary); font-weight: 600;">Kategori</th>
                    <th style="padding: 1rem; text-align: center; color: var(--color-primary); font-weight: 600;">Stok</th>
                    <th style="padding: 1rem; text-align: center; color: var(--color-primary); font-weight: 600;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr style="border-bottom: 1px solid var(--color-border); transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)'" onmouseout="this.style.backgroundColor = 'transparent'">
                        <td style="padding: 1rem; color: var(--color-text);">
                            <strong>{{ $book->title }}</strong>
                        </td>
                        <td style="padding: 1rem; color: var(--color-text-light);">{{ $book->categoryModel?->name ?? '-' }}</td>
                        <td style="padding: 1rem; text-align: center;">
                            <span style="padding: 0.5rem 1rem; background-color: rgba(102, 126, 234, 0.2); color: var(--color-primary); border-radius: 0.375rem; font-weight: 600;">
                                {{ $book->stock }}
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;">
                            <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('admin.books.show', $book->id) }}" class="detail" style="padding: 0.5rem 1rem; background-color: var(--color-primary); border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; text-decoration: none; font-size: 0.85rem;">
                                    <i class="fas fa-file-alt"></i> Detail
                                </a>
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="edit" style="padding: 0.5rem 1rem; background-color: var(--color-edit); border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; text-decoration: none; font-size: 0.85rem;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}" onsubmit="return confirm('Hapus buku ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete" style="padding: 0.6rem 1rem; background-color: var(--color-danger); border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; font-size: 0.85rem;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 2rem; text-align: center; color: var(--color-text-light);">
                            Tidak ada buku ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($books->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid var(--color-border);">
            @include('components.pagination', ['paginator' => $books])
        </div>
    @endif
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

    .filter:hover {
        background-color: #5a67d8 !important;
        color: white !important;
    }

    .reset:hover {
        background-color: #d1d5db !important;
        color: #1f2937 !important;
    }

    .detail:hover {
        background-color: var(--color-detail) !important;
        color: white !important;
    }

    .edit:hover {
        background-color: var(--hover-edit) !important;
        color: white !important;
    }

    .delete:hover {
        background-color: #dc2626 !important;
        color: white !important;
    }   
</style>
@endsection
