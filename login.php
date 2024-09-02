<?php 
session_start();
require 'functions.php';

if (isset($_POST["registrasi"])) {
	header("Location: registrasi.php");
	exit;
}

if (isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn, "SELELCT username FROM users WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ($key === hash('sha256', $row['username'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION["login"])) {
	header("Location: index.php");
}


if (isset($_POST["login"])) {
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE
				username = '$username'");

	if (mysqli_num_rows($result) === 1) {
		
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])) {
			
			$_SESSION["login"] = true;

			if (isset($_POST['remember'])) {
				setcookie('id', $row['id'], time()+300);
				setcookie('key', hash('sha256', $row['username']), time()+300);
			}

			header("Location: index.php");
			exit;
		}

	}

	$error = true;

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>


<div class="container p-5 m-5">
<h1>Login</h1>
<br>

<?php if (isset($error)): ?>
	<p style="color:red; font-style: bold;">Username/Password salah</p>
<?php endif ?>

<form action="" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input autofocus autocomplete="off" type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" name="login" id="login" class="btn btn-primary mr-2">Submit</button>
  <button type="submit" name="registrasi" id="registrasi" class="btn btn-secondary">Registrasi</button>
</form>
</div>

</body>
</html>
