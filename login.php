<div class="container-sm">
<?php 
  if(isset($_SESSION['login']) && $_SESSION['login'] == "failed"){
    echo '<div class="text-danger" for="uname">'.$_SESSION['message'].'</div>';
    unset($_SESSION['login']);
  }
?>

  <form action="action_login.php" method="post">
    <div class="container">
      <label for="uname">Username</label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw">Password</label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button type="submit">Login</button>
    </div>
  </form>
</div>
