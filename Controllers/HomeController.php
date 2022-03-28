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
  static public function index(): Renderer
  {
    $user = new UserModel();
    $data = [
      'user' => $user->find(1),
      'users' => $user->all()
    ];
    return Renderer::make('home/index', $data);
  }
}
