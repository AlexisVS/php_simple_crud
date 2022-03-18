<?php

namespace Models;

use PDO;
use Source\Database;

class Model
{
  /**
   * Database instance
   */
  public Database $db;

  /**
   * @var string $tableName
   */
  public string $tableName;

  public function __construct()
  {
    $this->db = new Database();
  }

  /**
   * Query for specified request
   * 
   * @param int|array $id : id or array of id of the specified model
   * @return array|false
   */
  public function find(int $id): array|false
  {
    if (is_array($id)) {
      $sqlResponse = [];
      foreach ($id as $item) {
        $sql = "SELECT * FROM $this->tableName WHERE id = $item";
        array_push($sqlResponse, $this->db->executeQuery($sql));
      }
      return $sqlResponse;
    }
    if (is_integer($id)) {
      $sql = "SELECT * FROM $this->tableName WHERE id = $id";
      return $this->db->executeQuery($sql);
    }
  }

  /**
   * Take all row af the table
   * @return array|false
   */
  public function all(): array|false
  {
    $sql = "SELECT * FROM $this->tableName";
    return $this->db->executeQuery($sql);
  }

  /**
   * Delete specifique id to the table
   * @param int|array $id
   * @return array|false
   */
  public function delete(int|array $id): array|false
  {
    echo $id;
    var_dump($id);
    $sql = "DELETE FROM $this->tableName WHERE id = $id";
    return $this->db->executeQuery($sql);
  }
}
