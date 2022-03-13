<?php

namespace Public;

use Router\Router;
use Source\App;

require './../vendor/autoload.php';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/tailwind.css">
</head>

<body>
  <?php (new App($router, $_SERVER['REQUEST_URI']))->run(); ?>
</body>

</html>