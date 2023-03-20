<?php

  include '../models/getdetail.php';
  session_start();

  if ( !isset($_SESSION['username'])) {
	  header("Location: ../masukPage.php");
	  exit;
  }

  $username = $_SESSION['username'];
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $profil= mysqli_fetch_assoc($result);
  $pameran = getdetail("SELECT * FROM pameran ");
  

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pameran</title>
    <!-- <link rel="stylesheet" href="../style/pameranPage.css" /> -->
    <link rel="stylesheet" href="style/homePage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- style -->
    <style>
      *,
html,
body {
  padding: 0;
  margin: 0;
  font-family: Poppins;
  color: var(--bg-primary);
}

body {
  background-color: white;
}

:root {
  --bg-primary: #362a29;
  --bg-light: white;
}

.container {
  /* background-color: salmon; */
  max-width: 100%;
  margin: auto;
}

.section-navbar {
  position: fixed;
  width: 100%;
  box-sizing: border-box;
  background-color: white;
  padding: 0.5rem 4rem;
  box-shadow: 0 4px 20px rgba(92, 92, 92, 0.25);
  z-index: 10000;
}

.nav-navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-branding {
  list-style: none;
}

.nav-branding li a {
  text-decoration: none;
  font-size: 2rem;
  font-weight: 270;
}

.nav-menu {
  display: flex;
  list-style: none;
  gap: 2rem;
  align-items: center;
}

.nav-menu li a {
  text-decoration: none;
  font-size: 1rem;
}

.nav-menu li:hover {
  font-weight: 600;
}

.liPameran {
  font-weight: 600;
}

.nav-menu ul {
  font-weight: 400;
  position: absolute;
  display: none;
  flex-direction: column;
  list-style: none;
  padding: 2rem;
  margin-left: -2rem;
  gap: 2rem;
  background-color: white;
  border-radius: 0 0 20px 20px;
}

.nav-menu li:hover > ul {
  display: flex;
}

.nav-menu .profil {
  display: flex;
  align-items: center;
  border: 1px solid var(--bg-primary);
  border-radius: 10px;
  /* gap: 0.5rem; */
  /* padding-right: 0.5rem; */
  text-decoration: none;
}

.profil img {
  width: 35px;
  height: 35px;
  border-radius: 10px 0 0 10px;
  /* border-right: 1px solid var(--bg-primary); */
}

.profil p {
  padding: 0 0.8rem;
}

/* hamburger menu */
.hamburger {
  display: none;
  cursor: pointer;
}

.bar {
  display: block;
  width: 25px;
  height: 3px;
  margin: 5px auto;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  background-color: black;
}
/* end of hamburger menu */

/* carousel */
* {
  box-sizing: border-box;
}

.mySlides {
  display: none;
}
img {
  vertical-align: middle;
}

/* Slideshow container */
.section-container {
  background-color: white;
  max-width: 1440px;
  position: relative;
  padding-top: 4rem;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* The dots/bullets/indicators */
.wrapper-dot {
  margin-top: -40px;
}

.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  /* background-color: #bbb; */
  border: 1px solid white;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  /* top: -40px; */
  transition: background-color 0.6s ease;
}

.active {
  background-color: #ffd701;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1s;
}

@keyframes fade {
  from {
    opacity: 0.5;
  }
  to {
    opacity: 1;
  }
}

/* gallery */
.section-gallery {
  max-width: 1440px;
  margin: auto;
  background-image: url(../img/pameran-bg.png);
  /* background-color: white; */
  /* margin-top: -10px; */
}

.wrapper-gallery {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 4rem 5rem;
  gap: 4rem;
}

.wrapper-gallery h1 {
  font-size: 2.5rem;
  font-weight: 800;
  text-align: center;
}

.wrapper-card {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  justify-content: center;
}

.card {
  width: 370px;
  display: flex;
  flex-direction: column;
  /* align-items: center; */
  background-color: rgb(255, 255, 255);
  border: 1px solid rgba(46, 46, 46, 0.23);
  border-radius: 20px;
  box-sizing: border-box;
  transition: ease-in-out 0.2s;
}

.card:hover {
  transform: scale(105%);
  box-shadow: 0px 0.7px 6.4px rgba(0, 0, 0, 0.016), 0px 1.8px 12.8px rgba(0, 0, 0, 0.021), 0px 3.4px 19.8px rgba(0, 0, 0, 0.024), 0px 6px 29.3px rgba(0, 0, 0, 0.029), 0px 11.3px 47px rgba(0, 0, 0, 0.038), 0px 27px 112px rgba(0, 0, 0, 0.07);
}

.card .image {
  width: 100%;
  height: 210px;
}

.card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 20px 20px 0 0;
}

.card .desc {
  display: flex;
  flex-direction: column;
  /* gap: 0.5rem; */
  justify-content: space-between;
  padding: 0.8rem;
  height: 50%;
}

.card h3 {
  font-size: 1rem;
  font-weight: 600;
}

.card p {
  font-size: 0.75rem;
}

.more-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1rem;
}

.more-card h6 {
  font-size: 0.75rem;
  font-weight: 400;
}

.more-card button {
  all: unset;
  background-image: linear-gradient(to bottom right, rgba(249, 193, 19, 0.8), rgba(239, 131, 16, 0.8));
  border-radius: 10px 0 10px 0;
  border: 1px solid #ef8310;
  padding: 0.5rem 1rem;
  color: var(--bg-light) !important;
  font-size: 0.75rem;
}

.more-card button:hover {
  background-image: linear-gradient(to bottom right, rgba(249, 193, 19, 1), rgba(239, 131, 16, 1));
  cursor: pointer;
}

/* footer */
footer {
  max-width: 1440px;
  margin: auto;
}

.wrapper-footer {
  background-color: white;
  text-align: center;
  padding: 1.25rem;
  box-shadow: 0 -2px 30px rgba(92, 92, 92, 0.25);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.wrapper-footer a {
  font-size: 1.25rem;
  font-weight: 600;
  text-decoration: none;
}

/* responsive */
@media screen and (max-width: 600px) {
  .nav-menu ul {
    width: 90%;
    font-weight: 400;
    position: absolute;
    display: none;
    flex-direction: column;
    list-style: none;
    padding: 0rem;
    margin-left: 0rem;
    gap: 0rem;
    transform: translateX(-50%);
    left: 50%;
    background-color: white;
    border-radius: 0 0 20px 20px;
    border: 1px solid var(--bg-primary);
    border-top: none;
  }

  .nav-menu li:hover > ul {
    display: flex;
  }

  /* hamburger menu */
  .hamburger {
    display: block;
  }

  .hamburger.active .bar:nth-child(2) {
    opacity: 0;
  }

  .hamburger.active .bar:nth-child(1) {
    transform: translateY(8px) rotate(45deg);
  }

  .hamburger.active .bar:nth-child(3) {
    transform: translateY(-8px) rotate(-45deg);
  }

  .nav-menu {
    position: absolute;
    padding: 0;
    left: -100%;
    top: 64px;
    gap: 0;
    flex-direction: column;
    background-color: white;
    box-sizing: border-box;
    border-bottom: 1px solid;
    width: 100%;
    text-align: center;
    transform: 0.3s;
    border-top: 1px solid var(--bg-primary);
  }

  .nav-item {
    margin: 16px 0;
  }

  .nav-menu.active {
    left: 0;
  }
  /* end of hamburger */

  /* carousel */
  .mySlides {
    height: 200px;
  }

  .mySlides img {
    height: 100%;
    object-fit: cover;
  }

  .dot {
    height: 12px;
    width: 12px;
  }

  /* content */
  .wrapper-gallery {
    padding: 2rem;
    gap: 2rem;
  }

  .wrapper-gallery h1 {
    font-size: 1.5rem;
    text-align: center;
    /* padding: 0 5rem; */
  }

  /* cards */
  .wrapper-card {
    /* padding: 0 3rem; */
  }

  .card {
    width: auto;
    align-items: center;
  }

  .card .image {
    width: 100%;
  }

  .more-card {
    /* flex-direction: column; */
  }
}

    </style>
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

      <!-- carousel -->
      <div class="section-container">
        <div class="mySlides fade">
          <img src="../img/pameran-hero1.png" style="width: 100%" />
        </div>

        <div class="mySlides fade">
          <img src="../img/pameran-hero2.png" style="width: 100%" />
        </div>

        <div class="mySlides fade">
          <img src="../img/pameran-hero3.png" style="width: 100%" />
        </div>

        <div class="wrapper-dot" style="text-align: center">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      </div>

      <!-- gallery -->
      <div class="section-gallery">
        <div class="wrapper-gallery">
          <h1>Temukan hal yang kamu sukai</h1>
          <div class="wrapper-card">
          <?php $i = 1; ?>
          <?php foreach ($pameran as $row) : ?>
            <?php if (strlen($row['deskripsi']) > 70) {
                        $row['deskripsi'] = substr($row['deskripsi'], 0, 130) . "...";
                        } ?>
            <div class="card">
              <div class="image">
                <img src="../user_area/user_uploadpic/<?= $row['foto_karya']?>" alt="" />
              </div>
              <div class="desc">
                <div class="content">
                  <h3><?= $row['nama_karya'] ?></h3>
                  <p><?= $row['deskripsi']?> </p>
                </div>
                <div class="more-card">
                  <h6 class="status"><?= $row['harga'] ?></h6>
                  <button onclick="window.location='detail-pameranPage.php?id=<?= $row['id_karya'] ?>'">selengkapnya</button>
                </div>
              </div>
            </div>
          <?php $i++ ?>
          <?php endforeach; ?>
          </div>
        </div>
      </div>

      <footer>
        <div class="wrapper-footer">
          <a href="tentangPage.php">Tentang Kami</a>
          <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
        </div>
      </footer>
    </div>

    <!-- script -->
    <script>
      let slideIndex = 0;
      showSlides();

      function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
          slideIndex = 1;
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 2 seconds
      }
    </script>
  </body>
</html>
