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
  // public $tableName;

  // public function __construct() {
  //     $tableName = strtolower(explode('\\', get_class($this))[1] . 's');
  // }


  /**
   * Query for specified request
   * 
   * @param int $id : id of the specified model
   */
  public function find(int $id): array|false
  {
    echo 'in find model';
    $db = new Database();

    $query = "SELECT FROM $this->tableName WHERE id = $id";

    var_dump($db->prepare($query)->fetchAll());
    return $db->prepare($query)->fetchAll();
  }
}
