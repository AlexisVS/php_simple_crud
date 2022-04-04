<?php

namespace Models;

use Traits\Authenticable;

class UserModel extends Model 
{
  use Authenticable;
  
  public string $tableName = 'users';
}
