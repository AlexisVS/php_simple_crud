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
   * @param int $id : id of the specified model
   * @return array|false
   */
  public function find(int $id): array|false
  {
    $sql = "SELECT * FROM $this->tableName WHERE id = $id";
    return $this->db->executeQuery($sql);
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
}
