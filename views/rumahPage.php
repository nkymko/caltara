<?php

  include '../models/rumahadat.php';
  session_start();

  if (isset($data)) {
    $rumahAdat = $data;
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
    <title>Rumah Adat</title>
    <link rel="stylesheet" href="../style/rumahAdat.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
          <h1>Ragam Adat</h1>
          <p>Rumah yang dibangun dengan cara yang sama dari generasi kegenerasi dan tanpa<br />atau dikit sekali mengalami perubahan.</p>
        </div>
        <div class="menu-ragamAdat" id="ragamAdat">
          <a href="rumahPage.php" class="rumah">Rumah adat</a>
          <a href="pakaianPage.php" class="pakaian">Pakaian adat</a>
          <a href="upacaraPage.php" class="upacara">Upacara adat</a>
        </div>
      </div>

      <div class="section-content">
        <div class="wrapper-content">
          <h2>Cari sesuatu di <span class="highlight">Rumah Adat</span></h2>
          <div class="container-search">
          <form action="" method="post" class="search-bar">
              <input type="text" name="keyword" placeholder="search..." />
              <button type="search" name="search"><i class="fa fa-search"></i></button>
          </div>
        </div>

        <!-- title -->
        <div class="wrapper-title">
          <?php if (!isset($_POST["search"])) { ?>
          <h3>Berbagai macam Rumah Adat</h3>
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
          <?php foreach ($rumahAdat as $row) : ?>
          <a href="detail-rumahPage.php?id=<?= $row["id"]; ?>">
            <div class="card">
              <div class="image">
                <img src="../rumahAdat_img/<?= $row["foto"] ?>" alt="" />
              </div>
              <div class="desc">
                <h3><?= $row["nama_rumah"] ?></h3>
                <p><?= $row["preview"] ?></p>
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
