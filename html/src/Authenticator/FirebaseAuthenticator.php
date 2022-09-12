<?php

namespace App\Authenticator;

use ArrayAccess;
use ArrayObject;
use Authentication\Authenticator\AbstractAuthenticator;
use Psr\Http\Message\ServerRequestInterface;
use Authentication\Authenticator\ResultInterface;
use Authentication\Authenticator\Result;
use Authentication\Identifier\IdentifierInterface;
use Exception;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use Kreait\Firebase\Factory;

class FirebaseAuthenticator extends AbstractAuthenticator
{
    private $auth;

    public function __construct(IdentifierInterface $identifier, array $config)
    {
        parent::__construct($identifier, $config);

        $this->auth = (new Factory())->withServiceAccount(__DIR__ . '/../../super-cuma-firebase-adminsdk.json')->createAuth();
    }

    public function authenticate(ServerRequestInterface $request): ResultInterface
    {
        // 送信されたformDataからidTokenを取得する。
        $body = $request->getParsedBody();
        if (!isset($body['idToken'])) {
            return new Result(null, Result::FAILURE_CREDENTIALS_MISSING);
        }
        $idToken = $body['idToken'];

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        } catch (Exception $e) {
            return new Result(null, Result::FAILURE_CREDENTIALS_INVALID);
        }

        // identifierからuidでuserを取得する
        $uid =  $verifiedIdToken->claims()->get('sub');
        $user = $this->_identifier->identify(['uid' => $uid]);
        if (empty($user)) {
            return new Result(null, Result::FAILURE_CREDENTIALS_INVALID);
        }
        if (!($user instanceof ArrayAccess)) {
            $user = new ArrayObject($user);
        }

        return new Result($user, Result::SUCCESS);
    }
}
