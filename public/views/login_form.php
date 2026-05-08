<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card">
    <h2>Login</h2>
    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="POST" action="login.php">
      <label>Email</label>
      <input type="email" name="email" required>
      
      <label>Password</label>
      <input type="password" name="password" required>
      
      <button type="submit">Enter</button>
    </form>
    <p><small>Need an account? <a href="register.php">Register</a></small></p>
  </div>
</body>
</html>