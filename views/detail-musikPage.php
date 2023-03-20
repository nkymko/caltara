<?php 

include '../models/getdetail.php';

$id = $_GET['id'];

$detail = getdetail("SELECT * FROM seni_musik WHERE id = $id")[0];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Seni Musik</title>
    <link rel="stylesheet" href="../style/detail-musikPage.css" />
    <link rel="stylesheet" href="../style/detail-rumahPage.css" />
    <link rel="stylesheet" href="style/homePage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <!-- <div class="section-navbar">
        <nav class="nav-navbar">
          <ul class="nav-branding">
            <li><a href="#">CALTARA</a></li>
          </ul>
          <ul class="nav-menu">
            <li><a href="#">Beranda</a></li>
            <li><a href="rumahPage.html">Kategori</a></li>
            <li><a href="pameranPage.html">Pameran</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </nav>
      </div> -->

      <!-- content -->

      <div class="section-card">
        <a href="musikPage.php">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <div class="wrapper-card">
          <div class="card">
            <div class="left">
              <h1><?= $detail['nama_musik'] ?></h1>
              <p>
                <?= $detail['deskripsi'] ?>
              </p>
            </div>
            <div class="right">
              <img src="../musikAdat_img/<?= $detail['gambar'] ?>" alt="" />
            </div>
          </div>
        </div>
      </div>

      <!-- footer -->
      <!-- <footer>
        <div class="wrapper-footer">
          <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
        </div>
      </footer> -->
    </div>
  </body>
</html>
