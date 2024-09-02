<?php 
require 'functions.php';

if (isset($_POST["register"])) {

	if(register($_POST) > 0) {
		echo "<script>
		alert('Berhasil Sign Up')
		</script>";
	} else {
		echo mysqli_error($conn);
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrasi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>


<div class="container m-4">
<h1>Halaman Registrasi</h1>
	<a href="login.php">Kembali ke halaman Login</a>
<br><br>

	<form action="" method="post">
	    <div class="form-group">
	      <label for="username">Username</label>
	      <input autofocus type="text" class="form-control" name="username">
	    </div>
	    <div class="form-group">
	      <label for="password">Password</label>
	      <input autocomplete="off" type="password" class="form-control" name="password">
	    </div>
	    <div class="form-group">
	      <label for="password2">Confirm Password</label>
	      <input autocomplete="off" type="password" class="form-control" name="password2">
	    </div>
	  <div class="form-group">
	    <label for="email">Email</label>
	    <input type="email" class="form-control" name="email">
	  </div>
	  <div class="form-row">
	  <button name="register" type="submit" class="btn btn-primary">Sign Up</button>
	</form>
</div>





	<!-- <form action="" method="post" accept-charset="utf-8">
		<label>Username : </label>
		<input type="text" name="username">
		<br>
		<label>Password : </label>
		<input autocomplete="off" type="password" name="password">
		<br>
		<label>Confirm Password : </label>
		<input autocomplete="off" type="password" name="password2">
		<br>
		<label>Email : </label>
		<input type="email" name="email">
		<br>
		<button class="button" type="submit" name="register">Sign Up!</button>
	</form>
 -->
</body>
</html>