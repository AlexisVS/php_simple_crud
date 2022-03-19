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
      // [0] for delete an useless array
      return $this->db->executeQuery($sql)[0];
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
  public function delete(int|array $id): string
  {
    if (is_array($id)) {
      foreach ($id as $item) {
        $sql = "DELETE FROM $this->tableName WHERE id = $item";
        $this->db->executeQuery($sql);
        return 'All element has been successfully deleted.';
      }
    }
    if (is_integer($id)) {
      $sql = "DELETE FROM $this->tableName WHERE id = $id";
      $this->db->executeQuery($sql);
      return 'The element has been successfully deleted.';
    }
    return 'A problem has been occured.';
  }

  /**
   * Store a new row in table
   * 
   * @param array $model
   * @return array
   */
  public function store($model) {
    $modelKeys = array_keys($model);
    $modelValue = array_values($model);

    $sql = "INSERT INTO $this->tableName ($modelKeys) VALUES ($modelValue)";
    $this->db->executeQuery($sql);
    return "The elemenet has been added.";
  }
}
