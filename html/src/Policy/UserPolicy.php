<?php

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

class UserPolicy
{
    public function canEdit(IdentityInterface $identity, User $user)
    {
        return $identity->isAdmin || ($identity->id === $user->id);
    }

    public function canDelete(IdentityInterface $identity, User $user)
    {
        return $identity->isAdmin || ($identity->id === $user->id);
    }
}
