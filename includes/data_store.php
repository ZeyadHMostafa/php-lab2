<?php
require_once __DIR__ . '/database.php';

class UserManager extends Database {
  private const UPLOAD_DIR = __DIR__ . '/../public/uploads/';

  public function findById($id) {
    $result = $this->select('users', ['id' => $id]);
    return $result[0] ?? null;
  }

  public function findByEmail($email) {
    $result = $this->select('users', ['email' => $email]);
    return $result[0] ?? null;
  }

  public function getAll() {
    return $this->select('users', [], 'created_at DESC');
  }

  public function deleteUser($id) {
    $user = $this->findById($id);
    
    if (!$user) {
      return false;
    }

    $dbDeleted = $this->delete('users', $id);

    if ($dbDeleted && !empty($user['pic'])) {
      $filePath = self::UPLOAD_DIR . $user['pic'];
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }

    return $dbDeleted;
  }

  public function uploadProfilePic($file) {
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
      return null;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = bin2hex(random_bytes(8)) . "." . $ext;
    $target = self::UPLOAD_DIR . $filename;

    return move_uploaded_file($file['tmp_name'], $target) ? $filename : null;
  }

  public function save($userData) {
    $id = $userData['id'] ?? null;
    unset($userData['id']);

    if ($id) {
      return $this->update('users', $userData, $id);
    } else {
      return $this->insert('users', $userData);
    }
  }
}

$userManager = new UserManager();