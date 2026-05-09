<?php
session_start();
require_once __DIR__ . '/../includes/data_store.php';

if (!isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  $$userManager->deleteUser($id);
  header("Location: users.php");
  exit;
}

$users = $userManager->getAll();
include __DIR__ . '/views/list_view.php';