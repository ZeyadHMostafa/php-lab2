<?php
class Database {
  protected $pdo;

  public function __construct() {
    $config = require __DIR__ . '/../config.php';
    $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']}";
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
      $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], $options);
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  public function select($table, $where = [], $orderBy = null) {
    $sql = "SELECT * FROM {$table}";
    $params = [];

    if (!empty($where)) {
      $conditions = [];
      foreach ($where as $column => $value) {
        $conditions[] = "{$column} = ?";
        $params[] = $value;
      }
      $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    if ($orderBy) {
      $sql .= " ORDER BY {$orderBy}";
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
  }

  public function insert($table, $data) {
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), "?"));
    $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
    
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute(array_values($data));
  }

  public function update($table, $data, $id) {
    $fields = implode(' = ?, ', array_keys($data)) . ' = ?';
    $sql = "UPDATE {$table} SET {$fields} WHERE id = ?";
    
    $params = array_values($data);
    $params[] = $id;

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute($params);
  }

  public function delete($table, $id) {
    $stmt = $this->pdo->prepare("DELETE FROM {$table} WHERE id = ?");
    return $stmt->execute([$id]);
  }
}