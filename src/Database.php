<?php

namespace Source;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
  /**
   * Database instance
   * @var PDO $pdo
   */
  public PDO $pdo;

  /**
   * Connection data for Database
   * @var string $dsn
   */
  public string $dsn;

  /**
   * @var PDOStatement|false $stmt
   */
  public PDOStatement|false $stmt;

  /**
   * Database connexion information
   */
  public function __construct()
  {
    $this->dsn = sprintf('mysql:host=%s;dbname=%s;', Constant::DB_HOST, Constant::DB_NAME);
    $this->connexion();
  }

  /**
   * Connexion to database
   * 
   */
  protected function connexion(): void
  {
    try {
      $this->pdo = new PDO($this->dsn, Constant::DB_USER, Constant::DB_PASSWORD, [
        // Request a persistent connection, rather than creating a new connection.
        PDO::ATTR_PERSISTENT => true,
        // Throw a PDOException if an error occurs.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // PDO::ERRMODE_EXCEPTION => true,
      ]);
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }
  }

  /**
   * execute a query statically
   * 
   * @param string $sql
   * 
   * @return array | string | false
   */
  public static function query ($sql) {
    $db = new self();
    return $db->executeQuery($sql);
  }

  /**
   * Execute a query
   * 
   * @param string $sql
   */
  public function executeQuery(string $sql): array|string|false
  {
    try {
      $this->stmt = $this->getInstance()->prepare($sql);
      $this->stmt->execute();
      return $this->stmt->fetchAll();
    } catch (PDOException $e) {
      Helper::beautifful_print($e->getMessage());
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
    return $this->pdo;
  }
}
