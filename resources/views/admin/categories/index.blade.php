@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <div class="admin-header-top">
            <h1>Manajemen Kategori</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn-add">
                <span class="btn-plus">+</span> Tambah Kategori
            </a>
        </div>
        <p class="admin-subtitle">Kelola kategori buku untuk organisasi</p>
    </div>

    

    <!-- Success Message -->
    @if (session('success'))
        <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.375rem; margin-bottom: 2rem;">
            <p style="font-weight: 600; margin: 0;"><i class="fas fa-check"></i> {{ session('success') }}</p>
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 2rem;">
            <p style="font-weight: 600; margin: 0;"><i class="fas fa-times"></i> {{ session('error') }}</p>
        </div>
    @endif

    <!-- Categories Table -->
    <div style="border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        @if ($categories->count() > 0)
            <div style="overflow-x: auto;">
                <table class="details-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Nama Kategori</th>
                            <th style="padding: 1rem; text-align: center; color: #1f2937; font-weight: 600;">Status</th>
                            <th style="padding: 1rem; text-align: center; color: #1f2937; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem;">
                                    <div style="font-weight: 600; color: #1f2937;">{{ $category->name }}</div>
                                </td>
                               
                                <td style="padding: 1rem; text-align: center;">
                                    @if (($category->books_count ?? 0) > 0)
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #dcfce7; color: #166534; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                            Aktif
                                        </span>
                                    @else
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #fee2e2; color: #991b1b; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                            Kosong
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                        <a href="{{ route('admin.categories.show', $category) }}" class="detail" style="padding: 0.5rem 1rem; background-color: #667eea; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 600; font-size: 0.875rem;">
                                            <i class="fas fa-file-alt"></i> Detail
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="edit" style="padding: 0.5rem 1rem; background-color: #10b981; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 600; font-size: 0.875rem;">
                                             <i class="fas fa-edit"></i> Edit
                                        </a>
                                        @if (($category->books_count ?? 0) === 0)
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete" style="padding: 0.6rem 1rem; background-color: #ef4444; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; font-size: 0.875rem;">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @else
                                            <button disabled style="padding: 0.5rem 1rem; background-color: #d1d5db; color: #6b7280; border: none; border-radius: 0.375rem; cursor: not-allowed; font-weight: 600; font-size: 0.875rem;" title="Tidak bisa dihapus karena ada buku">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 3rem; text-align: center; color: #6b7280;">
                <p style="font-size: 1.125rem; margin-bottom: 0.5rem;">Belum ada kategori</p>
                <p style="margin-bottom: 1.5rem;">Mulai dengan membuat kategori baru untuk mengorganisir koleksi buku Anda.</p>
                <a href="{{ route('admin.categories.create') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #667eea; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 600;">
                    + Buat Kategori Pertama
                </a>
            </div>
        @endif
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

    .admin-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .admin-header-top {
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .admin-header-top h1 {
            flex: 1;
            min-width: auto;
        }

        .btn-add {
            white-space: nowrap;
        }
        table {
            font-size: 0.875rem !important;
        }
        th, td {
            padding: 0.75rem !important;
        }
        div[style*="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap"] {
            flex-direction: column !important;
        }
        div[style*="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap"] a,
        div[style*="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap"] button,
        div[style*="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap"] form {
            width: 100% !important;
        }
    }
</style>

@endsection
