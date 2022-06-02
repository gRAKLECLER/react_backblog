<?php

namespace App\Manager;

use App\Entity\User;
use Firebase\JWT\JWT;

class TokenManager
{
    private static string $key = 'token';


    public function generateJWT(User $user): string
    {
        return JWT::encode([
            'userId' => $user->getId(),
            'username' => $user->getUserIdentifier(),
            'expired_at' => time() + 20,
        ], self::$key, 'HS256');
    }
}
