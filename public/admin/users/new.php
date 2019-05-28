<?php
require_once('../../../private/initialize.php');
require_admin();

if(is_post_request()) {
  $user = [];
  $user['first_name'] = $_POST['first_name'] ?? '';
  $user['last_name'] = $_POST['last_name'] ?? '';
  $user['email'] = $_POST['email'] ?? '';
  $user['username'] = $_POST['username'] ?? '';
  $user['user_role'] = 'user';
  $user['last_login'] = date("Y-m-d h:i:s");
  $user['password'] = $_POST['password'] ?? '';
  $user['confirm_password'] =  $_POST['confirm_password'] ?? '';

  $result = insert_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = "New user was successfully added.";
    redirect_to(url_for('/admin/users/show.php?user_id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $user = [];
  $user['first_name'] =  '';
  $user['last_name'] =  '';
  $user['email'] =  '';
  $user['username'] =  '';
  $user['password'] =  '';
  $user['confirm_password'] =  '';
}



?>

<?php $page_title = 'Create user'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>
  <div class="user new">
    <h1>Create user</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/admin/users/new.php'); ?>" method="post">
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
        <dt>Password</dt>
        <dd><input type="password" name="password" value="<?php echo $user['password']; ?>" /></dd>
      </dl>
      <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="<?php echo $user['confirm_password']; ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create user" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
