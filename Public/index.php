<?php

namespace Public;

use Router\Router;
use Source\App;

require './../vendor/autoload.php';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);

(new App($router, $_SERVER['REQUEST_URI']))->run();