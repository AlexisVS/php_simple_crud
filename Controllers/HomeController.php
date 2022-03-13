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
    echo 'dsfsdf';
    $user = new UserModel();
    var_dump($user);
    var_dump($user->find(1));
    $data = [
      'user' => $user->find(1)
    ];
    return Renderer::make('home/index', $data);
  }
}
