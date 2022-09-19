<?php

namespace App\Policy;

use App\Model\Entity\Product;
use Authorization\IdentityInterface;

class ProductPolicy
{
    public function canAdd(IdentityInterface $user, Product $product): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canEdit(IdentityInterface $user, Product $product): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }

    public function canDelete(IdentityInterface $user, Product $product): bool
    {
        if (isset($user->isAdmin)) {
            return $user->isAdmin;
        }
        return false;
    }
}
