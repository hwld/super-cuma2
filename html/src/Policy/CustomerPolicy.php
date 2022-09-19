<?php

namespace App\Policy;

use App\Model\Entity\Customer;
use Authorization\IdentityInterface;

class CustomerPolicy
{
    public function canAdd(IdentityInterface $user, Customer $customer): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canEdit(IdentityInterface $user, Customer $customer): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canDelete(IdentityInterface $user, Customer $customer): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }
}
