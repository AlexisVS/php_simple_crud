<?php

namespace Controllers;

use Models\UserModel;
use Source\Renderer;

class UserController
{
  /**
   * Display a listing of the resource.
   *
   * @return Source\Renderer
   */
  static public function index()
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
  static public function create()
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
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Source\Renderer
   */
  static public function show($id)
  {
    $user = new UserModel();
    var_dump($user);
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
  static public function edit($id)
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
  static public function destroy($id)
  {
    $user = new UserModel();
    $user->delete($id);

    return Renderer::make('user/index');
  }
}
