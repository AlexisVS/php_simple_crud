<?php

namespace Source;

use Exceptions\RouteNotFoundException;
use Router\Router;

class App
{
  /** Construct
   * 
   * @param \Router\Router $router
   * @param string $requestUri
   */
  public function __construct(private Router $router, private string $requestUri)
  {
  }

  /**
   * Resolve route and parse view or launch error message
   * 
   */
  public function run()
  {
    try {
      echo $this->router->resolve($this->requestUri);
      echo 'after app router resolve';
    } catch (RouteNotFoundException $e) {
      echo $e->getMessage();
    }
  }
}
