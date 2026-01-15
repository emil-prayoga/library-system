@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <div class="admin-header-top">
            <h1>Manajemen Pesan</h1>
        </div>
        <p class="admin-subtitle">Kelola pesan dari pengunjung website</p>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; margin-top: 1.5rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #ffffff; font-size: 0.875rem; margin: 0;">Total Pesan</p>
            <p style="font-size: 2rem; font-weight: bold; color: #ffffff; margin: 0.5rem 0;">{{ $totalMessages }}</p>
        </div>
        <div style="background:  linear-gradient(135deg, #e9a443ff 0%, #f9dc38ff 100%); padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #ffffff; font-size: 0.875rem; margin: 0;">Belum Dibaca</p>
            <p style="font-size: 2rem; font-weight: bold; color: #ffffff; margin: 0.5rem 0;">{{ $unreadMessages }}</p>
        </div>
        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 1.5rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <p style="color: #ffffff; font-size: 0.875rem; margin: 0;">Sudah Dibaca</p>
            <p style="font-size: 2rem; font-weight: bold; color: #fff; margin: 0.5rem 0;">{{ $readMessages }}</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div style=" border-radius: 0.75rem;  margin-bottom: 2rem;">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('admin.messages.index') }}" 
               style="padding: 0.75rem 1.5rem; border-radius: 0.375rem; border: 2px solid {{ !$status ? '#667eea' : '#e5e7eb' }}; background-color: {{ !$status ? '#667eea' : 'transparent' }}; color: {{ !$status ? 'white' : '#1f2937' }}; text-decoration: none; font-weight: 600; transition: all 0.3s ease; cursor: pointer;">
                Semua ({{ $totalMessages }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}"
               style="padding: 0.75rem 1.5rem; border-radius: 0.375rem; border: 2px solid {{ $status === 'unread' ? '#f59e0b' : '#e5e7eb' }}; background-color: {{ $status === 'unread' ? '#f59e0b' : 'transparent' }}; color: {{ $status === 'unread' ? 'white' : '#1f2937' }}; text-decoration: none; font-weight: 600; transition: all 0.3s ease; cursor: pointer;">
                Belum Dibaca ({{ $unreadMessages }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'read']) }}"
               style="padding: 0.75rem 1.5rem; border-radius: 0.375rem; border: 2px solid {{ $status === 'read' ? '#10b981' : '#e5e7eb' }}; background-color: {{ $status === 'read' ? '#10b981' : 'transparent' }}; color: {{ $status === 'read' ? 'white' : '#1f2937' }}; text-decoration: none; font-weight: 600; transition: all 0.3s ease; cursor: pointer;">
                Sudah Dibaca ({{ $readMessages }})
            </a>
        </div>
    </div>

    <!-- Messages Table -->
    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
        @if ($messages->count() > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Nama</th>
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Status</th>
                            <th style="padding: 1rem; text-align: left; color: #1f2937; font-weight: 600;">Tanggal</th>
                            <th style="padding: 1rem; text-align: center; color: #1f2937; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr style="border-bottom: 1px solid #e5e7eb; {{ $message->status === 'unread' ? 'background-color: #ffffffff;' : '' }}">
                                <td style="padding: 1rem;">
                                    <div style="font-weight: {{ $message->status === 'unread' ? '600' : '400' }}; color: #1f2937;">{{ $message->name }}</div>
                                </td>
                                <td style="padding: 1rem;">
                                    @if ($message->status === 'unread')
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #fef3c7; color: #92400e; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">Belum Dibaca</span>
                                    @elseif ($message->status === 'read')
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #d1fae5; color: #065f46; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">Dibaca</span>
                                    @else
                                        <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #ede9fe; color: #5b21b6; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">Diarsipkan</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">{{ $message->created_at->format('d M Y H:i') }}</td>
                                <td style="padding: 1rem; text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                        <a href="{{ route('admin.messages.show', $message) }}" class="detail" style="display: inline-block; padding: 0.5rem 1rem; background-color: #667eea; color: white; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem; font-weight: 600;">
                                            <i class="fas fa-file-alt"></i> Detail
                                        </a>
                                        <a href="mailto:{{ $message->email }}?subject=Balasan" class="reply" style="display: inline-block; padding: 0.5rem 1rem; background-color: #10b981; color: white; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem; font-weight: 600;">
                                            <i class="fas fa-reply"></i> Balas
                                        </a>
                                        @if ($message->status !== 'read')
                                            <form action="{{ route('admin.messages.read', $message) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="read" style="padding: 0.6rem 1rem; background-color: #3b82f6; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; font-size: 0.875rem;">
                                                    <i class="fas fa-check"></i> Dibaca
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete" style="padding: 0.6rem 1rem; background-color: #ef4444; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; font-size: 0.875rem;">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div style="padding: 1.5rem; border-top: 1px solid #e5e7eb;">
                    @include('components.pagination', ['paginator' => $messages])
                </div>
            @endif
        @else
            <div style="padding: 3rem; text-align: center; color: #6b7280;">
                <p style="font-size: 1.125rem; margin-bottom: 0.5rem;">Tidak ada pesan</p>
                <p>Belum ada pesan dari pengunjung website.</p>
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

    .reply:hover {
        background-color: var(--hover-edit) !important;
        color: white !important;
    }

    .read:hover {
        background-color: #2563eb !important;
        color: white !important;
    }

    .delete:hover {
        transition: background-color 0.3s ease;
        background-color: #dc2626 !important;
        color: white !important;
    }   

    @media (max-width: 768px) {

        .admin-header{
            flex-direction: column;
            text-align: right;
        }

        table {
            font-size: 0.875rem !important;
        }
        th, td {
            padding: 0.75rem !important;
        }
       .message-link {
    display: block;
    margin-bottom: 0.5rem;
}

    }
</style>

@endsection
