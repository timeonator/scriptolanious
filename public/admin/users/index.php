<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $user_set = find_all_users(); ?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="user listing">
    <h1>Users</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/admin/users/new.php'); ?>">Create New User</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Last Login</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
        <tr>
          <td><?php echo h($user['user_id']); ?></td>
          <td><?php echo h($user['first_name']); ?></td>
          <td><?php echo h($user['last_name']); ?></td>
          <td><?php echo h($user['username']); ?></td>
          <td><?php echo h($user['email']); ?></td>
          <td><?php echo h($user['user_role']); ?></td>
          <td><?php echo h($user['last_login']); ?></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/show.php?user_id=' . h(u($user['user_id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/edit.php?user_id=' . h(u($user['user_id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/delete.php?user_id=' . h(u($user['user_id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($user_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
