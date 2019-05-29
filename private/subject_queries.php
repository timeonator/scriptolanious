<?php

  function find_all_subjects($options=[]) {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY sub_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_subject_by_id($sub_id, $options =[]) {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE sub_id='" . db_escape($db, $sub_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
  }

  function find_subject_by_sub_name($sub_name, $options =[]) {
    global $db;
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE sub_name='" . db_escape($db, $sub_name) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
  }

  function validate_subject($subject, $options=[]) {

    $type = $options['type'] ?? '';
    $errors= array();

    if(is_blank($subject['sub_name'])) {
      $errors[] = "Subject name cannot be blank.";
    } elseif (!has_length($subject['sub_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Subject name must be between 2 and 255 characters.";
    }
    return $errors;
  }

  function insert_subject($subject) {
    global $db;
    $options['type']='new';
    $errors = validate_subject($subject, $options);
    if(!empty($errors)) {
      return $errors;
    }
    $sql = "INSERT INTO subjects ";
    $sql .= "(sub_name) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['sub_name']) . "'";
    $sql .= ")";

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

  function update_subject($subject) {
    global $db;
    $errors = validate_subject($subject);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "sub_name='" . db_escape($db, $subject['sub_name']) . "', ";
    $sql .= "WHERE sub_id ='" . db_escape($db, $subject['sub_id']) . "' ";
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

  function delete_subject($sub_id) {
    global $db;

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE sub_id='" . db_escape($db, $sub_id) . "' ";
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