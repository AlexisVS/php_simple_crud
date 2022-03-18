<?php

use Source\Renderer;



$router->register('/dashboard/users/{userId}/payments/{paymentId}', function () {
  return Renderer::make('router-test');
});


// $router->register('/dashboard/users/2/payments/25', function () {
//   return Renderer::make('router-test');
// });
$router->register('/', ['Controllers\HomeController', 'index']);
