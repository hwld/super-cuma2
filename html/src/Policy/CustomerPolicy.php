<?php

namespace App\Policy;

use App\Model\Entity\Customer;
use Authorization\IdentityInterface;

class CustomerPolicy
{
    public function canAdd(IdentityInterface $user, Customer $customer)
    {
        return $user->isAdmin;
    }

    public function canEdit(IdentityInterface $user, Customer $customer)
    {
        return $user->isAdmin;
    }

    public function canDelete(IdentityInterface $user, Customer $customer)
    {
        return $user->isAdmin;
    }
}
