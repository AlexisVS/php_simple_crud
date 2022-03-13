<?php

namespace Source;

use PDO;
use PDOException;

class Database
{
  /**
   * Database instance
   */
  public PDO $pdo;

  /**
   * Connection data for Database
   * @var string $dsn
   */
  public string $dsn = sprintf('mysql:host=%s;dbname=%s;', Constant::DB_HOST, Constant::DB_NAME);

  /**
   * Database connexion information
   */
  public function __construct()
  {
    echo 'construct';
    $this->connexion();
  }

  /**
   * Connexion to database
   * 
   */
  protected function connexion(): void
  {
    echo 'connection';
    try {
      static::$pdo = new PDO($this->dsn, Constant::DB_USER, Constant::DB_PASSWORD);
      static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  /**
   * Execute a query
   * 
   * @param string $query
   */
  public function query(string $sql): array|false
  {
    echo 'dans query';
    $query = $this->getInstance()->prepare($sql);
    $query->execute();
    return $query->fetchAll();
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
