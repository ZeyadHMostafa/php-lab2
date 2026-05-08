<?php
require_once __DIR__ . '/../includes/data_store.php';
require_once __DIR__ . '/../includes/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  if (attempt_login($email, $password)) {
    header("Location: index.php");
    exit;
  } else {
    $error = "Invalid email or password.";
  }
}

include __DIR__ . '/views/login_form.php';