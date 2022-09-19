<?php

namespace App\Policy;

use App\Model\Entity\Sale;
use Authorization\IdentityInterface;

class SalePolicy
{
    public function canAdd(IdentityInterface $user, Sale $sale): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canEdit(IdentityInterface $user, Sale $sale): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canDelete(IdentityInterface $user, Sale $sale): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }
}
