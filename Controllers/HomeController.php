<?php

namespace Controllers;

use Models\UserModel;
use Source\Database;
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
    return Renderer::make('home/index');
  }
}
