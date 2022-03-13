<?php

namespace Source;

use PDO;
use PDOException;

class Database extends PDO
{
  /**
   * Database instance
   */
  public PDO $pdo;

  /**
   * Database connexion information
   */
  public function __construct()
  {
    $dsn = sprintf('mysql:host=%s;dbname=%s;', Constant::DB_HOST, Constant::DB_NAME);
    $this->connexion();
  }

  /**
   * Connexion to database
   * 
   */
  private function connexion(): void
  {
    try {
      static::$pdo = new PDO($this->dsn, Constant::DB_USER, Constant::DB_PASSWORD);
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  /**
   * Disconnect the instance to database
   */
  public function disconnect(): void
  {
    $this->pdo = null;
  }

  protected function getInstance(): PDO
  {
    return static::$pdo;
  }
}
