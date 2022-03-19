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

    if (preg_match_all('/\d+/', $uri, $matches)) {
      $parameters = $matches[0];
    }

    return $parameters;
  }

  /**
   *  Define if action is correct
   * @param string $path
   * @return mixed $action
   */
  private function defineAction(string $path, array $uriParameters): mixed
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
   * @param array $uriParameters
   * @return mixed $action
   */
  private function defineActionArrayForExecuteAction(array $action, array $uriParameters): mixed
  {
    [$className, $method] = $action;

    if (class_exists($className) && method_exists($className, $method)) {
      $class = new $className();
      if ($uriParameters == null || count($uriParameters) == 0) {
        return call_user_func_array([$class, $method], []);
      } else {
        return call_user_func_array([$class, $method], $uriParameters);
      }
    }
    return new RouteNotFoundException();
  }

  /**
   * Execute the actions
   * 
   * @param mixed $action
   * @param array $uriParameters
   * @return mixed
   */
  private function executeAction(mixed $action, array $uriParameters): mixed
  {
    if (is_callable($action)) {
      return $action(...$uriParameters);
    }
    if (is_array($action)) {
      return $this->defineActionArrayForExecuteAction($action, $uriParameters);
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
    // var_dump($uri);
    Helper::beautifful_print($this->routes);

    // Resolve Uri and split uri and the query string
    $path = $this->resolveUri($uri);

    // Get on the uri the parameters
    $uriParameters = $this->getUriParameters($uri);

    // Define if action is correct
    $action = $this->defineAction($path, $uriParameters);

    // var_dump($action);

    // Execute action
    return $this->executeAction($action, $uriParameters);
  }
}
