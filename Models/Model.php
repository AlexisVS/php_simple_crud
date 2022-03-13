<?php

namespace Models;

use PDO;
use Source\Database;

class Model
{
  /**
   * Database instance
   */
  public PDO $db;

  /**
   * @var string $tableName
   */
  public string $tableName;

  public function __construct()
  {
  }


  /**
   * Query for specified request
   * 
   * @param int $id : id of the specified model
   */
  public function find(int $id): array|false
  {
    echo '<br> in find model <br><br>';
    $db = new Database();
    var_dump($db);
    $query = "SELECT FROM $this->tableName WHERE id = $id";
    // var_dump($db->query($query));
    return $db->query($query);
  }
}
