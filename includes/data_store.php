<?php
require_once __DIR__ . '/../config.php';
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/');

function get_db_connection() {
  $config = require __DIR__ . '/../config.php';
  $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']}";
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
    return new PDO($dsn, $config['db_user'], $config['db_pass'], $options);
  } catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
  }
}

function find_user_by_id($id) {
  $pdo = get_db_connection();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute([$id]);
  return $stmt->fetch() ?: null;
}

function delete_user($id) {
  $pdo = get_db_connection();
  $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
  return $stmt->execute([$id]);
}

function get_all_users() {
  $pdo = get_db_connection();
  $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
  return $stmt->fetchAll();
}

function upload_profile_pic($file) {
  if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
    return null;
  }

  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
  $filename = bin2hex(random_bytes(8)) . "." . $ext;
  $target = UPLOAD_DIR . $filename;

  return move_uploaded_file($file['tmp_name'], $target) ? $filename : null;
}

function save_user_data($userData) {
  $pdo = get_db_connection();
  
  if (isset($userData['id']) && !empty($userData['id'])) {
    $sql = "UPDATE users SET name = :name, email = :email, room = :room, ext = :ext, pic = :pic WHERE id = :id";
    $stmt = $pdo->prepare($sql);
  } else {
    $sql = "INSERT INTO users (name, email, password, room, ext, pic) VALUES (:name, :email, :password, :room, :ext, :pic)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':password', $userData['password']);
  }

  $stmt->bindValue(':name', $userData['name']);
  $stmt->bindValue(':email', $userData['email']);
  $stmt->bindValue(':room', $userData['room']);
  $stmt->bindValue(':ext', $userData['ext']);
  $stmt->bindValue(':pic', $userData['pic']);
  
  if (isset($userData['id'])) {
    $stmt->bindValue(':id', $userData['id']);
  }

  return $stmt->execute();
}

function find_user_by_email($email) {
  $pdo = get_db_connection();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  return $stmt->fetch() ?: null;
}