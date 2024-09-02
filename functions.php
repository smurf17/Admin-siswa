<?php 
$conn = mysqli_connect("localhost","root","","siswa");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$sws = [];
	while ( $siswa = mysqli_fetch_assoc($result)) {
		$sws[] = $siswa;
	}
	return $sws;
}

function tambah($data) {
	global $conn;

	$nik = htmlspecialchars($data["nik"]);
	$nama = htmlspecialchars($data["nama"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$email = htmlspecialchars($data["email"]);
	
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	$insert = "INSERT INTO siswa VALUES
			('', '$nik', '$nama', '$jurusan', '$email', '$gambar')";
	mysqli_query($conn, $insert);

	return mysqli_affected_rows($conn);
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	if ($error === 4) {
		echo "<script>
					alert('pilih gambar terlebih dahulu!');
				</script>";

		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.' , $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
					alert('Your uploading isnt picture!');
				</script>";
		return false;
	}

	if ($ukuranFile > 2000000) {
		echo "<script>
					alert('Size is overload!');
				</script>";
		return false;
	}


	$namaBaru = uniqid();
	$namaBaru .= '.';
	$namaBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName,'img/' . $namaBaru);
	return $namaBaru ;

}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");

	return mysqli_affected_rows($conn);
}


function ubah($data) {
	global $conn;

	$id = $data["id"];
	$nik = htmlspecialchars($data["nik"]);
	$nama = htmlspecialchars($data["nama"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$email = htmlspecialchars($data["email"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}


	$insert = "UPDATE siswa SET
			nik = '$nik',
			nama = '$nama',
			jurusan = '$jurusan',
			email = '$email',
			gambar = '$gambar'

			WHERE id = $id;
			";
	mysqli_query($conn, $insert);

	return mysqli_affected_rows($conn);
}


function cari($keyword) {
	$query = "SELECT * FROM siswa WHERE
			nama LIKE '%$keyword%' OR
			nik LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%' OR
			email LIKE '%$keyword%'
	";
	return query($query);
}


function register($data) {
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$email = $data["email"];


	$result = mysqli_query($conn, "SELECT username FROM users WHERE 
		username = '$username' OR
		email = '$email'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username/email sudah terdaftar!')
				</script>";

				return false;
	}


	if($password !== $password2) {
		echo "<script>alert
				('Password tidak sama')
			</script>";
		return false;
	}


	$password = password_hash($password, PASSWORD_DEFAULT);
	$queryUser = "INSERT INTO users VALUES ('', '$username', '$password', '$email')";

	mysqli_query($conn, $queryUser);

	return mysqli_affected_rows($conn);

}
?>