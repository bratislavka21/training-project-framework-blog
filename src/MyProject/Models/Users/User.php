<?php

namespace MyProject\Models\Users;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $authToken;
    
    protected $createdAt;
    
    protected $email;
    
    protected $isConfirmed;
    
    protected $nickname;
    
    protected $passwordHash;
    
    protected $role;

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }

    public function getAuthToken(): string
    {
        return $this->authToken;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->nickname;
    }
    
    public function getNickname(): string
    {
        return $this->nickname;
    }

    public static function login(array $loginData): self
    {
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException('Не передан пароль');
        }

        $user = self::findOneByColumn('email', $loginData['email']);

        if ($user === null) {
            throw new InvalidArgumentException('В базе не найден пользователь с таким email-ом');
        }

        if (!password_verify($loginData['password'], $user->passwordHash)) {
            throw new InvalidArgumentException('Неверный пароль');
        }

        if (!$user->isConfirmed) {
            throw new InvalidArgumentException('Пользователь еще не активирован');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    private function refreshAuthToken(): void
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function signUp(array $userData): User
    {
        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Не передан nickname');
        }

        if (!preg_match('~^[a-zA-Z0-9]+$~', $_POST['nickname'])) {
            throw new InvalidArgumentException('nickname может состоять только из латиницы и цифр');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Некорректный email');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Не передан password');
        }

        if (mb_strlen($_POST['password']) < 6) {
            throw new InvalidArgumentException('Пароль не может быть короче 6 символов');
        }

        if (self::findOneByColumn('nickname', $_POST['nickname'])) {
            throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
        }

        if (self::findOneByColumn('email', $_POST['email'])) {
            throw new InvalidArgumentException('Такой email уже зарегистрирован в базе');
        }

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));

        $user->save();

        return $user;
    }
    
    protected static function getTableName(): string
    {
        return '`users`';
    }
}
