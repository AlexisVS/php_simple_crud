<?php

namespace Router;

use Controllers\HomeController;
use Exceptions\RouteNotFoundException;
use Source\Helper;

class Router
{

  /**
   * Define array for register all Routes
   */
  public array $routes = [];

  /**
   * Stock route into routes attribute array
   * and replace params with %d for matching with request uri
   * 
   * @param string $path
   * Must be with a "\". Exemple "Controllers\HomeController
   * @param callable|array $action
   * @return void
   */
  public function register(string $path, callable|array $action): void
  {
    // preg_replace('/\{(.*?)\}/', '%d', $path)
    if (str_contains($path, '{')) {
      $path = preg_replace('/\{(.*?)\}/', '%d', $path);
    }
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
   * Get on the uri the parameters and return it
   * 
   * @param string $uri
   * @return array $parameters
   */
  private function getUriParameters(string $uri): array
  {
    $parameters = [];
    // ? /dashboard/users/2/payments/25
    // TODO: Si apres un mot il y a un '/' un numero et puis un '/'
    // Todo: Enregistrer dans un tableau key:le_mot value:le_chiffre [user => 2, payment => 25]
    if (preg_match_all('/\d+/', $uri, $matches)) {
      $parameters = $matches[0];
    }

    return $parameters;
  }

  /**
   *  Define if action is correct
   * @param string $path
   * @return callable|array|null $action
   */
  private function defineAction(string $path, array $uriParameters): callable|array|null
  {
    if (count($uriParameters) > 0) {
      $forMatchingPath = preg_replace('/\d+/', '%d', $path);
      $action = $this->routes[$forMatchingPath] ?? null;
    } else {
      $action = $this->routes[$path] ?? null;
    }

    return $action;
  }

  /**
   * Define action For action array
   * 
   * @param array $action
   * @param array|null $uriParameters
   * @return mixed $action
   */
  private function defineActionArrayForExecuteAction(array $action, array|null $uriParameters = null): mixed
  {
    [$className, $method] = $action;

    if (class_exists($className) && method_exists($className, $method)) {
      $class = new $className();
      return call_user_func_array([$class, $method], $uriParameters);
    }
    return new RouteNotFoundException();
  }

  /**
   * Execute the actions
   * 
   * @param callable|array|null $action
   * @param array $uriParameters
   * @return mixed
   */
  private function executeAction(callable|array|null $action, array $uriParameters): mixed
  {
    if (is_callable($action)) {
      return $action();
    }

    if (is_array($action)) {
      $this->defineActionArrayForExecuteAction($action, $uriParameters);
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
    // Resolve Uri and split uri and the query string
    $path = $this->resolveUri($uri);

    // Get on the uri the parameters
    $uriParameters = $this->getUriParameters($uri);

    // Define if action is correct
    $action = $this->defineAction($path, $uriParameters);

    // Execute action
    return $this->executeAction($action, $uriParameters);
  }
}
