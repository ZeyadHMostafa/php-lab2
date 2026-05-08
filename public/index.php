<?php
session_start();
require_once __DIR__ . '/../includes/data_store.php';

if (!isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit;
}

$user = find_user_by_email($_SESSION['user_email']);

if (!$user) {
  session_destroy();
  header("Location: login.php");
  exit;
}

include __DIR__ . '/views/welcome_view.php';