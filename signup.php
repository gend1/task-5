<?php
	require_once "includes/db.php";

	if(isset($_POST['signup'])) {
		$errors = [];
		$login_q = mysqli_query($connection, "SELECT * FROM users");
		while ($login = mysqli_fetch_array($login_q)) {
			if ($_POST['email'] == $login['email']) {
				$errors[] = 'Почта уже используется, смените логин';
			}
		}

		if(empty($errors)) {
      $id_dates = date('Y-m-d H:i:s');
			mysqli_query($connection, "INSERT INTO users ( email, name, password, id, status, timereg) VALUES('".$_POST['email']."', '".$_POST['name']."', '".$_POST['password']."', '".$_POST['id']."' ,'unlocked', NOW())");
			$user_q = mysqli_query($connection, "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'");
			$user = mysqli_fetch_assoc($user_q);
			$_SESSION['logged_user'] = $user;
			header("Location: index.php");
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
  <title>SignUp</title>

</head>
<body class="text-center">
  </head>

  <main class="form-signup">
    <form method="post">
  		<h3>Имя</h3>
  		<input type="text" name="name" value="<?php echo $_POST['name']; ?>" required>
  		<?php if(!empty($errors)) {
  		echo $errors[0];
  	} ?>
  		<h3>E-mail</h3>
  		<input type="email" name="email" value="<?php echo $_POST['email']; ?>" required>
      <input type="hidden" name="regtime" value="" id="regtime">
      <input type="hidden" name="id" value="" id="userid">
  		<h3>Пароль</h3>
  		<input type="password" name="password" minlength="6" required>
  		<input type="submit" name="signup">
  	</form>
</main>
  <script type="text/javascript">
    const randomId = function(){
    return Math.floor(Math.random() * (1000000 - 0) + 0);
  }
      const userIdField = document.getElementById('userid');
      userIdField.value = `${randomId()}`;
  </script>

</body>
</html>
