<?php

namespace Router;

use Controllers\HomeController;
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
   * Resolve Uri and split uri and the query string
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
        // TODO: systeme d' id au routes pour les models
        // TODO: Si il y a des parametre a la route genre /user/{2}
        // Todo: les stocker dans un tableau a balancer au constructeur du controller
        // Todo: Comment faire pour enregistrer la route malgré qu'il y a un parametre dedans lors du register()
        // Todo: genre /user/{id}
        // * avec sprintf en mettant des %d ?
        // * mais comment ? :)

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
