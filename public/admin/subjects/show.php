<?php require_once('../../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$user_id = $_GET['subject_id'] ?? '1'; // PHP > 7.0
$user = find_subject_by_id($user_id);

?>

<?php $page_title = 'Show subjects'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('admin/subjects/index.php'); ?>">&laquo; Back to List</a>
  
  <div class="user show">
    <h1>user: <?php echo 'subjects' ?></h1>
    <div class="attributes">
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($user['sub_name']); ?></dd>
      </dl>
    </div>
  </div>
</div>
