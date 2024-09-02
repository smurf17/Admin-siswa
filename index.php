<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$siswa = query("SELECT * FROM siswa");

if( isset($_POST["cari"])) {
	$siswa = cari($_POST["keyword"]);
}

?>

<html>
<head>
	<title>HALAMAN ADMIN</title>
	<style>
		.loader {
			width: 100px;
			position: absolute;
			top: 88px;
			left: 260px;
			z-index: -1;
			display: none;

		} a {
			text-decoration: none;
			color: white;
		} body {
			  background-color: #f4f4f4;
			  font-family: Helvetica, sans-serif;
			  align-items: center;
			  justify-content: center;
			  height: 100vh;
		}
	</style>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/script.js"></script>
<!-- 	<link rel="stylesheet" href="style.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="jumbotron jumbotron-fluid mb-0">
  <div class="container">
    <h1 class="display-4 font-weight-bold">Siswa Terdaftar</h1>
	</div>
</div>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    <ul class="navbar-nav mr-auto mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="tambah.php">Daftar Siswa <span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0" action="" method="post" accept-charset="utf-8">
	      <input class="form-control mr-sm-2" type="text" name="keyword" size="30" autofocus placeholder="input keyword..." autocomplete="off" id="keyword">
	    </form>
	  </div>
	</nav>

	<img src="img/loader.gif" class="loader">


<br>

<div id="container" class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<table border="2" cellpadding="10" cellspacing="2" style="text-align: center">
			<thead>
				<tr>
					<th>No</th>
					<th>Edit</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Jurusan</th>
					<th>Email</th>
					<th>Gambar</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($siswa as $sws) :?>
				<tr>
					<td>
						<?php echo $i; ?>	
					</td>
					<td>
						<a class="btn btn-primary" role="button" href="update.php?id=<?php echo $sws["id"]; ?>">update</a>
						<a class="btn btn-danger" role="button" href="delete.php?id=<?php echo $sws["id"]; ?>"onclick="return confirm('delete?');">delete</a>
					</td>
					<td>
						<?php echo $sws["nik"]; ?>
					</td>
					<td>
						<?php echo $sws["nama"]; ?>
					</td>
					<td>
						<?php echo $sws["jurusan"]; ?>
					</td>
					<td>
						<?php echo $sws["email"]; ?>
					</td>
					<td>
						<img width="50" src="img/<?php echo $sws["gambar"]; ?>">
					</td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>

		</div>

		<br><br>
	</div>

<footer class="bg-dark text-white">
  <div class="container">
    <div class="row text-center">
      <div class="col mt-3">
        <p>© 2019 Data by <a href="">DAVID ALFAREZKY</a></p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>