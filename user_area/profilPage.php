<?php 

require '../config/connect.inc.php';
include '../models/history.php';
include '../models/posting.php';
include '../models/wishlist.php';
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

$post = getPost($profil['id_user']);
$wishlist = getWishlistProfil($profil['id_user']);


$history = getHistory($profil['id_user']);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Profil</title>
    <link rel="stylesheet" href="../style/profilPage-new.css" />
    <link rel="stylesheet" href="style/homePage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="section-navbar">
        <nav class="nav-navbar">
          <ul class="nav-branding">
            <li><a href="#">CALTARA</a></li>
          </ul>
          <ul class="nav-menu">
            <li class="nav-item liHome"><a href="../homePage.php">Beranda</a></li>
            <li class="nav-item liKategori">
              <p>Kategori</p>
              <ul>
                <li class="nav-item liRumah"><a href="../views/rumahPage.php">Ragam Adat</a></li>
                <li class="nav-item liTari"><a href="../views/tariPage.php">Seni Pertunjukan</a></li>
                <li class="nav-item liKuliner"><a href="../views/kulinerPage.php">Kuliner</a></li>
              </ul>
            </li>
            <li class="nav-item liPameran"><a href="../views/pameranPage.php">Pameran</a></li>
            <li class="nav-item">
              <a class="profil" href="profilPage.php">
                <img src="user_profpic/<?= $profil['profpic'] ?>" />
                <p><?= $profil['username'] ?></p>
              </a>
            </li>
          </ul>

          <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>
        </nav>
      </div>

      <!-- content -->
      <div class="section-sampul">
        <div class="wrapper-sampul">
          <div class="title-sampul">
            <h1>Candi Borobudur</h1>
            <p>Magelang, Jawa Tengah</p>
          </div>
        </div>
      </div>

      <div class="section-content">
        <div class="wrapper-content">
          <div class="wrapper-profil">
            <div class="image">
              <img src="user_profpic/<?= $profil['profpic'] ?>" alt="">
            </div>
            <div class="desc">
              <h2><?= $profil['username'] ?></h2>
              <h3><?= $profil['kategori'] ?></h3>
              <div class="detail">
                <div class="judul">
                  <p>Location</p>
                  <p>Email</p>
                  <p>Phone</p>
                  <p>Bio</p>
                </div>

                <div class="value">
                  <p>: <?= $profil['lokasi'] ?></p>
                  <p>: <?= $profil['email'] ?></p>
                  <p>: <?= $profil['no_telp'] ?></p>
                  <p>: <?= $profil['bio'] ?></p>
                </div>
              </div>

              <div class="edit">
                <a href="edit-profilPage.php">Sunting Profil</a>
              </div>

              <div class="logout">
                <button onclick="location.href='../include/logout.php';">Keluar</button>
              </div>
            </div>
          </div>


          <div class="wrapper-main">
            <?php if (!isset($post)) { ?>
            <div class="postingan">
              <h2>Postingan</h2>
              <div class="image">
                <h3>Ups, kamu belum memposting apapun :(</h3>
                <p>Ayo posting karyamu!</p>
                <button onclick="window.location.href='uploadPage.php'">unggah</button>
              </div>
            </div>

            <?php } else { ?> 
            <div class="postingan2">
              <div class="post">
                <h2>Postingan</h2>
                <a href="uploadPage.php">
                  <img src="../img/profil-add.png" alt="" />
                </a>
              </div>
              <div class="image">
              <?php if ( isset($post) ) { ?>
              <?php $i = 1; ?>
              <?php foreach ($post as $row) : ?>
                <!-- <img src="../img/profil-post1.png" alt="" class="main" /> -->
                <img src="user_uploadpic/<?= $row['foto_karya']; ?>" alt="" />
                <!-- <a href=""><img src="img/profil-lainnya.png" alt="" class="lainnya" /></a> -->
              <?php $i++ ?>
              <?php endforeach; ?>
              <?php } ?>
              </div>
            </div>
            <?php } ?>

            <div class="wishlist">
              <div class="title">
                <h2>Wishlist</h2>
              </div>
              <div class="image">
              <?php if ( isset($wishlist) ) { ?>
              <?php $i = 1; ?>
              <?php foreach ($wishlist as $row) : ?>
                <a href="../views/detail-pameranPage.php?id=<?= $row['id_karya'] ?>">
                  <img src="user_uploadpic/<?= $row['foto_karya'] ?>" alt="wishlist">
                </a>
              <?php $i++ ?>
              <?php endforeach; ?>
              <?php } else { ?>
              <div class="postingan">
                <div class="image">
                  <h3>Kamu belum menambahkan karya<br>apapun kedalam wishlist</h3>
                </div>
              </div>
              <?php } ?>
              </div>
            </div>

            <div class="riwayat-pembelian">
              <h2>Riwayat Pembelian</h2>
              <div class="wrapper-cards">
              <?php if ( isset($history) ) { ?>
              <?php $i = 1; ?>
              <?php foreach ($history as $row) : ?>
                <div class="card main">
                  <div class="left">
                    <div class="image"><img src="user_uploadpic/<?= $row['gambar_karya']; ?>"></div>
                    <div class="title-harga">
                      <h3><?= $row['nama_karya'] ?></h3>
                      <h5>Rp <?= $row['harga'] ?>.000</h5>
                    </div>
                  </div>
                  <div class="konfirm">
                    <p><?= $row['status'] ?></p>
                  </div>
                </div>
                <?php $i++ ?>
                <?php endforeach; ?>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // navbar
      const hamburger = document.querySelector(".hamburger");
      const navMenu = document.querySelector(".nav-menu");

      hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
      });

      document.querySelectorAll(".nav-link").forEach((n) =>
        n.addEventListener("click", () => {
          hamburger.classList.remove("active");
          navMenu.classList.remove("active");
        })
      );
      //end of navbar
    </script>
  </body>
</html>
