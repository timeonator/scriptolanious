<?php
require_once('../../../private/initialize.php');
require_admin();

if(!isset($_GET['user_id'])) {
  redirect_to(url_for('admin/users/index.php'));
}
$user_id = $_GET['user_id'];
if(is_post_request()) {
  var_dump($_GET);
  $result = delete_user($user_id);
  $_SESSION['message'] =  "Admin deleted successfully.";
  redirect_to(url_for('/admin/users/index.php'));
} else {
  $user = find_user_by_id($user_id);
}
?>

<?php $page_title = 'Delete admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/admin/users/index.php'); ?>">&laquo; Back to List</a>
  <div class="user delete">
    <h1>Delete user</h1>
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?php echo h($user['first_name'] . " " . $user['last_name']); ?></p>
    <form method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete user" formaction="<?php echo url_for('/admin/users/delete.php?user_id=' . h(u($user['user_id']))); ?>"/>
        <input type="submit" name="cancel" value="Cancel delete" formaction="<?php echo url_for('/admin/users/index.php'); ?>"/>
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
