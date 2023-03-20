<?php 

require_once 'include/login.inc.php';
session_start();

if ( !isset($_SESSION['username'])) {
	header("Location: masukPage.php");
	exit;
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $user[] = $row;

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
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
            <li class="liHome"><a href="homePage.php">Beranda</a></li>
            <li class="liKategori">
              <a href="">Kategori</a>
              <ul>
                <li class="liRumah"><a href="views/rumahPage.php">Ragam Adat</a></li>
                <li class="liTari"><a href="views/tariPage.php">Seni Pertunjukan</a></li>
                <li class="liKuliner"><a href="views/kulinerPage.php">Kuliner</a></li>
              </ul>
            </li>
            <li class="liPameran"><a href="views/pameranPage.php">Pameran</a></li>
            <a class="profil" href="user_area/profilPage.php">
              <img src="user_area/user_profpic/<?= $user[0]['profpic'] ?>" />
              <p><?= $user[0]['username'] ?></p>
            </a>
          </ul>
        </nav>
      </div>

      <div class="section-jumbotron">
        <div class="wrapper-jumbotron">
          <div class="left">
            <h1>Mengenali Nusantara lebih mudah bersama kami.</h1>
            <p>
              Hidup seorang manusia tidak bisa lepas dari budaya dan adat.<br />Cari dan ikut sebarkan karya nusantara yang kamu sukai
            </p>
            <div class="button-pameran">
              <button onclick="window.location.href='views/pameranPage.php'">Pameran</button>
            </div>
          </div>
          <div class="right">
            <img src="img/home-jumbotron2.png" alt="" />
          </div>
        </div>
      </div>

      <div class="section-ragamAdat">
        <div class="wrapper-ragamAdat">
          <h1>Ragam Adat</h1>
          <div class="wrapper-card">
            <div class="card pakaian">
              <div class="bg-img">
                <img src="img/home-pakaianAdat-blur.png" alt="" />
              </div>
              <a href="views/pakaianPage.php">
                <div class="content">
                  <h3>Pakaian Adat</h3>
                  <p>Kain tradisional adalah kain yang berasal dari budaya daerah lokal yang dibuat secara tradisional dan digunakan untuk kepentingan adat dan istiadat.</p>
                  <!-- <button>lihat selengkapnya</button> -->
                </div>
              </a>
            </div>
            <div class="card rumah">
              <div class="bg-img">
                <img src="img/home-rumahAdat-blur.png" alt="" />
              </div>
              <a href="views/rumahPage.php">
                <div class="content">
                  <h3>Rumah Adat</h3>
                  <p>Rumah yang dibangun dengan cara yang sama dari generasi kegenerasi dan tanpa atau dikit sekali mengalami perubahan.</p>
                  <!-- <button>lihat selengkapnya</button> -->
                </div>
              </a>
            </div>
            <div class="card upacara">
              <div class="bg-img">
                <img src="img/home-upacaraAdat-blur.png" alt="" />
              </div>
              <a href="views/upacaraPage.php">
                <div class="content">
                  <h3>Upacara Adat</h3>
                  <p>Upacara adat adalah salah satu tradisi masyarakat tradisional yang masih dianggap memiliki nilai-nilai yang masih cukup relevan bagi kebutuhan masyarakat pendukungnya.</p>
                  <!-- <button>lihat selengkapnya</button> -->
                </div>
              </a>
            </div>
          </div>
          <p>Kenali beragam-ragam adat dan budaya yang ada disekitarmu</p>
        </div>
      </div>

      <div class="section-pertunjukan">
        <div class="wrapper-pertunjukan">
          <h1>Seni Pertunjukan</h1>
          <div class="wrapper-tari">
            <img src="img/home-pertunjukan-tari.png" alt="" />
            <div class="desc tari">
              <h3>Seni Tari Tradisional</h3>
              <p>
              Tari rakyat yaitu tarian yang diciptakan oleh satu masyarakat di tempat yang berbeda-beda. Dalam pertunjukannya, setiap tarian juga memiliki ciri khas gerakan serta namanya sendiri. Tidak bisa ditentukan tahun berapa munculnya aliran tari rakyat ini.
              </p>
              <button onclick="window.location.href='views/tariPage.php'">selengkapnya</button>
            </div>
          </div>

          <div class="wrapper-teater">
            <img src="img/home-pertunjukan-teater.png" alt="" />
            <div class="desc teater">
              <h3>Seni Teater Tradisional</h3>
              <p>
              Teater yang menyajikan cerita kehidupan nyata di atas pentas. Jalan cerita yang disajikan biasanya mengandung pesan moral yang tersirat dan bisa dijadikan pelajaran kehidupan oleh para penonton. Teater adalah cabang kesenian yang lahir pada masa Yunani klasik.
              </p>
              <button onclick="window.location.href='views/teaterPage.php'">selengkapnya</button>
            </div>
          </div>

          <div class="wrapper-musik">
            <img src="img/home-pertunjukan-musik.png" alt="" />
            <div class="desc musik">
              <h3>Seni Musik Tradisional</h3>
              <p>
              Musik nusantara adalah musik yang berkembang di nusantara ini, yang menunjukkan atau menonjolkan ciri keindonesiaan, baik dalam bahasa manapun melodinya. Musik nusantara adalah musik yang dibuat oleh masyarakat indonesia atau musik made in Indonesia.  
              </p>
              <button onclick="window.location.href='views/musikPage.php'">selengkapnya</button>
            </div>
          </div>
        </div>
      </div>

      <div class="section-kuliner">
        <div class="wrapper-kuliner">
          <h1>Kuliner</h1>
          <div class="wrapper-rendang">
            <div class="desc-kuliner">
              <h3>Rendang</h3>
              <p>Indonesia dikenal sebagai negeri penghasil rempah yang berlimpah. Dari bumbu berdasar rempah inilah, banyak masakan khas asli Indonesia yang tercipta.</p>
            </div>
            <a href="views/kulinerPage.php">
              <img src="img/home-kuliner-rendang.png" alt="" />
            </a>
          </div>
        </div>
      </div>

      <footer>
        <footer>
          <div class="wrapper-footer">
            <a href="views/tentangPage.php">Tentang Kami</a>
            <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
          </div>
        </footer>
    </div>
  </body>
</html>
