<?php

namespace App\Identifier;

use ArrayAccess;
use Authentication\Identifier\AbstractIdentifier;
use Authentication\Identifier\Resolver\ResolverAwareTrait;

class FirebaseIdentifier extends AbstractIdentifier
{
    use ResolverAwareTrait;

    protected $_defaultConfig = [
        'resolver' => 'Authentication.Orm'
    ];

    /**
     * @return \ArrayAccess<mixed,mixed>|array|null
     */
    public function identify(array $credentials)
    {
        if (!isset($credentials['uid'])) {
            return null;
        }
        $uid = $credentials['uid'];
        $identity = $this->getResolver()->find(['uid' => $uid]);

        return $identity;
    }
}
