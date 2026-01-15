@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <h1>Detail Pengguna</h1>
        <p>Informasi lengkap tentang pengguna</p>
    </div>

    <!-- Detail Card -->
    <div style="background: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-top: 1.5rem;">
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Nama
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Email
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            <a href="mailto:{{ $user->email }}" style="color: #667eea; text-decoration: none;">
                                {{ $user->email }}
                            </a>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Role
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: {{ $user->is_admin ? '#fecaca' : '#d1fae5' }}; color: {{ $user->is_admin ? '#7f1d1d' : '#065f46' }}; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                {{ $user->is_admin ? 'Admin' : 'User' }}
                            </span>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Status
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
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
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Email Verified
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            @if ($user->email_verified_at)
                                <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #dcfce7; color: #166534; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                    <i class="fas fa-check"></i> Terverifikasi
                                </span>
                            @else
                                <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #fef3c7; color: #92400e; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                    ⏳ Belum Verifikasi
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Bergabung
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            {{ $user->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 75%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Diperbarui
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            {{ $user->updated_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
           <!-- Action Buttons -->
            <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                
                <a href="{{ route('admin.users.index') }}" class="button">
                    Kembali
                </a>
            </div>
    
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

    @media (max-width:768px) {
        .admin-header{
            text-align: right;
            flex-direction: column;
        }
    }
    
</style>
