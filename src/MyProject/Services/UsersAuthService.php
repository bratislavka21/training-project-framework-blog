<?php

namespace MyProject\Services;

use MyProject\Models\Users\User;

class UsersAuthService
{
    public static function deleteAuthToken(): void
    {
        setcookie('token', 0, 1, "/", ".myproject.loc", false, true);
    }

    public static function setAuthToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, "/", ".myproject.loc", false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? null;

        if ($token === null) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::getById($userId);

        if ($user === null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }

        return $user;
    }
}
