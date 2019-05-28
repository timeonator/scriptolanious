<?php

require_once('../../../private/initialize.php');
require_login();


if(!isset($_GET['user_id'])) {
  redirect_to(url_for('/admin/users/index.php'));
}
$user_id = $_GET['user_id'] ?? '';

if(is_post_request()) {
  $user = [];
  $user['user_id']=$user_id;
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['username'] = $_POST['username'] ?? '';
  $user['hashed_password'] = $_POST['hashed_password'] ?? '';

  $result = update_user($user);
  if($result === true) {
    $_SESSION['message'] =  "user updated successfully.";  
    redirect_to(url_for('/admin/users/show.php?user_id=' . $user_id));
  } else {
    $errors = $result;
  }
} else {
  $user = find_user_by_id($user_id);
}
?>

<?php $page_title = 'Edit admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/admin/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="user edit">
    <h1>Edit user</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/admin/users/edit.php?user_id=' . h(u($user_id))); ?>" method="post">
    <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo $user['email']; ?>" /></dd>
      </dl>
      <dl>
        <dt>User Name</dt>
        <dd><input type="text" name="username" value="<?php echo $user['username']; ?>" /></dd>
      </dl>
      <dl>

      <div id="operations">
        <input type="submit" value="Save" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
