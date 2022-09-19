<?php

namespace App\Policy;

use App\Model\Entity\Company;
use Authorization\IdentityInterface;

class CompanyPolicy
{
    public function canAdd(IdentityInterface $user, Company $company): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canEdit(IdentityInterface $user, Company $company): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canDelete(IdentityInterface $user, Company $company): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }
}
