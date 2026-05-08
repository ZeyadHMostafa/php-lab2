<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card">
    <h2>Register</h2>
    
    <?php if ($error): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      
      <label>Room No</label>
      <select name="room">
        <?php foreach ($rooms as $room): ?>
          <option value="<?php echo $room; ?>"><?php echo $room; ?></option>
        <?php endforeach; ?>
      </select>

      <input type="text" name="ext" placeholder="Extension (e.g. 1234)">
      
      <label>Profile Picture</label>
      <input type="file" name="profile_pic" accept="image/*" required>

      <div class="button-group">
        <button type="submit" class="btn-save">Save</button>
        <button type="reset" class="btn-reset">Reset</button>
      </div>
    </form>
    
    <p><small>Already have an account? <a href="login.php">Login</a></small></p>
  </div>
</body>
</html>