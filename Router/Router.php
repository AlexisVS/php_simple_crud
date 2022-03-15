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
    // TODO: Ici il va falloir dire que si il y a un /dashboard/users/{userId ou autre}/payments/{paymentId}
    // Todo: de remplacer entre chaque '{' et '}' par un quelconque nombre
    // Todo: Pour dire que ça match entre la route qui est enregistrer dans le tableau et la $_SERVER['REQUEST_URI']

    //Todo: De maniere procedurale ce que je ferais c'est de :
    //Todo: 1. (phase de split)         splite le path dans un tableau a chaque /
    //Todo: 2. ( phase de réagencement) de dire qui si je suis sur une string et qu'après y a encore une string et ben alors je supprime la string actuel. je sort de ma boucle et je réentre dans ma boucle jusque quand la boucle est finit.
    //Todo: 3. Remplacer les numero par 
    //Todo:

    // split to array
    $uriSegmented = explode('/', $path);

    // delete null empty string value
    $uriSegmentedFiltered = array_filter($uriSegmented, function ($segment) {
      if ($segment === '') {
        return false;
      }
      return true;
    });

    // transform number string to number int
    $uriSegmentedFilteredTransformed = array_map(function ($segment) {
      if (intval($segment) != 0) {
        return intval($segment);
      }
      return $segment;
    }, $uriSegmentedFiltered);


    // split charachter
    Helper::beautifful_print([
      '$_SERVER[REQUEST_URI]' => $_SERVER['REQUEST_URI'],
      '$path' => $path,
      '$uriSegmented' => $uriSegmented,
      '$uriSegmentedFiltered' => $uriSegmentedFiltered,
      '$uriSegmentedFilteredTransformed' => $uriSegmentedFilteredTransformed,
    ]);
    var_dump($uriSegmentedFilteredTransformed);


    $action = $this->routes[$path] ?? null;
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
   * @return mixed
   */
  private function executeAction(callable|array|null $action, $uriParameters): mixed
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
   * Get on the uri the parameters
   * 
   * @param string $uri
   * 
   * @return array $parameters
   */
  private function getUriParameters(string $uri): array
  {
    $parameters = [];

    // ? /dashboard/users/2/payments/25
    // TODO: Si apres un mot il y a un '/' un numero et puis un '/'
    // Todo: Enregistrer dans un tableau key:le_mot value:le_chiffre [user => 2, payment => 25]

    return $parameters;
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

    // Define if action is correct
    $action = $this->defineAction($path);

    // Get on the uri the parameters
    $uriParameters = $this->getUriParameters($uri);

    // Define if action is correct
    return $this->executeAction($action, $uriParameters);
  }
}
