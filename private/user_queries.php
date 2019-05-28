<?php

  function find_all_users($options=[]) {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY username ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_by_id($user_id, $options =[]) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_username($username, $options =[]) {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "'";
    echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_email($email, $options =[]) {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $email) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function validate_user($user, $options=[]) {

    $type = $options['type'] ?? '';
    $errors= array();

    if(is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (($type == 'new') &&  !has_unique_username($user['username'], $user['use_id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($type == 'new' ) {
      if (is_blank($user['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($user['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($user['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($user['password'] !== $user['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }
    return $errors;
  }

  function insert_user($user) {
    global $db;
    $options['type']='new';
    $errors = validate_user($user, $options);
    if(!empty($errors)) {
      return $errors;
    }
    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users ";
    $sql .= "(first_name,last_name,email,username,user_role,last_login,hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['first_name']) . "',";
    $sql .= "'" . db_escape($db, $user['last_name']) . "',";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $user['user_role']) . "',";
    $sql .= "'" . db_escape($db, $user['last_login']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";

    $sql .= ")";
    echo $sql;
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_user($user) {
    global $db;
    $errors = validate_user($user);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . db_escape($db, $user['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $user['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $user['email']) . "', ";
    $sql .= "username='" . db_escape($db, $user['username']) . "' ";
    $sql .= "WHERE user_id ='" . db_escape($db, $user['user_id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  function delete_user($user_id) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }