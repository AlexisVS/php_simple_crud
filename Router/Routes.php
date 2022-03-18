<?php

$router->register('/', ['Controllers\HomeController', 'index']);

$router->register('/users/index', ['Controllers\UserController', 'index']);
$router->register('/users/create', ['Controllers\UserController', 'create']);
$router->register('/users/store', ['Controllers\UserController', 'store']);
$router->register('/users/{userId}/show', ['Controllers\UserController', 'show']);
$router->register('/users/{userId}/edit', ['Controllers\UserController', 'edit']);
$router->register('/users/{userId}/update', ['Controllers\UserController', 'update']);
$router->register('/users/{userId}/delete', ['Controllers\UserController', 'destroy']);
