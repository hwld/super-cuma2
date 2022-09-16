<?php

namespace App\Policy;

use App\Model\Entity\Company;
use Authorization\IdentityInterface;

class CompanyPolicy
{
    public function canAdd(IdentityInterface $user, Company $company)
    {
        return $user->isAdmin;
    }

    public function canEdit(IdentityInterface $user, Company $company)
    {
        return $user->isAdmin;
    }

    public function canDelete(IdentityInterface $user, Company $company)
    {
        return $user->isAdmin;
    }
}
