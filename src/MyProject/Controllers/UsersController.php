<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\UsersAuthService;

class UsersController extends AbstractController
{
    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

        if ($isCodeValid) {
            $user->activate();
            UserActivationService::deleteActivationCode($user);

            $message = 'OK!';
            $this->view->renderHtml('users/activation.php', ['message' => $message]);
        } else {
            $message = 'Ошибка активации пользователя';
            $this->view->renderHtml('users/activation.php', ['message' => $message]);
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::setAuthToken($user);
                header("Location: /");
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    public function logout()
    {
        if (!empty($this->user)) {
            UsersAuthService::deleteAuthToken();
        }
        header("Location: /");
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send(
                    $user,
                    'Активация',
                    'userActivation.php',
                    ['userId' => $user->getId(), 'code' => $code]
                );

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }
}
