<?php

namespace MyProject\Models\Users;

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

    public function getName(): string
    {
        return $this->nickname;
    }
    
    public function getNickname(): string
    {
        return $this->nickname;
    }
    
    protected static function getTableName(): string
    {
        return '`users`';
    }
}
