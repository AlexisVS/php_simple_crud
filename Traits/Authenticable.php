<?php

namespace Traits;

use Source\Database;
use Source\Helper;

trait Authenticable
{


  /**
   * log the user
   * 
   * @return void
   */
  public function login(array $userData): void
  {
    $email = $userData['email'];
    try {
      $response = Database::query("SELECT * FROM users WHERE email = '$email'");
      if (is_array($response)) {
        $_SESSION['user'] = $response[0];
      }
    } catch (\Exception $e) {
      Helper::beautifful_print($e->getMessage());
    }
  }

  /**
   * disconnect the user
   */
  public function logout()
  {
  }

  /**
   * store the user data in the session
   */
  public function userData()
  {
  }

  /** 
   * delete the user data from the session
   */
  public function destroyUser()
  {
  }
}
