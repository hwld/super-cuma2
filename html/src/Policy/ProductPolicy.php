<?php

namespace App\Policy;

use App\Model\Entity\Product;
use Authorization\IdentityInterface;

class ProductPolicy
{
    public function canAdd(IdentityInterface $user, Product $product)
    {
        return $user->isAdmin;
    }

    public function canEdit(IdentityInterface $user, Product $product)
    {
        return $user->isAdmin;
    }

    public function canDelete(IdentityInterface $user, Product $product)
    {
        return $user->isAdmin;
    }
}
