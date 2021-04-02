<?php
require_once('../../../private/initialize.php');
require_admin();

if(is_post_request()) {
  $subject = [];
  $subject['sub_name'] = $_POST['sub_name'] ?? '';
 

  $result = insert_subject($subject);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = "New subject was successfully added.";
    redirect_to(url_for('/admin/subject/show.php?sub_id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $subject = [];
  $subject['sub_name'] =  '';
}
?>
<?php $page_title = 'Create subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/admin/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject new">
    <h1>Create subject</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/admin/subjects/new.php'); ?>" method="post">
      <dl>
        <dt>Subjectname</dt>
        <dd><input type="text" name="sub_name" value="<?php echo $subject['sub_name']; ?>" /></dd>
      </dl>
      <dl>

      <div id="operations">
        <input type="submit" value="Create subject" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
