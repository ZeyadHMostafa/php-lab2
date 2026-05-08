<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Directory</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="card list-card">
    <div style="overflow: hidden;">
      <h2>User Directory</h2>
    </div>

    <table>
      <thead>
        <tr>
          <th>Photo</th>
          <th>Name</th>
          <th>Email</th>
          <th>Room/Ext</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td>
              <img src="uploads/<?php echo htmlspecialchars($u['pic'] ?: 'default.png'); ?>" class="list-avatar">
            </td>
            <td><strong><?php echo htmlspecialchars($u['name']); ?></strong></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['room'] . " / " . ($u['ext'] ?: 'N/A')); ?></td>
            <td class="actions">
              <a href="edit_user.php?edit=<?php echo $u['id']; ?>" class="btn-edit">Edit</a>
              <a href="users.php?delete=<?php echo $u['id']; ?>" 
                 class="btn-delete" 
                 onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    
    <div class="button-group" style="margin-top: 20px;">
      <a href="index.php" class="btn-reset btn-link">Back to Profile</a>
    </div>
  </div>
</body>
</html>