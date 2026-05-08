<?php
require_once __DIR__ . '/data_store.php';

function register_user($data, $file) {
  $emailPattern = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
  $email = strtolower(trim($data['email']));
  $password = $data['password'];
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return "Invalid email format.";
  }

  if (!preg_match($emailPattern, $email)) {
    return "Invalid email format.";
  }

  if (find_user_by_email($email)) {
    return "Email already exists.";
  }

  if (!preg_match('/^[a-z0-9_]{8}$/', $password)) {
    return "Password must be exactly 8 characters (lowercase letters, numbers, and underscores only).";
  }

  if ($password !== $data['confirm_password']) {
    return "Passwords do not match.";
  }

  $filename = upload_profile_pic($file);
  if (!$filename) {
    return "Image upload failed.";
  }

  $newUser = [
    'name'     => trim($data['name']),
    'email'    => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'room'     => $data['room'],
    'ext'      => $data['ext'],
    'pic'      => $filename,
    'joined'   => date('Y-m-d')
  ];

  return save_user_data($newUser) ? true : "Failed to save user data.";
}

function attempt_login($email, $password) {
  $email = strtolower(trim($email));
  $user = find_user_by_email($email);
  
  if ($user && password_verify($password, $user['password'])) {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['profile_pic'] = $user['pic']; 
    return true;
  }
  
  return false;
}