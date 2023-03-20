<?php

  include '../models/kulinernusantara.php';
  session_start();

  if (isset($data)) {
    $kuliner = $data;
  }
  
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $profil= mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Kuliner</title>
    <link rel="stylesheet" href="../style/kulinerPage.css" />
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
            <li class="liHome"><a href="../homePage.php">Beranda</a></li>
            <li class="liKategori">
              <a href="">Kategori</a>
              <ul>
                <li class="liRumah"><a href="rumahPage.php">Ragam Adat</a></li>
                <li class="liTari"><a href="tariPage.php">Seni Pertunjukan</a></li>
                <li class="liKuliner"><a href="kulinerPage.php">Kuliner</a></li>
              </ul>
            </li>
            <li class="liPameran"><a href="pameranPage.php">Pameran</a></li>
            <a class="profil" href="../user_area/profilPage.php?id=<?= $profil['id_user'] ?>">
              <img src="../user_area/user_profpic/<?= $profil['profpic'] ?>" />
              <p><?= $profil['username'] ?></p>
            </a>
          </ul>
        </nav>
      </div>

      <!-- hero -->
      <div class="section-hero">
        <div class="wrapper-hero">
          <div class="left">
            <h1>Kuliner Nusantara</h1>
            <p>
              Indonesia dikenal sebagai negeri penghasil rempah yang berlimpah. Dari bumbu berdasar rempah inilah, banyak masakan khas asli Indonesia yang tercipta. Bukan itu saja. Interaksi perdagangan dengan negeri luar, menciptakan persilangan jenis masakan yang juga memperkaya selera, dan setiap daerah pasti memiliki makanan khas daerahnya masing-masing. Jadi tak heran mengapa makanan nusantara begitu banyaknya
            </p>
          </div>
          <div class="right">
            <img src="../img/kuliner-hero.png" alt="" />
          </div>
        </div>
      </div>

      <!-- content -->
      <div class="section-content">
        <div class="wrapper-content">
          <h2>Cari sesuatu di <span class="highlight">Kuliner Nusantara</span></h2>
          <div class="container-search">
            <form action="" method="post" class="search-bar">
              <input type="text" name="keyword" placeholder="search..." name="s" />
              <button type="submit" name ="search"><i class="fa fa-search"></i></button>
          </div>
        </div>

        <!-- title -->
        <div class="wrapper-title">
        <?php if (!isset($_POST["search"])) { ?>
          <h3>Berbagai macam Kuliner Nusantara</h3>
          <?php } else { ?>
          <h3>Menampilkan hasil pencarian '<?= $_POST['keyword'] . " " ?><?= "(" . $_POST['filter_daerah'] . ")" ?>'</h3>
          <?php } ?>
          <div class="filter" style="width: 200px">
            <select name="filter_daerah">
                <option value="">Daerah</option>
                <option value="Sumatera" <?php if ($daerah == "Sumatera"){ echo "selected"; } ?> >Sumatera</option>
                <option value="Jawa" <?php if ($daerah == "Jawa"){ echo "selected"; } ?> >Jawa</option>
                <option value="Kalimantan" <?php if ($daerah == "Kalimantan"){ echo "selected"; } ?> >Kalimantan</option>
                <option value="Nusa Tenggara" <?php if ($daerah == "Nusa Tenggara"){ echo "selected"; } ?> >Nusa Tenggara</option>
                <option value="Sulawesi" <?php if ($daerah == "Sulawesi"){ echo "selected"; } ?> >Sulawesi</option>
                <option value="Maluku" <?php if ($daerah == "Maluku"){ echo "selected"; } ?>>Maluku</option>
               <option value="Papua" <?php if ($daerah == "Papua"){ echo "selected"; } ?> >Papua</option>
             </select>
          </div>
          </form>
        </div>
      </div>

      <div class="section-card">
        <div class="wrapper-card">
          <?php if (isset($data)) { ?>
          <?php $i = 1; ?>
          <?php foreach ($kuliner as $row) : ?>
          <a href="detail-kulinerPage.php?id=<?= $row['id'] ?>">
            <div class="card">
              <div class="image">
                <img src="../kuliner_img/<?= $row['gambar_kuliner'] ?>" alt="" />
              </div>
              <div class="desc">
                <h3><?= $row['nama_kuliner'] ?></h3>
                <p><?= $row['preview'] ?></p>
              </div>
            </div>
          </a>
          <?php $i++ ?>
          <?php endforeach; ?>
          <?php } else { ?>
          <p>Tidak ada data yang ditemukan</p>
          <?php } ?>
        </div>
      </div>

      <!-- footer -->
      <footer>
        <div class="wrapper-footer">
          <a href="tentangPage.php">Tentang Kami</a>
          <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
        </div>
      </footer>
    </div>
  </body>
</html>
