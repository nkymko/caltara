<?php 

require '../config/connect.inc.php';
require '../models/uploadkarya.php';
session_start();

if ( !isset($_SESSION['username'])) {
	header("Location: ../masukPage.php");
	exit;
}


$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$profil= mysqli_fetch_assoc($result);

// cek apakah tombol submit udh ditekan
if ( isset($_POST["upload"]) ) {
 
    //cek apakah data berhasil diubah
    if( add($_POST) > 0){
        echo "
            <script>
            alert('Upload berhasil!');
            document.location.href = 'profilPage.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
            alert('Upload gagal!');
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
    <title>Upload Karya</title>
    <link rel="stylesheet" href="../style/uploadPage.css" />
  </head>
  <body>
    
    <div class="container">
      <div class="section-upload">
        <a href="profilPage.php">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <form action="" method="post" enctype="multipart/form-data"> 
        <div class="wrapper-upload">
          <h1>Unggah Karya</h1>
          <input type="hidden" name="id" value="<?= $profil["id_user"]; ?>" >
          <div class="img">
            <label for="myfile">Pilih file karya : </label>
            <input type="file" id="myfile" name="foto_karya" required/>
          </div>
          <input type="text" name="nama" placeholder="Nama Karya" required />

          <div class="dropdown">
            <div class="select">
              <span class="selected">Dijual</span>
              <div class="caret"></div>
            </div>
            <ul class="menu">
              <li class="active fs" onclick="showHarga()">Dijual</li>
              <li class="nfs" onclick="hideHarga()">Tidak Dijual</li>
            </ul>

            <input id="harga" type="text" name="harga" placeholder="Harga (Cth: 100.000)" />
          </div>

          <textarea placeholder="Keterangan" name="deskripsi" required></textarea>

          <div class="button">
            <button type="submit" name="upload">Unggah</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    
    <!-- script -->
    <script>
      const dropdowns = document.querySelectorAll(".dropdown");
      const harga = document.getElementById("harga");

      dropdowns.forEach((dropdown) => {
        const select = dropdown.querySelector(".select");
        const caret = dropdown.querySelector(".caret");
        const menu = dropdown.querySelector(".menu");
        const options = dropdown.querySelectorAll(".menu li");
        const selected = dropdown.querySelector(".selected");

        select.addEventListener("click", () => {
          select.classList.toggle("select-clicked");
          caret.classList.toggle("caret-rotate");
          menu.classList.toggle("menu-open");
        });

        options.forEach((option) => {
          option.addEventListener("click", () => {
            selected.innerHTML = option.innerHTML;
            select.classList.remove("select-clicked");
            caret.classList.remove("caret-rotate");
            menu.classList.remove("menu-open");

            options.forEach((option) => {
              option.classList.remove("active");
            });
            option.classList.add("active");
          });
        });
      });

      function showHarga() {
        harga.style.display = "block";
      }

      function hideHarga() {
        harga.style.display = "none";
      }
    </script>
  </body>
</html>
