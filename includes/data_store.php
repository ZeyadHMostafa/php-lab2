<?php
define('DB_FILE', __DIR__ . '/../data/users.json');
define('UPLOAD_DIR', __DIR__ . '/../public/uploads/');

function get_all_users() {
  if (!file_exists(DB_FILE)) return [];
  $content = file_get_contents(DB_FILE);
  return json_decode($content, true) ?: [];
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
  $users = get_all_users();
  
  $email = $userData['email'];
  $users[$email] = $userData;
  
  return file_put_contents(DB_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function find_user_by_email($email) {
  $users = get_all_users();
  return $users[$email] ?? null;
}