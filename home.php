<?php
include_once('app/config.php');

$user = new User();

// Check if the user is logged in
if (isset($_COOKIE['uid']) && is_numeric($_COOKIE['uid']) && 
    in_array($_COOKIE['uid'], array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10))) {
      
  $user = $user->getUser($mysqli, (int)$_COOKIE['uid']);
  
  $relation = new Relation($mysqli, $user);
} else {
  header('Location: login.php');
}

$msg = '';
$status = array(
  'success' => 'Operation performed Successfully.',
  'failed' => 'Action Failed to process!'
);

if (isset($_COOKIE['status']) && array_key_exists($_COOKIE['status'], $status)) {
  $msg = $status[$_COOKIE['status']];
  // clear the cookie
  setcookie('status', '');
  unset($_COOKIE['status']);
}
?>
<!-- Basic html tags -->
<?php
if ($msg !== '') echo '<p>' . $msg . '</p>';
?>

<div class="user-details">
    <p>Username: <b><?php echo $user->getName(); ?></b></p>
    <p>Email: <b><?php echo $user->getEmail(); ?></b></p>
  <p><a href="logout.php" title="logout">Logout</a></p>
  <hr/>
  <h4>Friends</h4>
  <?php
  include_once('includes/user_friends.php');
  ?>
</div>

<div>
  <h3>Friend Requests</h3>
  <div>
    <?php
    include_once('includes/user_friend_requests.php');
    ?>
  </div>
</div>

<div>
  <h3>Blocked Friends</h3>
  <div>
    <?php
    include_once('includes/blocked_friends.php');
    ?>
  </div>
</div>
