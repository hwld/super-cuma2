<?php

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

class UserPolicy
{
    public function canEdit(IdentityInterface $identity, User $user): bool
    {
        if (isset($identity->isAdmin) && isset($identity->id)) {
            return $identity->isAdmin || $identity->id === $user->id;
        }
        return false;
    }

    public function canDelete(IdentityInterface $identity, User $user): bool
    {
        if (isset($identity->isAdmin) && isset($identity->id)) {
            return $identity->isAdmin || $identity->id === $user->id;
        }
        return false;
    }
}
