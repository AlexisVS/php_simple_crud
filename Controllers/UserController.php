<?php

namespace Controllers;

use Models\UserModel;
use Source\Constant;
use Source\Helper;
use Source\Renderer;

class UserController
{
  public function __construct(public \Router\Router $router)
  {
  }
  /**
   * Display a listing of the resource.
   *
   * @return Source\Renderer
   */
  static public function index(): Renderer
  {
    $users = new UserModel();
    $data = [
      'users' => $users->all(),
    ];

    return Renderer::make('user/index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Source\Renderer
   */
  static public function create(): Renderer
  {
    return Renderer::make('user/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Source\Renderer
   */
  static public function store()
  {
    $store = new UserModel();

    // Totally stupid for security reason but this is a training project so ...
    $store->store($_POST);

    return self::index();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function show($id): mixed
  {
    $user = new UserModel();
    $data = [
      'user' => $user->find($id),
    ];

    return Renderer::make('user/show', $data);
    // Helper::beautifful_print($data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function edit($id): Renderer
  {
    $user = new UserModel();
    $data = [
      'user' => $user->find($id),
    ];

    return Renderer::make('user/edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function update($id)
  {
    $user = new UserModel();
    $user->update($id, $_POST);

    return Self::show($id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function destroy($id)
  {
    $user = new UserModel();
    $user->delete($id);

    return self::index();
  }
}
