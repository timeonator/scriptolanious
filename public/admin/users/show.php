<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$user_id = $_GET['user_id'] ?? '1'; // PHP > 7.0
$user = find_user_by_id($user_id);

?>

<?php $page_title = 'Show user'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('admin/users/index.php'); ?>">&laquo; Back to List</a>


  <div class="user show">

    <h1>user: <?php echo 'users' ?></h1>

    <div class="attributes">
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($user['first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($user['last_name']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user['email']); ?></dd>
      </dl>
      <dl>
        <dt>User Name</dt>
        <dd><?php echo h($user['username']); ?></dd>
      </dl>
      <dl>
        <dt>Passwword</dt>
        <dd><?php echo h($user['hashed_password']); ?></dd>
      </dl>
    </div>

  </div>

</div>
