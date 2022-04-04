<?php

/**
 * @var Router\Router $router
 */


$router->register('/', ['Controllers\HomeController', 'index']);

$router->register('/users/index', ['Controllers\UserController', 'index']);
$router->register('/users/create', ['Controllers\UserController', 'create']);
$router->register('/users/store', ['Controllers\UserController', 'store']);
$router->register('/users/{userId}', ['Controllers\UserController', 'show']);
$router->register('/users/{userId}/edit', ['Controllers\UserController', 'edit']);
$router->register('/users/{userId}/update', ['Controllers\UserController', 'update']);
$router->register('/users/{userId}/delete', ['Controllers\UserController', 'destroy']);
$router->register('/users/connexion', ['Controllers\UserController', 'connexion']);
$router->register('/users/login', ['Controllers\UserController', 'login']);