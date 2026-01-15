@extends('layouts.admin')

@section('content')
<div style="max-width: 100%; margin: 0; padding: 0;">
    <!-- Header -->
    <div class="admin-header">
        <h1>Detail Buku</h1>
        <p>Informasi lengkap tentang buku</p>
    </div>

    <!-- Detail Card -->
    <div style="border-radius: 0.75rem;  overflow: hidden; margin-top: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                <!-- Details Table -->
                <div>
                    <table class="detail-table" style="width: 100%; border-collapse: collapse; box-shadow: rgba(1, 0, 0, 0.3);">
                        <tbody>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Judul
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->title }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Pengarang
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->author }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Penerbit
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->publisher }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Kategori
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: #667eea; color: white; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                        {{ $book->categoryModel?->name ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Tahun Terbit
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->year ?? '-' }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Stok Tersedia
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    <span style="display: inline-block; padding: 0.375rem 0.75rem; background-color: {{ $book->stock > 0 ? '#dcfce7' : '#fee2e2' }}; color: {{ $book->stock > 0 ? '#166534' : '#991b1b' }}; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 600;">
                                        {{ $book->stock }} buku
                                    </span>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Dibuat
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                    Diperbarui
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                    {{ $book->updated_at->format('d M Y H:i') }}
                                </td>
                            </tr>

                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; width: 35%; font-weight: 600; color: #667eea; background-color: #f9fafb;">
                                   Deskripsi
                                </td>
                                <td style="padding: 1rem; color: #1f2937;">
                                     @if($book->description)
                                            <p style="color: #1f2937; line-height: 1.6;">
                                                {{ $book->description }}
                                            </p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


           

            <!-- Action Buttons -->
            <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center;">
                
                <a href="{{ route('admin.books.index') }}" class="button">
                   Kembali
                </a>
            </div>
        </div>
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