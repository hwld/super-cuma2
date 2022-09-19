<?php

namespace App\Policy;

use App\Model\Entity\BusinessCategory;
use Authentication\IdentityInterface as AuthenticationIdentityInterface;
use Authorization\IdentityInterface;

class BusinessCategoryPolicy
{
    public function canAdd(IdentityInterface $user, BusinessCategory $businessCategory): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canEdit(IdentityInterface $user, BusinessCategory $businessCategory): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canDelete(IdentityInterface $user, BusinessCategory $businessCategory): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }
}
