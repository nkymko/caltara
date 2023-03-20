<?php

  include '../models/getdetail.php';
  include '../models/comment.php';
  include '../models/wishlist.php';
  session_start();

  if ( !isset($_SESSION['username'])) {
	  header("Location: ../masukPage.php");
	  exit;
  }

  $id = $_GET['id'];

  // get pameran data
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $profil= mysqli_fetch_assoc($result);
  $id_us = intval($profil['id_user']);
  $pameran = getdetail("SELECT * FROM pameran WHERE id_karya = $id ")[0];

  // get pameran author's data
  $fk_post = $pameran['id_user'];
  $author = getdetail("SELECT * FROM users WHERE id_user = $fk_post")[0];

  // $id_karya = $pameran['id_karya'];
  // $sql1 = "SELECT * FROM comment WHERE id_karya = $id_karya ";
  // $result1 = mysqli_query($conn, $sql1);
  // $komentar = mysqli_fetch_assoc($result1);

  date_default_timezone_set('Asia/Jakarta');
  $comments = getComments($pameran['id_karya']);
  $wishlist = getWishlist($profil['id_user'], $pameran['id_karya']);

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pameran</title>
    <link rel="stylesheet" href="../style/detail-pameranPage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/phosphor-icons"></script>
  </head>
  <body>
    <div class="container">
      <!-- <div class="section-navbar">
        <nav class="nav-navbar">
          <ul class="nav-branding">
            <li><a href="#">CALTARA</a></li>
          </ul>
          <ul class="nav-menu">
            <li><a href="homePage.html">Beranda</a></li>
            <li>
              <a href="">Kategori</a>
              <ul>
                <li><a href="rumahPage.html">Ragam Adat</a></li>
                <li><a href="tariPage.html">Seni Pertunjukan</a></li>
                <li><a href="kulinerPage.html">Kuliner</a></li>
              </ul>
            </li>
            <li><a href="pameranPage.html">Pameran</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Kontak</a></li>
          </ul>
        </nav>
      </div> -->

      <!-- content -->
      <div class="section-detail">
        <a href="pameranPage.php?">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <div class="wrapper-detail">
          <div class="left">
            <img src="../user_area/user_uploadpic/<?= $pameran['foto_karya']?>" alt="" />
          </div>
          <div class="right">
            <div class="top">
              <div class="title">
                <h1><?= $pameran['nama_karya'] ?></h1>
                <p>oleh: <?= $author['username'] ?> <span style="color:white;">how</span>kontak: 082172999425</p>
              </div>
              <div class="harga">
                <h2><?= $pameran['harga'] ?></h2>
              </div>
            </div>
            <div class="desc">
              <p>
                <?= $pameran['deskripsi'] ?>
              </p>
            </div>
            <div class="respon">
              <div class="rating">
                <p>Beri Rating</p>
                <div class="stars">
                  <input type="radio" id="five" name="rate" value="5" >
                  <label for="five"></label>
                  <input type="radio" id="four" name="rate" value="4" >
                  <label for="four"></label>
                  <input type="radio" id = "three" name="rate" value="3" >
                  <label for="three"></label>
                  <input type="radio" id="two" name="rate" value="2" >
                  <label for="two"></label>
                  <input type="radio" id="one" name="rate" value="1" >
                  <label for="one"></label>
                </div>
              </div>
              <?php if ($pameran['harga'] !== "NOT FOR SALE" && $pameran['id_user'] !== $id_us) { ?>
                <?php if ( isset($wishlist) ) { ?>
                  <form method="post" action="<?php echo delWishlist($conn) ?>" >
                  <div class="wishlist">
                    <input type="hidden" name="id_karya" value="<?= $pameran["id_karya"] ?>" >
                    <button type="submit" name="delWish" id="button-wishlist" onclick="addWishlist()">hapus dari wishlist</button>
                  </div>
                  <!-- <div id="pop-up">
                      <div class="card">
                        <h2>Karya berhasil dihapus dari Wishlist</h2>
                      </div>
                    </div> -->
                </form>
                <?php } else { ?>
                <form method="post" action="<?php echo setWishlist($conn) ?>" >
                  <div class="wishlist">
                    <input type="hidden" name="id_user" value="<?= $profil['id_user'] ?>" >
                    <input type="hidden" name="id_karya" value="<?= $pameran['id_karya'] ?>" >
                    <input type="hidden" name="foto_karya" value="<?= $pameran['foto_karya'] ?>" >
                    <button type="submit" name="addWish" id="button-wishlist" onclick="addWishlist()">tambah ke wishlist</button>
                    <div id="pop-up">
                      <div class="card">
                        <h2>Karya berhasil ditambahkan ke Wishlist</h2>
                      </div>
                    </div>
                  </div>
                </form>
              <?php } ?>
              <div class="beli">
              <button onclick="window.location='pembelianPage.php?id=<?= $pameran['id_karya'] ?>'">Beli</button>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div class="section-comment">
        <div class="wrapper-comment">
          <div class="avg-rating">
            <h3>Rating</h3>
            <h5>4.8/<span class="total-rating">5</span></h5>
          </div>
          <div class="comment">
            <h3>Komentar</h3>
            <form method="POST" action="<?php echo setComments($conn) ?>">
            <div class="comment-user">
              <img src="../user_area/user_profpic/<?= $profil['profpic'] ?>" alt="" />
              <div class="input" id="form">
                <input type="hidden" name="id_user" value="<?= $profil["id_user"] ?>" >
                <input type="hidden" name="id_karya" value="<?= $pameran["id_karya"] ?>" >
                <input type="hidden" name="username" value="<?= $profil["username"] ?>" >
                <input type="hidden" name="profpic" value="<?= $profil["profpic"] ?>" >
                <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s') ?>" >
                <textarea placeholder="beri komentar" name="comment" id="usermsg" required></textarea>
                <button type="submit" name="commentSubmit" onclick="window.location='detail-pameranPage.php?id=<?= $pameran['id_karya'] ?>'">Kirim</button>
              </div>
            </div>
            </form>

            <div class="wrapper-comment-public">
            <?php if ( isset($comments) ) { ?>
            <?php $i = 1; ?>
            <?php foreach ($comments as $row) : ?>
            <div class="comment-public">
              <div class="top">
                <div class="profil">
                  <img src="../user_area/user_profpic/<?= $row['profpic'] ?>" alt="" />
                  <h5 class="username"><?= $row['username'] ?></h5>
                </div>
                <div id="simbol-like" class="like" onclick="like()">
                  <!-- <img class="icons-like" id="icon-like" onclick="changeIcon(event)" src="../img/love-none.png" alt="" /> -->
                </div>
              </div>
              <div class="comment-value">
                <p><?= $row['messege'] ?></p>
              </div>
            </div>
            <?php $i++ ?>
            <?php endforeach; ?>
            <?php } ?>
            </div>
            

            <!-- end -->
        </div>
      </div>
      
    </div>
    <!-- <footer>
      <div class="wrapper-footer">
        <p>Copyright © 2022 Caltara - All Rights Reserved.</p>
      </div>
    </footer> -->

    <!-- script -->
    <script>
      let iconLike = document.getElementsByClassName("icons-like");

      // function changeIcon(e){
      //   if(e.target.src='../img/love-none.png'){
      //     e.target.src='../img/love-fill.png'
      //   }else if(e.target.src='../img/love-fill.png'){
      //     e.target.src = '../img/love-none.png'
      //   }  
      // }

      //like
      function like(){
        const like = document.getElementsByClassName("like");
        
        for (let l of like){
          l.addEventListener('click', (event) => {
            l.classList.toggle("active");
          });
        };
        
      }

      // wishlist
      function addWishlist() {
        const wishlist = document.getElementById("button-wishlist");
        const popUp = document.getElementById("pop-up");
        // wishlist.classList.toggle("active");
        popUp.style.display = "flex";
        setTimeout(none, 2500);
        function none(){
          popUp.style.display = "none";
        }
      }


    </script>
  </body>
</html>
