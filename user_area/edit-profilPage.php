<?php 

require '../config/connect.inc.php';
require '../models/editprofil.php';
session_start();

if ( !isset($_SESSION['username'])) {
	header("Location: ../masukPage.php");
	exit;
}


$username = $_SESSION['username'];
// $profil = getdetail("SELECT * FROM users WHERE username = $username")[0];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$profil= mysqli_fetch_assoc($result);

// cek apakah tombol submit udh ditekan
if ( isset($_POST["selesai"]) ) {
 
    //cek apakah data berhasil diubah
    if( sunting($_POST) > 0){
        echo "
            <script>
            alert('Profil berhasil disunting');
            document.location.href = 'profilPage.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
            alert('Proses sunting gagal');
            document.location.href = 'profilPage.php';
            </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profil</title>
    <link rel="stylesheet" href="../style/edit-profilPage.css" />
  </head>
  <body>
    <div class="container">
      <div class="section-edit">
        <a href="profilPage.php">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <div class="wrapper-edit">
          <h1>Ubah Profil</h1>
          <div class="profil">
            <form action="" method="post" enctype="multipart/form-data">
        
            <input type="hidden" name="id" value="<?= $profil["id_user"]; ?>" >
		    <input type="hidden" name="gambarLama" value="<?= $profil["profpic"]; ?>" >
            <input type="hidden" name="username" value="<?= $profil["username"]; ?>" >
            <input type="hidden" name="password" value="<?= $profil["password"]; ?>" >
            <input type="hidden" name="email" value="<?= $profil["email"]; ?>" >
            <input type="hidden" name="kategori" value="<?= $profil["kategori"]; ?>" >
            

                <img src="user_profpic/<?= $profil["profpic"]; ?>" alt="" />
              <!-- <label for="myfile">Ganti foto profil</label> -->
              <input type="file" id="myfile" name="profpic" />
          </div>

          <div class="wrapper-input">
            <!-- <div class="judul">
              <p class="username">Username</p>
              <p class="email">Email</p>
              <p class="telp">No Telp</p>
              <p class="alamat">Alamat</p>
              <p class="bio">Bio</p>
            </div>

            <div class="input">
              <p class="harga">Rp 399.000.00</p>
              <p class="ongkir">Rp 15.000.00</p>
              <input type="text" class="telp" />
              <input type="text" class="alamat" />
              <input type="text" class="Bio" />
            </div> -->


            <div class="input username">
              <h5>Username</h5>
              <p><?= $profil["username"]; ?></p>
            </div>

            <div class="input email">
              <h5>Email</h5>
              <p><?= $profil["email"]; ?></p>
            </div>

            <div class="input telp">
              <h5>No Telp</h5>
              <input type="text" name="no_telp" placeholder="No Telepon" required value="<?= $profil["no_telp"]; ?>"/>
            </div>

            <div class="input alamat">
              <h5>Alamat</h5>
              <input type="text" name="lokasi" placeholder="Alamat" required value="<?= $profil["lokasi"]; ?>"/>
            </div>

            <div class="input bio">
              <h5>Bio</h5>
              <input type="text" name="bio" placeholder="Bio" required value="<?= $profil["bio"]; ?>" />
            </div>
          </div>

          <div class="button">
            <button type="submit" name="selesai">Selesai</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
