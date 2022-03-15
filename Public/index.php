<?php

namespace Public;

use Router\Router;
use Source\App;
use Source\Renderer;

require './../vendor/autoload.php';

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);
$router->register('/dashboard/users/2/payments/25', function () {
  return Renderer::make('router-test');
});
// include './../Router/Routes.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" />
</head>

<body class="bg-black-90 white-80 sans-serif">
  <?php (new App($router, $_SERVER['REQUEST_URI']))->run(); ?>
</body>

</html>