<input
  type="text" name="name" placeholder="Full Name"
  value="<?php echo htmlspecialchars($user_data['name'] ?? ''); ?>"
  required
  >
  
<input
  type="email" name="email" placeholder="Email"
  value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>"
  required
  >

<?php if (!isset($is_edit) || !$is_edit): ?>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirm_password" placeholder="Confirm Password" required>
<?php endif; ?>

<label>Room No</label>
<select name="room">
  <?php foreach ($rooms as $room): ?>
    <option
      value="<?php echo $room; ?>"
      <?php echo (($user_data['room'] ?? '') === $room) ? 'selected' : ''; ?>
      >

      <?php echo $room; ?>
    </option>
  <?php endforeach; ?>
</select>

<input
  type="text" name="ext" placeholder="Extension (e.g. 1234)"
  value="<?php echo htmlspecialchars($user_data['ext'] ?? ''); ?>"
  >

<label>
  Profile Picture <?php echo isset($is_edit) ? '(Leave blank to keep current)' : ''; ?>
</label>
<input
  type="file" name="profile_pic" accept="image/*"
  <?php echo isset($is_edit) ? '' : 'required'; ?>
  >