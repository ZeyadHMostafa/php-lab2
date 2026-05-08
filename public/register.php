<?php
require_once __DIR__ . '/../includes/data_store.php';
require_once __DIR__ . '/../includes/auth.php';

$error = '';
$rooms = ['App1', 'App2', 'cloud'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $result = register_user($_POST, $_FILES['profile_pic']);
  
  if ($result === true) {
    header("Location: login.php?registered=1");
    exit;
  } else {
    $error = $result;
  }
}

include __DIR__ . '/views/register_form.php';