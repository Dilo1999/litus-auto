<?php

namespace App\Policies;

use App\Models\PageSeo;
use App\Models\User;

class PageSeoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, PageSeo $pageSeo): bool
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, PageSeo $pageSeo): bool
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, PageSeo $pageSeo): bool
    {
        return false;
    }
}
