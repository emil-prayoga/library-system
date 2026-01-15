@extends('layouts.admin')

@section('content')

<div style="width:100%; margin: 0 auto;">
    <div class="admin-header">
        <h1 style="margin-top: 0; color: #1f2937; margin-bottom: 0.5rem;">Tambah Buku Baru</h1>
        <p style="color: #6b7280; ">Masukkan informasi lengkap untuk buku baru</p>
        </div>
    </div>
        @if ($errors->any())
            <div style="background-color: #fee2e2; border-left: 4px solid #dc2626; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 2rem;">
                <p style="font-weight: 600; margin-bottom: 0.5rem;">Terjadi kesalahan:</p>
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Form Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Title -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Judul Buku *</label>
                    <input type="text" name="title" 
                           value="{{ old('title') }}" required placeholder="Masukkan judul buku"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('title')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Pengarang *</label>
                    <input type="text" name="author"
                           value="{{ old('author') }}" required placeholder="Masukkan nama pengarang"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('author')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ISBN -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">ISBN *</label>
                    <input type="text" name="isbn"
                           value="{{ old('isbn') }}" required placeholder="Masukkan nomor ISBN"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('isbn')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publisher -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Penerbit *</label>
                    <input type="text" name="publisher"
                           value="{{ old('publisher') }}" required placeholder="Masukkan nama penerbit"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('publisher')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Kategori *</label>
                    <select name="category_id" required
                            style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                            onfocus="this.style.borderColor='#667eea'" 
                            onblur="this.style.borderColor='#e5e7eb'">
                        <option value="">— Pilih Kategori —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published Date -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Tanggal Terbit</label>
                    <input type="date" name="published_date"
                           value="{{ old('published_date') }}"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('published_date')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Jumlah Stok *</label>
                    <input type="number" name="stock"
                           value="{{ old('stock', 1) }}" required min="1" placeholder="Masukkan jumlah stok"
                           style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; transition: border-color 0.2s ease;"
                           onfocus="this.style.borderColor='#667eea'" 
                           onblur="this.style.borderColor='#e5e7eb'">
                    @error('stock')
                        <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Deskripsi</label>
                <textarea name="description" rows="4" placeholder="Masukkan deskripsi singkat tentang buku"
                          style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-size: 1rem; font-family: inherit; transition: border-color 0.2s ease;"
                          onfocus="this.style.borderColor='#667eea'" 
                          onblur="this.style.borderColor='#e5e7eb'">{{ old('description') }}</textarea>
                @error('description')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Cover Image -->
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1f2937;">Gambar Sampul</label>
                <input type="file" name="cover" accept="image/*" onchange="previewImage(this)"
                       style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem;">
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Format: JPG, PNG, GIF. Ukuran maksimal: 5MB</p>
                @error('cover')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
                <div id="preview" style="margin-top: 1rem;"></div>
            </div>

            <!-- Buttons -->
            <div style="display: flex; gap: 1rem; margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 2rem;">
                <button type="submit" style="flex: 1; padding: 0.75rem 1.5rem; background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 0.375rem; color: white; font-weight: 600; cursor: pointer; font-size: 1rem; transition: transform 0.2s ease;" 
                        onmouseover="this.style.transform='scale(1.02)'" 
                        onmouseout="this.style.transform='scale(1)'">
                    ✅ Simpan Buku
                </button>
                <a href="{{ route('admin.books.index') }}" style="flex: 1; padding: 0.75rem 1.5rem; background-color: #e5e7eb; border-radius: 0.375rem; color: #1f2937; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s ease;" 
                   onmouseover="this.style.backgroundColor='#d1d5db'" 
                   onmouseout="this.style.backgroundColor='#e5e7eb'">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        div[style*="display: grid; grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
       
        .admin-header{
            text-align: right;
            flex-direction: column;
        }

        .admin-header h1{
        font-size: 100%;
    }
</style>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div style="max-width: 200px;">
                        <img src="${e.target.result}" style="width: 100%; border-radius: 0.375rem; border: 1px solid #e5e7eb;">
                        <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;"><i class="fas fa-check"></i> Gambar sampul dipilih</p>
                    </div>
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
