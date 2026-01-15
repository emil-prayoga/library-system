@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <div class="admin-header-top">
            <h1>Manajemen Pengguna</h1>
        </div>
        <p class="admin-subtitle">Kelola pengguna website dan izin akses</p>
    </div>

    <!-- Search Bar -->
    <div style=" border-radius: 0.75rem;  margin-bottom: 2rem; margin-top: 1.5rem;">
        <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; gap: 1rem;">
            <input type="text" name="search" placeholder="Cari berdasarkan nama atau email" value="{{ request('search') }}" style="flex: 1; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem;">
            <button type="submit" class="filter" style="padding: 0.75rem 1.25rem; background-color: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600;">Cari</button>
            @if($search ?? false)
                <a href="{{ route('admin.users.index') }}" class="reset" style="padding: 0.75rem 1.5rem; background-color: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block;">Reset</a>
            @endif
        </form>
    </div>

    <!-- Users Table -->
    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        @if ($users->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Nama</th>
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Role</th>
                            <th style="padding: 1rem; text-align: center; color: #1f2937; font-weight: 600;">Status</th>
                            <th style="padding: 1rem; text-align: center; color: #1f2937; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; color: #1f2937; font-weight: 500;">{{ $user->name }}</td>
                                <td style="padding: 1rem;">
                                    <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: {{ $user->is_admin ? '#fecaca' : '#d1fae5' }}; color: {{ $user->is_admin ? '#7f1d1d' : '#065f46' }}; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                        {{ $user->is_admin ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    @if ($user->isBlocked())
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #fee2e2; color: #991b1b; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                            <i class="fas fa-lock"></i> Diblokir
                                        </span>
                                    @else
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #dcfce7; color: #166534; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                            <i class="fas fa-check"></i> Aktif
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                        <a href="{{ route('admin.users.show', $user) }}" class="detail" style="padding: 0.5rem 1rem; background-color: #667eea; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 600; font-size: 0.875rem;">
                                            <i class="fas fa-file-alt"></i> Detail
                                        </a>
                                        @if (!$user->is_admin)
                                            @if ($user->isBlocked())
                                                <form action="{{ route('admin.users.unblock', $user) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" style="padding: 0.6rem 1rem; background-color: #10b981; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem;"><i class="fas fa-check"></i> Buka</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.users.block', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Blokir pengguna ini?');">
                                                    @csrf
                                                    <button type="submit" class="block" style="padding: 0.6rem 1rem; font-weight: 600; background-color: #f59e0b; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem;"><i class="fas fa-lock"></i> Blokir</button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus pengguna ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete" style="padding: 0.6rem 1rem; font-weight: 600; background-color: #ef4444; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-size: 0.875rem;"><i class="fas fa-trash"></i> Hapus</button>
                                            </form>
                                        @else
                                            <span style="padding: 0.5rem 1rem; color: #6b7280; font-size: 0.875rem;">Admin</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div style="padding: 1.5rem; border-top: 1px solid #e5e7eb;">
                    @include('components.pagination', ['paginator' => $users])
                </div>
            @endif
        @else
            <div style="padding: 3rem; text-align: center; color: #6b7280;">
                <p style="font-size: 1.125rem; margin-bottom: 0.5rem;">Tidak ada pengguna yang sesuai</p>
                <p>Coba ubah pencarian Anda.</p>
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

    .block:hover {
        background-color: #da900fff !important;
        color: white !important;
    }

    

    .delete:hover {
        background-color: #dc2626 !important;
        color: white !important;
    }   
    @media (max-width: 768px) {
        table {
            font-size: 0.875rem !important;
        }
        th, td {
            padding: 0.75rem !important;
        }
        div[style*="display: flex; gap: 0.5rem"] {
            flex-direction: column;
        }
        form {
            width: 100%;
        }
        button {
            width: 100%;
        }
    }
</style>

@endsection
