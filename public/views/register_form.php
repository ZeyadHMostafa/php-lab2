<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card">
    <h2>Create Account</h2>
    
    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <?php include __DIR__ . '/user_form_fields.php'; ?>

      <div class="button-group">
        <button type="submit" class="btn-save">Register</button>
        <button type="reset" class="btn-reset">Clear</button>
      </div>
    </form>
    
    <p><small>Already have an account? <a href="login.php">Login</a></small></p>
  </div>
</body>
</html>