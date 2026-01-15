<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Pastikan user login dan memiliki role admin
        return $this->user() && $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'            => ['required', 'string', 'min:3', 'max:255'],
            'author'           => ['required', 'string', 'min:3', 'max:255'],
            'isbn'             => ['nullable', 'string', 'max:20'],
            'publisher'        => ['nullable', 'string', 'max:255'],
            'category_id'      => ['required', 'integer', 'exists:categories,id'],
            'published_date'   => ['nullable', 'date'],
            'description'      => ['nullable', 'string'],
            'stock'            => ['required', 'integer', 'min:0'],
            'cover'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required'          => 'Judul buku wajib diisi.',
            'title.min'               => 'Judul buku minimal 3 karakter.',
            'author.required'         => 'Penulis buku wajib diisi.',
            'author.min'              => 'Nama penulis minimal 3 karakter.',
            'category_id.required'    => 'Kategori buku wajib dipilih.',
            'category_id.exists'      => 'Kategori yang dipilih tidak valid.',
            'stock.required'          => 'Stok buku wajib diisi.',
            'stock.integer'           => 'Stok harus berupa angka.',
            'stock.min'               => 'Stok tidak boleh kurang dari 0.',
            'isbn.max'                => 'ISBN maksimal 20 karakter.',
            'publisher.max'           => 'Nama penerbit maksimal 255 karakter.',
            'published_date.date'     => 'Format tanggal tidak valid.',
            'cover.image'             => 'File cover harus berupa gambar.',
            'cover.mimes'             => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'cover.max'               => 'Ukuran gambar maksimal 5 MB.',
        ];
    }
}
