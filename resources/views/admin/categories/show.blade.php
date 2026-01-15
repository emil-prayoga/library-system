@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <h1>Detail Kategori</h1>
        <p>Informasi lengkap tentang kategori</p>
    </div>

    <!-- Detail Card -->
    <div style="border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; margin-top: 1.5rem;">
            <table class="detail-table" style="width: 100%; border-collapse: collapse; ">
                <tbody>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 50%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Nama Kategori
                        </td>
                        <td style="padding: 1rem; color: #1f2937; ">
                            {{ $category->name }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 50%;">
                        <td style="padding: 1rem; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Slug
                        </td>
                        <td style="padding: 1rem; color: #1f2937; ">
                            <code style="background-color: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem;">{{ $category->slug }}</code>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;width: 50%;">
                        <td style="padding: 1rem; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Jumlah Buku
                        </td>
                        <td style="padding: 1rem; color: #1f2937; ">
                            <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #f0f4ff; color: #667eea; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                {{ $category->books_count ?? 0 }} buku
                            </span>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 50%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Status
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            @if (($category->books_count ?? 0) > 0)
                                <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #dcfce7; color: #166534; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                    <i class="fas fa-check"></i> Aktif
                                </span>
                            @else
                                <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #fee2e2; color: #991b1b; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                    Kosong
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 50%;">
                        <td style="padding: 1rem; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Dibuat
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            {{ $category->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb; width: 50%;">
                        <td style="padding: 1rem;  font-weight: 600; color: #667eea; background-color: #f9fafb;">
                            Diperbarui
                        </td>
                        <td style="padding: 1rem; color: #1f2937;">
                            {{ $category->updated_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Books List -->
            @if(($category->books_count ?? 0) > 0)
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Daftar Buku ({{ $category->books_count ?? 0 }})</h3>
                    <div style="display: grid; gap: 1rem;">
                        @foreach($category->books as $book)
                            <div style="padding: 1rem; background-color: #f9fafb; border-radius: 0.375rem; border-left: 4px solid #667eea;">
                                <a href="{{ route('admin.books.show', $book) }}" style="color: #667eea; text-decoration: none; font-weight: 600;">
                                    {{ $book->title }}
                                </a>
                                <p style="margin: 0.5rem 0 0 0; color: #6b7280; font-size: 0.875rem;">
                                    Pengarang: {{ $book->author }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <!-- Action Buttons -->
            <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">

                <a href="{{ route('admin.categories.index') }}" class = "button">
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

    @media (max-width: 768px) {
       .admin-header {
        flex-direction: column;
        align-self: flex-start;
       }
    }
    
</style>