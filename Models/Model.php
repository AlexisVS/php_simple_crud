<?php

namespace Models;

use PDO;
use Source\Database;
use Source\Helper;

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
    $this->db = new Database;
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

      // [0] for delete a useless array
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
   * @return string
   */
  public function store($model): string
  {
    $modelKeys = implode(', ', array_keys($model));
    $modelValue = implode(', ', array_map(function ($item) {
      return "'" . $item . "'";
    }, array_values($model)));

    $sql = "INSERT INTO $this->tableName ($modelKeys) VALUES ($modelValue)";

    $this->db->executeQuery($sql);

    return "The elemenet has been added.";
  }

  /**
   * Update the selected riw in the table
   * 
   * @param int $id
   * @param array $model
   */
  public function update($id, $model)
  {
    $modelSql = [];
    foreach ($model as $key => $value) {
      array_push($modelSql, $key . '=' . "'" . $value . "'");
    }


    $modelSql = implode(', ', $modelSql);

    $sql = "UPDATE $this->tableName SET $modelSql WHERE id = $id";

    return $this->db->executeQuery($sql);
  }

  /**
   * Opere a where stataement in the table
   * 
   * @param string $colName
   * @param string $operator
   * @param string|int $value
   * 
   * @return array|string|false
   */
  public function where(string $colName, string $operator, string | int $value)
  {
    $sql = "SELECT * FROM $this->tableName WHERE $colName $operator $value";
    return $this->db->executeQuery($sql);
  }
}
