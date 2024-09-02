<?php 

require '../functions.php';


$keyword = $_GET["keyword"];


$query = "SELECT * FROM siswa WHERE
			nama LIKE '%$keyword%' OR
			nik LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%' OR
			email LIKE '%$keyword%'
	";

$siswa = query($query);

?>

<table border="2" cellpadding="10" cellspacing="0">
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
				<a class="button" href="update.php?id=<?php echo $sws["id"]; ?>">update</a>
				<a class="delete" href="delete.php?id=<?php echo $sws["id"]; ?>" onclick="return confirm('delete?');">delete</a>
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
