<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card">
    <h2>Edit User: <?php echo htmlspecialchars($user_data['name']); ?></h2>
    
    <form method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
      
      <?php 
        $is_edit = true; 
        include __DIR__ . '/user_form_fields.php'; 
      ?>

      <div class="button-group">
        <button type="submit" class="btn-save">Update User</button>
        <a href="users.php" class="btn-reset btn-link">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>