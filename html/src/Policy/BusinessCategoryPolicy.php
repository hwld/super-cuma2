<?php

namespace App\Policy;

use App\Model\Entity\BusinessCategory;
use Authentication\IdentityInterface as AuthenticationIdentityInterface;
use Authorization\IdentityInterface;

class BusinessCategoryPolicy
{
    public function canAdd(IdentityInterface $user, BusinessCategory $businessCategory)
    {
        return $user->isAdmin;
    }

    public function canEdit(IdentityInterface $user, BusinessCategory $businessCategory)
    {
        return $user->isAdmin;
    }

    public function canDelete(IdentityInterface $user, BusinessCategory $businessCategory)
    {
        return $user->isAdmin;
    }
}
