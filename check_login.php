<?php
include_once('app/config.php');

// Check if the page request type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) && 
    isset($_POST['email']) && isset($_POST['password'])) {
    
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  // Clean user input values
  $c_email = $mysqli->real_escape_string($email);
  $c_password = $mysqli->real_escape_string($password);
  
  $resultObj = $mysqli->query('SELECT * FROM `users` '
          . ' WHERE `email` = "' . $c_email . '"'
          . ' AND `password` = "' . sha1($c_password) . '"');
          
  if ($mysqli->affected_rows > 0) {
    $user_details = $resultObj->fetch_assoc();
    setcookie('uid', $user_details['user_id'], time() + (86400 * 30), '/');
    
    // Logged in, redirect to home.
    header('Location: home.php');
  } else {
    // Not logged in, redirect to login with error.
    header('Location: login.php?err=invalid');
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  header('Location: login.php');
}

