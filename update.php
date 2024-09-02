<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 
require 'functions.php';

$id = $_GET["id"];

$fill = query("SELECT * FROM siswa WHERE id = $id")[0];

if (isset($_POST["submit"])) {
	if (ubah($_POST) > 0) {
		echo "
		<script>
			alert('Data berhasil diupdate!');
			document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('Data gagal diupdate!');
			document.location.href = 'index.php';
		</script>";
		}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Data Siswa</title>
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
		
	<h2>Masukkan Data: </h2>
<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $fill["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $fill["gambar"]; ?>">
	<div class="form-group mt-5">	
	<label>NIK: </label>
	<input autocomplete="off" autofocus class="form-control" required type="number" name="nik" value="<?= $fill["nik"]; ?>">
	</div>
	<br>
	<div class="form-group">
	<label>Nama: </label>
	<input autocomplete="off" class="form-control" required type="text" name="nama" value="<?= $fill["nama"]; ?>">
	</div>
	<br>
	<div class="form-group">
	<label>Jurusan: </label>
	<input autocomplete="off" class="form-control" required type="text" name="jurusan" value="<?= $fill["jurusan"]; ?>" >
	</div>
	<br>
	<div class="form-group">
	<label>Email: </label>
	<input autocomplete="off" class="form-control" required type="email" name="email" value="<?= $fill["email"]; ?>" >
	</div>
	<br>
	<div class="form-group">
	<label>Example file input</label>
	<img src="img/<?php echo $fill['gambar']; ?>" width="40">
	<br>
	<input class="form-control-file" type="file" name="gambar" value="<?= $fill["gambar"]; ?>">
	</div>
	<br>
	<button class="btn btn-primary" type="submit" name="submit">Tambah Data!</button>
</form>

	</div>


	
</body>
</html>
