@extends('layouts.admin')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header -->
    <div class="admin-header">
        <h1>{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</h1>
        <p>{{ isset($category) ? 'Perbarui informasi kategori' : 'Buat kategori baru' }}</p>
    </div>

    <!-- Form Card -->
    <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
                    <p style="font-weight: 600; margin-bottom: 0.5rem;">Terjadi kesalahan:</p>
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Name Field -->
            <div style="margin-bottom: 1.5rem;">
                <label for="name" style="display: block; color: #1f2937; font-weight: 600; margin-bottom: 0.5rem;">Nama Kategori</label>
                <input type="text" id="name" name="name" 
                       value="{{ old('name', isset($category) ? $category->name : '') }}"
                       placeholder="Contoh: Fiksi, Non-Fiksi, Sejarah" 
                       required
                       style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.375rem; font-family: inherit; font-size: 1rem; box-sizing: border-box; transition: border-color 0.3s ease;">
                @error('name')
                    <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
                <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem; margin-bottom: 0;">Nama kategori harus unik dan deskriptif</p>
            </div>

            

            <!-- Action Buttons -->
            <div style="display: flex; gap: 1rem;">
                <button type="submit" style="flex: 1; padding: 0.75rem; background-color: #667eea; color: white; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: 600; font-size: 1rem; transition: background-color 0.3s ease;">
                    {{ isset($category) ? 'Update Kategori' : 'Buat Kategori' }}
                </button>
                <a href="{{ route('admin.categories.index') }}" style="flex: 1; padding: 0.75rem; background-color: #e5e7eb; color: #1f2937; border-radius: 0.375rem; text-decoration: none; font-weight: 600; font-size: 1rem; text-align: center; transition: background-color 0.3s ease;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .admin-header  {
            text-align: right;
            flex-direction: column;
        }
    }
</style>

<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.hasAttribute('data-auto')) {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            slugInput.value = slug;
            slugInput.setAttribute('data-auto', 'true');
        }
    });

    slugInput.addEventListener('focus', function() {
        this.removeAttribute('data-auto');
    });
</script>

@endsection
