<?php
  if(!isset($page_title)) { $page_title = 'Admin Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>Admin - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="/stylesheets/admin.css" />
  </head>

  <body>
    <header>
      <h1>Admin Area</h1>
    </header>

    <navigation>
      <ul>
        <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
        <li><a href="<?php echo url_for('/admin/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
      </ul>
    </navigation>
    <?php echo display_session_message(); ?>

