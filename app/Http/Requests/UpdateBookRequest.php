<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn,' . $this->book->id],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1000', 'max:2100'],
            'category' => ['required', 'string', 'max:100'],
            'published_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'stock' => ['required', 'integer', 'min:0'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Nama pengarang wajib diisi.',
            'category.required' => 'Kategori wajib diisi.',
            'stock.required' => 'Stok buku wajib diisi.',
            'isbn.unique' => 'ISBN sudah terdaftar.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}
