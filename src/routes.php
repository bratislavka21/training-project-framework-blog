<?php

return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/edit/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add/?$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^articles/delete/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^users/register/?$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login/?$~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout/?$~' => [\MyProject\Controllers\UsersController::class, 'logout']
];
