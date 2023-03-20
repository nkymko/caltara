<?php 

function add($data){
	global $conn;

    $id_user = $data["id"];
	$nama = htmlspecialchars($data['nama']);
 	$harga = htmlspecialchars($data['harga']);
 	$deskripsi = htmlspecialchars($data['deskripsi']);

 	// $gambar = htmlspecialchars($data['gambar']);

 	//upload gambar
 	$foto_karya = upload();
 	if( !$foto_karya ){
 		return false;
 	}

	if (empty($harga)) {
		$harga = "NOT FOR SALE";
	}

	$add = "INSERT INTO pameran VALUES(
			'','$nama', '$foto_karya', '$deskripsi', '$harga', '$id_user')";
	mysqli_query($conn, $add);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['foto_karya']['name'];
	$ukuranFile = $_FILES['foto_karya']['size'];
	$error = $_FILES['foto_karya']['error'];
	$tmpName = $_FILES['foto_karya']['tmp_name'];

	//cek apakah tidak ada gambar yang di upload

	if ( $error === 4) {
		echo "<script>
			alert('pilih gambar terlebih dahulu');
		</script>";

		return false;
	}

	//cek apakah file yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiUpload = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiUpload));

	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
			alert('ekstensi file tidak support!');
		</script>";

		return false;
	}

	//cek apakah ukuran file terlalu besar
	if($ukuranFile > 1000000){
		echo "<script>
			alert('ukuran file terlalu besar');
		</script>";

		return false;
	}

	//generate nama gambar baru apabila ada nama file yang sama
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'user_uploadpic/' . $namaFileBaru);

	return $namaFileBaru;

}

?>