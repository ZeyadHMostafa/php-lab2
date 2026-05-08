<?php
session_start();
require_once __DIR__ . '/../includes/data_store.php';

if (!isset($_SESSION['user_email'])) {
  header("Location: login.php");
  exit;
}

$rooms = ['App1', 'App2', 'cloud'];
$error = '';
$user_id = $_GET['edit'] ?? $_POST['id'] ?? null;

if (!$user_id) {
  header("Location: users.php");
  exit;
}

$user_data = find_user_by_id($user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST;
  
  if (!empty($_FILES['profile_pic']['tmp_name'])) {
    $data['pic'] = upload_profile_pic($_FILES['profile_pic']);
  } else {
    $data['pic'] = $user_data['pic'];
  }

  if (save_user_data($data)) {
    header("Location: users.php?updated=1");
    exit;
  } else {
    $error = "Failed to update user.";
  }
}

include __DIR__ . '/views/edit_user_view.php';