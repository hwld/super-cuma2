<?php

namespace App\Policy;

use App\Model\Entity\Sale;
use Authorization\IdentityInterface;

class SalePolicy
{
    public function canAdd(IdentityInterface $user, Sale $sale)
    {
        return $user->isAdmin;
    }

    public function canEdit(IdentityInterface $user, Sale $sale)
    {
        return $user->isAdmin;
    }

    public function canDelete(IdentityInterface $user, Sale $sale)
    {
        return $user->isAdmin;
    }
}
