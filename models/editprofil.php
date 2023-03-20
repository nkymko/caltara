<?php 


function sunting($data){
	global $conn;

	$id_user = $data["id"];
	$username = htmlspecialchars($data['username']);
    // $password = $data['password'];
 	$email = htmlspecialchars($data['email']);
 	$no_telp = htmlspecialchars($data['no_telp']);
 	$lokasi = htmlspecialchars($data['lokasi']);
    $bio = htmlspecialchars($data['bio']);
 	$gambarLama = $data['gambarLama'];
    $kategori= $data['kategori'];

 	//cek apakah gambar diupdate
 	if ( $_FILES['profpic']['error'] === 4 ) {
 		$gambar = $gambarLama;
 	}
 	else{
 		$gambar = upload();
 	}
 	

 	$query = "UPDATE users SET 
 			username='$username', 
 			email='$email', 
 			lokasi='$lokasi', 
 			no_telp='$no_telp',
            bio='$bio',
            profpic='$gambar',
            kategori='$kategori' 
 			WHERE id_user = $id_user";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload(){

	$namaFile = $_FILES['profpic']['name'];
	$ukuranFile = $_FILES['profpic']['size'];
	$error = $_FILES['profpic']['error'];
	$tmpName = $_FILES['profpic']['tmp_name'];

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

	move_uploaded_file($tmpName, 'user_profpic/' . $namaFileBaru);

	return $namaFileBaru;

}

?>