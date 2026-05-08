<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome - <?php echo htmlspecialchars($user['name']); ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card profile-card">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    
    <div class="profile-header">
      <img src="uploads/<?php echo htmlspecialchars($user['pic']); ?>" alt="Profile Picture" class="avatar">
    </div>

    <div class="profile-details">
      <div class="detail-group">
        <label>Email Address</label>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
      </div>

      <div class="detail-group">
        <label>Room Number</label>
        <p><?php echo htmlspecialchars($user['room']); ?></p>
      </div>

      <div class="detail-group">
        <label>Extension</label>
        <p><?php echo htmlspecialchars($user['ext'] ?: 'N/A'); ?></p>
      </div>
    </div>

    <hr>
    <div class="button-group">
      <a href="users.php" class="btn-list btn-link">users</a>
      <a href="logout.php" class="btn-reset btn-link">Logout</a>
    </div>
  </div>
</body>
</html>