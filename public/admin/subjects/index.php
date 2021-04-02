<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $subject_set = find_all_subjects(); ?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="user listing">
    <h1>Users</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/admin/subjects/new.php'); ?>">Create New User</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Subjectname</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <tr>
          <td><?php echo h($subject['sub_id']); ?></td>
          <td><?php echo h($subject['sub_name']); ?></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/show.php?sub_id=' . h(u($subject['sub_id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/edit.php?sub_id=' . h(u($subject['sub_id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/users/delete.php?sub_id=' . h(u($subject['sub_id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
    <?php mysqli_free_result($subject_set); ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
