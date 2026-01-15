<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Semua user (login maupun guest) boleh melihat daftar buku.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Semua user boleh melihat detail buku.
     */
    public function view(?User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Hanya admin yang boleh menambah buku.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya admin yang boleh memperbarui buku.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hanya admin yang boleh menghapus buku.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Restore data (jika pakai soft delete) → admin.
     */
    public function restore(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Hapus permanen → admin.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }
}
