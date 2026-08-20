<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() && $this->canAccessUser($user, $model);
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() && $this->canAccessUser($user, $model);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && $this->canAccessUser($user, $model);
    }

    private function canAccessUser(User $user, User $model): bool
    {
        if ($model->isSuperAdmin() && ! $user->isSuperAdmin()) {
            return false;
        }

        return true;
    }
}
