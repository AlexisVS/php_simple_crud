<?php

namespace Router;

use Exceptions\RouteNotFoundException;

class Router
{
  /**
   * Define array for register all Routes
   */
  public array $routes = [];

  /**
   * Stock route into routes attribute array
   * 
   * @param string $path
   * Must be with a "\". Exemple "Controllers\HomeController
   * @param callable|array $action
   * @return void
   */
  public function register(string $path, callable|array $action): void
  {
    $this->routes[$path] = $action;
  }

  /**
   * Resolve Uri
   * 
   * @param string $uri
   * @return string
   */
  private function resolveUri(string $uri): string
  {
    $path = explode('?', $uri)[0];

    return $path;
  }

  /**
   *  Define if action is correct
   * @param string $path
   * @return callable|array|null $action
   */
  private function defineAction(string $path): callable|array|null
  {
    $action = $this->routes[$path] ?? null;

    return $action;
  }

  /**
   * Execute the actions
   * 
   * @param callable|array|null $action
   */
  private function executeActions(callable|array|null $action): mixed
  {
    if (is_callable($action)) {
      return $action();
    }

    if (is_array($action)) {
      [$className, $method] = $action;

      if (class_exists($className) && method_exists($className, $method)) {
        $class = new $className();
        return call_user_func_array([$class, $method], []);
      }
    }
    return new RouteNotFoundException();
  }

  /**
   * Resolve the uri and launch the function
   * 
   * @param string $uri
   * @return mixed
   */
  public function resolve(string $uri): mixed
  {
    $path = $this->resolveUri($uri);

    $action = $this->defineAction($path);

    return $this->executeActions($action);
  }
}
