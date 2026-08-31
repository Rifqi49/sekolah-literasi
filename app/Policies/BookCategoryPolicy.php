<?php

namespace App\Policies;

use App\Models\BookCategory;
use App\Models\User;

class BookCategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, BookCategory $bookCategory): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, BookCategory $bookCategory): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, BookCategory $bookCategory): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}