<?php

require_once('../../../private/initialize.php');
require_login();


if(!isset($_GET['sub_id'])) {
  redirect_to(url_for('/admin/subjects/index.php'));
}
$sub_id = $_GET['sub_id'] ?? '';

if(is_post_request()) {
  $subject = [];
  $subject['sub_id']=$sub_id;
  $subject['sub_name'] = $_POST['sub_name'] ?? '';
 
  $result = update_subject($subject);
  if($result === true) {
    $_SESSION['message'] =  "subject updated successfully.";  
    redirect_to(url_for('/admin/subjects/show.php?sub_id=' . $sub_id));
  } else {
    $errors = $result;
  }
} else {
  $subject = find_subject_by_id($sub_id);
}
?>

<?php $page_title = 'Edit subject'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/admin/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit subject</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/admin/subjects/edit.php?sub_id=' . h(u($sub_id))); ?>" method="post">
      <dl>
        <dt>Subject Name</dt>
        <dd><input type="text" name="name" value="<?php echo $subject['sub_name']; ?>" /></dd>
      </dl>
      <dl>

      <div id="operations">
        <input type="submit" value="Save" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
