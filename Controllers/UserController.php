<?php

namespace Controllers;

use Models\UserModel;
use Source\Constant;
use Source\Helper;
use Source\Renderer;

class UserController
{
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

    header('Location:' . Constant::PUBLIC_PATH . '/users/index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function show($id): Renderer
  {
    $user = new UserModel();
    $data = [
      'user' => $user->find($id),
    ];

    return Renderer::make('user/show', $data);
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
  static public function update($id): Renderer
  {
    $user = new UserModel();
    $data = [
      'user' => $user->find($id),
    ];

    return Renderer::make('user/show', $data);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function destroy($id): Renderer
  {
    $user = new UserModel();
    $user->delete($id);

    return Renderer::make('user/index');
  }
}
