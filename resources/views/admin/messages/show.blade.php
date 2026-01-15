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

    .badge-unread {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-read {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-archived {
        background-color: #ede9fe;
        color: #5b21b6;
    }

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
       .admin-header {
        flex-direction: column;
        align-self: flex-start;
       }
    }
</style>

<div class="admin-header">
    <h1>Detail Pesan</h1>
    <p>Informasi pesan dari pengguna</p>
</div>

<!-- Detail Table -->
<div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-top: 1.5rem;">
    <table class="detail-table">
        <tr>
            <td>Nama Pengirim</td>
            <td>{{ $message->name }}</td>
        </tr>
        <tr>
            <td>Email Pengirim</td>
            <td>
                <a href="mailto:{{ $message->email }}" style="color: #667eea; text-decoration: none;">{{ $message->email }}</a>
            </td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>
                @if ($message->phone)
                    <a href="tel:{{ $message->phone }}" style="color: #667eea; text-decoration: none;">{{ $message->phone }}</a>
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td>Tanggal Pengiriman</td>
            <td>{{ $message->created_at->format('d M Y H:i') }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                @if ($message->status === 'unread')
                    <span class="badge badge-unread">Belum Dibaca</span>
                @elseif ($message->status === 'read')
                    <span class="badge badge-read">Dibaca</span>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background-color: white; padding: 0;"></td>
        </tr>
        <tr>
            <td style="background-color: #f9fafb; padding: 1rem; font-weight: 600; color: #667eea;">Isi Pesan</td>
            <td>
                <div style="  border-radius: 0.5rem; color: #1f2937; line-height: 1.6; white-space: pre-wrap; word-wrap: break-word;">{{ $message->message }}</div>
            </td>
        </tr>
    </table>
</div>

<!-- Action Buttons -->
  <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
    <a href="{{ route('admin.messages.index') }}" class = "button">
        Kembali
    </a>
</div>

@endsection
