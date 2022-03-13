<?php

namespace Controllers;

use Models\UserModel;
use Source\Renderer;

class HomeController
{

  /**
   * Define the default home page
   * 
   * @return Source\Renderer
   */
  public function index(): Renderer
  {
    $user = new UserModel();
    print_r($user); // TODO: le probleme est ici
    // todo: n'arrive pas a call correctement le system
    echo '<br>';
    var_dump($user->find(1));
    $data = [
      'user' => $user->find(1)
    ];
    return Renderer::make('home/index', $data);
  }
}
