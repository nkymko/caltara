<?php

  include '../models/getdetail.php';
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
  $pameran = getdetail("SELECT * FROM pameran WHERE id_karya = $id ")[0];
  $harga = intval($pameran['harga']);

  $total = $harga + 15 + 20;

  // get pameran author's data
  $fk_post = $pameran['id_user'];
  $author = getdetail("SELECT * FROM users WHERE id_user = $fk_post")[0];
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Pembelian</title>
    <!-- <link rel="stylesheet" href="../style/pembelianPage.css" /> -->

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

/* content */
.section-content {
  max-width: 1440px;
  margin: auto;
}

.section-content .back {
  width: 50px;
  height: 50px;
  position: absolute;
  left: 1.5rem;
  top: 1.5rem;
}

.wrapper-content {
  padding: 5rem 4.25rem;
  display: flex;
  gap: 2rem;
}

.wrapper-content .left {
  display: flex;
  flex-direction: column;
  flex: 2;
}

.left h1 {
  font-size: 2rem;
  font-weight: 600;
}

.left .detail-barang {
  display: flex;
  gap: 1rem;
  padding-top: 1.5rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid var(--bg-primary);
}

.detail-barang img {
  width: 220px;
  border-radius: 10px;
  box-shadow: 0 4px 4px #362a295b;
}

.desc {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.desc h5 {
  font-size: 1.25rem;
  font-weight: normal;
}

.desc h5 span {
  font-size: 1.5rem;
  font-weight: 700;
}

.desc .info {
  display: flex;
  gap: 1.125rem;
}
/* pengiriman dan pembayaran */
.pengiriman-pembayaran {
  display: flex;
  flex-direction: column;
  margin-top: 3rem;
}

.pengiriman-pembayaran h2 {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 2rem;
}

.pengiriman-pembayaran h3 {
  font-size: 1.125rem;
  font-weight: 500;
  margin-bottom: -20px;
}

/* dropdown */
.dropdown {
  min-width: 15rem;
  position: relative;
  margin: 2rem;
}

.dropdown * {
  box-sizing: border-box;
}

.select {
  margin-left: -30px;
  margin-right: -30px;
  background-color: white;
  border: 1px solid var(--bg-primary);
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 0.5rem;
  padding: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.redup {
  font-weight: 300;
}

.select-clicked {
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
}

.caret {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 6px solid var(--bg-primary);
  transition: 0.3s;
}

.caret-rotate {
  transform: rotate(180deg);
}

.menu {
  list-style: none;
  padding: 0.2rem 0.5rem;
  background-color: white;
  border: 1px solid var(--bg-primary);
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
  border-radius: 0.5rem;
  position: absolute;
  top: 3.6rem;
  left: 50%;
  width: 108%;
  transform: translateX(-50%);
  opacity: 0;
  display: none;
  transition: 0.2s;
  z-index: 1;
  margin-bottom: 3rem;
}

.menu .new {
  color: #362a2994;
}

.menu li {
  padding: 0.7rem 0.5rem;
  margin: 0.3rem 0;
  border-radius: 0.5rem;
  cursor: pointer;
}

.menu li:hover {
  background-color: rgb(240, 240, 240);
}

.active {
  background-color: white;
}

.menu-open {
  display: block;
  opacity: 1;
}

/* rincian pembelian */
.wrapper-content .rincian-pembelian {
  flex: 1;
  margin-top: 4.5rem;
  display: flex;
  flex-direction: column;
  padding: 1.25rem;
  border: 1px solid var(--bg-primary);
  border-radius: 20px;
  height: fit-content;
}

.rincian-pembelian h2 {
  font-size: 1.5rem;
  font-weight: 600;
  padding-bottom: 1rem;
  border-bottom: 1px solid var(--bg-primary);
}

.rincian-pembelian .wrapper-rincian {
  display: flex;
  gap: 3rem;
}

.wrapper-rincian .judul {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  padding-top: 1.5rem;
}

.wrapper-rincian .nilai {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  padding-top: 1.5rem;
}

.pesan {
  margin-top: 2.5rem;
  margin-bottom: 1rem;
  display: flex;
  justify-content: center;
}

.pesan button {
  all: unset;
  padding: 0.5rem 3.5rem;
  align-self: flex-end;
  font-size: 1.25rem;
  font-weight: 500;
  background-image: linear-gradient(to bottom right, #ffd700, #f6a156);
  border-radius: 15px 0 15px 0;
}

.pesan button:hover {
  cursor: pointer;
  background-image: linear-gradient(to bottom right, #f5d002, #f09d55);
}

/* responsive */
@media screen and (max-width: 600px) {
  .wrapper-content {
    flex-direction: column;
    padding: 5rem 2rem;
  }

  .wrapper-content .left h1 {
    font-size: 1.5rem;
  }

  .left .detail-barang {
    padding-bottom: 1rem;
  }

  .detail-barang img {
    width: 150px;
    height: 150px;
  }

  .desc {
    gap: 1rem;
  }

  .detail-barang .desc h5 {
    font-size: 0.875rem;
  }

  .detail-barang .desc .info p {
    font-size: 0.8rem;
  }

  .pengiriman-pembayaran {
    margin-top: 2rem;
  }

  .pengiriman-pembayaran h2 {
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
  }

  .pengiriman-pembayaran .pembayaran .menu {
    margin-top: 0.5rem;
  }

  /* rincian pembelian */
  .wrapper-content .rincian-pembelian {
    margin-top: -1.5rem;
  }

  .rincian-pembelian h2 {
    font-size: 1.25rem;
  }

  .rincian-pembelian .wrapper-rincian {
    gap: 1.5rem;
  }

  .wrapper-rincian .judul p {
    font-size: 0.8rem;
  }

  .wrapper-rincian .nilai p {
    font-size: 0.8rem;
  }

  .wrapper-rincian .total {
    font-size: 1rem;
  }

  .pesan button {
    font-size: 1rem;
  }
}

    </style>
  </head>
  <body>
    <div class="container">
      <div class="section-content">
        <a href="detail-pameranPage.php?id=<?= $pameran['id_karya'] ?>">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <div class="wrapper-content">
          <div class="left">
            <h1>Barang yang dibeli</h1>
            <div class="detail-barang">
              <img src="../user_area/user_uploadpic/<?= $pameran['foto_karya']?>" alt="" />
              <div class="desc">
                <h5><span><?= $pameran['nama_karya'] ?></span><br />ciptaan <?= $author['username'] ?></h5>
                <p class="berat">1,5kg</p>
                <div class="info">
                  <?php if (strlen($pameran['deskripsi']) > 70) {
                        $pameran['deskripsi'] = substr($pameran['deskripsi'], 0, 290) . "...";
                        } ?>
                  <p class="berat"><?= $pameran['deskripsi'] ?></p>
                </div>
              </div>
            </div>

            <div class="pengiriman-pembayaran">
              <h2>Pengiriman dan Pembayaran</h2>
              <div class="alamat">
                <h3>Pilih Alamat Pengiriman</h3>
                <div class="dropdown">
                  <div class="select">
                    <span class="selected">Rumah <span class="redup">(utama)</span></span>
                    <div class="caret"></div>
                  </div>
                  <ul class="menu">
                    <li class="active">Rumah <span class="redup">(utama)</span></li>
                    <li>Kantor</li>
                    <li class="new">Tambah baru</li>
                  </ul>
                </div>
              </div>
              <div class="pembayaran">
                <h3>Pilih Opsi Pembayaran</h3>
                <div class="dropdown">
                  <div class="select">
                    <span class="selected"><img src="../img/logo-bca.png" /></span>
                    <div class="caret"></div>
                  </div>
                  <ul class="menu">
                    <li><img src="../img/logo-bri.png" /></li>
                    <li><img src="../img/logo-mandiri.png" /></li>
                    <li class="active"><img src="../img/logo-bca.png" /></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="rincian-pembelian">
            <h2>Rincian Pembelian</h2>
            <!-- <div class="detail harga">
              <p>Harga Barang</p>
              <p>Rp 399.000.00</p>
            </div>
            <div class="detail ongkir">
              <p>Ongkos Kirim</p>
              <p>Rp 15.000.00</p>
            </div>
            <div class="detail perlindungan">
              <p>Perlindungan Barang</p>
              <p>Rp 20.000.00</p>
            </div>
            <div class="detail total">
              <h5>Total Belanja</h5>
              <h5>Rp 434.000.00</h5>
            </div> -->

            <div class="wrapper-rincian">
              <div class="judul">
                <p class="harga">Harga Barang</p>
                <p class="ongkir">Ongkos Kirim</p>
                <p class="perlindungan">Perlindungan Barang</p>
                <h3 class="total">Total Belanja</h3>
              </div>

              <div class="nilai">
                <p class="harga">Rp <?= $harga ?>.000</p>
                <p class="ongkir">Rp 15.000</p>
                <p class="perlindungan">Rp 20.000</p>
                <h3 class="total">Rp <?= $total ?>.000.00</h3>
              </div>
            </div>
            <div class="pesan">
              <button onclick="window.location = 'konfirmasi-pembelianPage.php?id=<?= $pameran['id_karya'] ?>'">Pesan</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- script -->
    <script>
      const dropdowns = document.querySelectorAll(".dropdown");

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
            option.classList.add("actiive");
          });
        });
      });
    </script>
  </body>
</html>
