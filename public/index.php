<?php

namespace Public;

use Router\Router;
use Source\App;
use Source\Renderer;

//Session
session_start();

// Autoload
require './../vendor/autoload.php';

// Router
$router = new Router();
include './../Router/Routes.php';

// layout and APP
include_once('../Views/static/headerHtml.php');
include_once('../Views/layout/navigation.php');
(new App($router, $_SERVER['REQUEST_URI']))->run();
include_once('../Views/static/footerHTML.php');
