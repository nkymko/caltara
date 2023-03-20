<?php

  include '../models/upacaraadat.php';
  session_start();

  if (isset($data)) {
    $upacaraAdat = $data;
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
    <title>Upacara Adat</title>
    <!-- <link rel="stylesheet" href="../style/upacaraPage.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
  background-color: #ffffff;
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

.liRumah {
  font-weight: 600;
}

.liKategori {
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

/* hero */
.section-hero {
  max-width: 1440px;
  margin: auto;
  padding-top: 4rem;
  background-color: white;
}

.wrapper-hero {
  background-image: url(../img/upacaraAdat-hero.png);
  height: 296px;
  background-size: cover;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 0 0 20px 20px;
  margin: 0 4rem;
}

.wrapper-hero h1 {
  font-size: 4rem;
  font-weight: 800;
  color: var(--bg-light);
}
.wrapper-hero p {
  font-size: 1.125rem;
  color: var(--bg-light);
  text-align: center;
  /* padding: 0 15rem; */
  width: 70%;
}

.menu-ragamAdat {
  margin: auto;
  margin-bottom: 10px;
  width: fit-content;
  padding: 12px 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 2rem;
  background-color: white;
  border-radius: 0 0 14px 14px;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
}

.menu-ragamAdat a {
  font-size: 1rem;
  text-decoration: none;
  /* font-weight: 500; */
}

.menu-ragamAdat .upacara {
  text-decoration: underline;
}

.menu-ragamAdat a:hover {
  text-decoration: underline;
}

/* content */
.section-content {
  max-width: 1440px;
  margin: auto;
  background-color: white;
}

.wrapper-content {
  padding: 2rem 5rem 1rem 5rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.wrapper-content h2 {
  font-size: 1.5rem;
  font-weight: 600;
}

.wrapper-content .highlight {
  font-weight: 700;
}

/* search */

.search-bar {
  width: 300px;
  background-color: white;
  border: 1px solid var(--bg-primary);
  display: flex;
  align-items: center;
  border-radius: 10px;
}

.search-bar input {
  background: transparent;
  flex: 1;
  border: 0;
  outline: none;
  padding: 0px 27px;
  font-size: 1rem;
  color: var(--bg-primary);
}

::placeholder {
  color: #8f8b8a;
}

.search-bar button {
  all: unset;
}

.search-bar button i {
  font-size: 20px;
  border-radius: 0 10px 10px 0;
  background-color: var(--bg-light);
  color: var(--bg-primary);
  padding: 10px;
  border-left: 1px solid var(--bg-primary);
}

.search-bar button:hover {
  cursor: pointer;
}

/* title */
.wrapper-title {
  padding: 1rem 5rem;
  display: flex;
  justify-content: space-between;
}

.wrapper-title h3 {
  font-size: 1.25rem;
  font-weight: 400;
}

/* filter */
.filter select {
  padding: 0.5rem 1rem;
  border-radius: 10px;
}

.filter select option {
  border-radius: 0px;
}

/* cards */
.section-card {
  max-width: 1440px;
  margin: auto;
  background-color: white;
}

.wrapper-card {
  padding: 0 5rem 5rem 5rem;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  /* row-gap: 2.5rem; */
  gap: 2rem;
}

.wrapper-card a {
  text-decoration: none;
}

.card {
  width: 270px;
  height: 100%;
  background-color: white;
  border-radius: 20px;
  border: 1px solid rgba(0, 0, 0, 0.5);
  transition: ease-in-out.3s;
}

.card:hover {
  transform: scale(105%);
}

.card .image {
  width: 270px;
  height: 159px;
}

.card img {
  border-radius: 20px 20px 0 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card .desc {
  padding: 0.5rem 1.5rem 1rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  font-size: 0.875rem;
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

  .wrapper-hero {
    height: 200px;
    min-width: 300px;
    margin: 0 1rem;
  }

  .wrapper-hero h1 {
    font-size: 2rem;
  }

  .wrapper-hero p {
    font-size: 0.8rem;
    padding: 0.5rem 2rem;
  }

  .menu-ragamAdat {
    width: fit-content;
    gap: 1rem;
    padding: 8px 16px;
  }

  .menu-ragamAdat a {
    font-size: 0.8rem;
    text-align: center;
  }

  /* content */
  .wrapper-content {
    padding: 2rem 2rem 1rem 2rem;
  }

  .wrapper-content h2 {
    font-size: 1.25rem;
  }

  /* search */

  .search-bar {
    width: auto;
  }

  .search-bar input {
    padding: 0 1rem;
    font-size: 0.8rem;
  }

  /* title */
  .wrapper-title {
    padding: 1rem 2rem;
    flex-direction: column;
    gap: 0.5rem;
  }

  .wrapper-title h3 {
    font-size: 1rem;
  }

  .filter select {
    padding: 0.5rem;
  }

  .filter select option {
    border-radius: 0px;
    font-size: 0.8rem;
  }

  /* cards */
  .wrapper-card {
    padding: 0 2rem;
    gap: 1.5rem;
  }

  .card {
    width: auto;
  }

  .card .image {
    width: 100%;
    height: 200px;
  }

  .card .desc {
    font-size: 0.8rem;
  }

  /* footer */
  .wrapper-footer {
    margin-top: 2rem;
  }

  .wrapper-footer a {
    font-size: 1rem;
  }

  .wrapper-footer p {
    font-size: 0.8rem;
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

      <!-- hero -->
      <div class="section-hero">
        <div class="wrapper-hero">
          <h1>Ragam Adat</h1>
          <p>Upacara adat adalah salah satu tradisi masyarakat tradisional yang masih dianggap  <br />memiliki nilai-nilai yang masih cukup relevan bagi kebutuhan masyarakat pendukungnya.</p>
        </div>
        <div class="menu-ragamAdat" id="ragamAdat">
          <a href="rumahPage.php" class="rumah">Rumah adat</a>
          <a href="pakaianPage.php" class="pakaian">Pakaian adat</a>
          <a href="upacaraPage.php" class="upacara">Upacara adat</a>
        </div>
      </div>

      <div class="section-content">
        <div class="wrapper-content">
          <h2>Cari sesuatu di <span class="highlight">Upacara Adat</span></h2>
          <div class="container-search">
            <form action="" method="post" class="search-bar">
              <input type="text" name="keyword" placeholder="search..." name="s" />
              <button type="submit" name="search"><i class="fa fa-search"></i></button>
          </div>
        </div>

        <!-- title -->
        <div class="wrapper-title">
        <?php if (!isset($_POST["search"])) { ?>
          <h3>Berbagai macam Upacara Adat</h3>
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
          <?php foreach ($upacaraAdat as $row) : ?>
          <a href="detail-upacaraPage.php?id=<?= $row['id'] ?>">
            <div class="card">
              <div class="image">
                <img src="../upacara_img/<?= $row['gambar'] ?>" alt="" />
              </div>
              <div class="desc">
                <h3><?= $row['nama_upacara'] ?></h3>
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

        <!-- footer-->
        <footer>
          <div class="wrapper-footer">
            <a href="tentangPage.php">Tentang Kami</a>
            <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
          </div>
        </footer>
      </div>
    </div>

    <!-- script -->
    <script>
      var x, i, j, l, ll, selElmnt, a, b, c;
      /*look for any elements with the class "custom-select":*/
      x = document.getElementsByClassName("custom-select");
      l = x.length;
      for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
          /*for each option in the original select element,
          create a new DIV that will act as an option item:*/
          c = document.createElement("DIV");
          c.innerHTML = selElmnt.options[j].innerHTML;
          c.addEventListener("click", function (e) {
            /*when an item is clicked, update the original select box,
              and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
              if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                yl = y.length;
                for (k = 0; k < yl; k++) {
                  y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                break;
              }
            }
            h.click();
          });
          b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
          /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide");
          this.classList.toggle("select-arrow-active");
        });
      }
      function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x,
          y,
          i,
          xl,
          yl,
          arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
          if (elmnt == y[i]) {
            arrNo.push(i);
          } else {
            y[i].classList.remove("select-arrow-active");
          }
        }
        for (i = 0; i < xl; i++) {
          if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
          }
        }
      }
      /*if the user clicks anywhere outside the select box,
      then close all select boxes:*/
      document.addEventListener("click", closeAllSelect);
    </script>
  </body>
</html>
