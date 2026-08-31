<?php

namespace App\Policies;

use App\Models\CourseRegistration;
use App\Models\User;

class CourseRegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(
        User $user,
        CourseRegistration $registration
    ): bool {
        return $user->isAdmin()
            || $registration->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isStudent();
    }

    public function update(
        User $user,
        CourseRegistration $registration
    ): bool {
        return $user->isAdmin();
    }

    public function delete(
        User $user,
        CourseRegistration $registration
    ): bool {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }
}