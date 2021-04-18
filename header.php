<header></header>
<ul>
  <li><a href="index.php">Main</a></li>
  <li><a href="signup.php">Registration</a></li>
  <?php
  if (isset($_SESSION['logged_user'])) {
    ?>
    <li><a href="logout.php">Sign out</a></li>
    <p><?php echo $_SESSION['logged_user']['name']?></p>
    <?php
  } else {
    ?>
    <li><a href="index.php">Log in</a></li>
    <?php
  }
  ?>
</ul>
</header>
