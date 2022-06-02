<?php

namespace App\Manager;


class CookieManager
{
    public function cookieHelper(string $token): void
    {
        setcookie('token', $token, time() + (3600 * 24 * 365), '/login', 'localhost', false, false);
    }
}
