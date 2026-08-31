<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Menentukan apakah user boleh melihat daftar buku.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh melihat buku tertentu.
     */
    public function view(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh membuat buku.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh mengubah buku.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh menghapus buku.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh menghapus beberapa buku.
     */
    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh restore buku.
     */
    public function restore(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh restore beberapa buku.
     */
    public function restoreAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh menghapus permanen buku.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }

    /**
     * Menentukan apakah user boleh menghapus permanen beberapa buku.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}