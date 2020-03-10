<?php

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\UsersAuthService;

abstract class AbstractController
{
    protected $user;

    protected $view;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setExtraVars('user', $this->user);
    }
}
