<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Book;

class BorrowingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Semua user login boleh meminjam
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'book_id' => ['required', 'exists:books,id'],
        ];
    }

    /**
     * Additional validation after default rules.
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $book = Book::find($this->book_id);

            if ($book && !$book->isAvailable()) {
                $validator->errors()->add(
                    'book_id',
                    'Buku tidak tersedia (stok habis).'
                );
            }

            if ($this->user() && !$this->user()->canBorrowMore()) {
                $validator->errors()->add(
                    'book_id',
                    'Anda telah mencapai batas maksimal peminjaman (3 buku aktif).'
                );
            }
        });
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'book_id.required' => 'Buku wajib dipilih.',
            'book_id.exists'   => 'Buku tidak ditemukan.',
        ];
    }
}
