<?php

namespace Controllers;

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
    return Renderer::make('home/index');
  }
}
