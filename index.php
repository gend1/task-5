<?php
require_once "includes/db.php";

if(isset($_POST['signin'])) {
  $errors = [];

  $user_q = mysqli_query($connection, "SELECT * FROM users WHERE email = '".$_POST['email']."'");
  $user = mysqli_fetch_assoc($user_q);
  if ($_POST['password'] !== $user['password']) {
    $errors[] = 'Пароль не подходит';
  }

  if(empty($errors)) {
    $user_q = mysqli_query($connection, "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'");
    $user = mysqli_fetch_assoc($user_q);
    $_SESSION['logged_user'] = $user;
    $new_url = 'task:8081/admin.php';
    header('Location: '.$new_url);

    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset ="UTF-8">
  <meta name="viewport" content ="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href = "css/style.css">
  <link rel="stylesheet" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Main</title>

</head>
<body class="text-center">

  <main class="form-signin">
    <form method="post">
      <img class="mb-2" src="img/1.jpg" width="40%" height="40%">
      <h1 class="h3 mb-3 fw-normal">Login</h1>

      <div class="mb-1 form-floating">
        <input type="email" name="email" class="form-control" placeholder="name@example.com" value="<?php echo $_POST['email']; ?>" required>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>

      <div
      class="checkbox mb-3">
    </div>
    <a class="mb-2" href = "signup.php">Regestration</a>
    <button name="form-signin" class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
  </form>
</main>

</body>
</html>
