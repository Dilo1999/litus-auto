<?php

namespace App\Policies;

use App\Models\PageSetting;
use App\Models\User;

class PageSettingPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, PageSetting $pageSetting): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, PageSetting $pageSetting): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, PageSetting $pageSetting): bool
    {
        return false;
    }
}
