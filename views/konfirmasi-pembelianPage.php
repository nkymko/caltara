<?php

  include '../models/getdetail.php';
  include '../models/history.php';
  session_start();

  if ( !isset($_SESSION['username'])) {
	  header("Location: ../masukPage.php");
	  exit;
  }

  $id = $_GET['id'];


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
    <title>Konfirmasi Pembelian</title>
    <link rel="stylesheet" href="../style/konfirmasi-pembelianPage.css" />
  </head>
  <body>
    <div class="container">
      <div class="section-content">
        <a href="pembelianPage.php?id=<?= $pameran['id_karya'] ?>">
          <img class="back" src="../img/icon-back.png" alt="" />
        </a>
        <div class="wrapper-content">
          <div class="title">
            <h1>Menunggu Pembayaran</h1>
            <h5 class="deadline">________________________________________________________</h5>
          </div>
          <div class="main">
            <div class="detail-pembayaran">
              <h2>Detail Pembayaran</h2>
              <div class="rincian-detail">
                <div class="judul">
                  <p class="produk">Lukisan "<?= $pameran['nama_karya'] ?>" x1</p>
                  <p class="ongkir">Total Ongkos Kirim (1.5 Kg)</p>
                  <p class="perlindungan">Perlindungan Barang</p>
                </div>

                <div class="nilai">
                  <p class="produk">Rp <?= $harga ?>.000.00</p>
                  <p class="ongkir">Rp 15.000.00</p>
                  <p class="perlindungan">Rp 20.000.00</p>
                </div>
              </div>
              <div class="total">
                <h3>Total Belanja</h3>
                <h4>Rp <?= $total ?>.000.00</h4>
              </div>
            </div>

            <div class="transfer">
              <div class="rekening">
                <h2>Transfer ke nomor rekening:</h2>
                <div class="no-rek">
                  <img src="../img/logo-bca.png" alt="" />
                  <h3>12345-678910111213</h3>
                </div>
                <p>Atas nama: Caltara</p>
              </div>

              <div class="jumlah">
                <h2>Jumlah yang harus dibayar:</h2>
                <div class="total-harga">
                  <h3>Rp <?= $total ?>.000.00</h3>
                </div>
              </div>
            </div>
          </div>

          <form action="<?php echo setHistory($conn) ?>" method="post">
          <div class="button">
            <input type="hidden" name="id_user" value="<?= $profil["id_user"] ?>" >
            <input type="hidden" name="id_karya" value="<?= $pameran["id_karya"] ?>" >
            <input type="hidden" name="nama_karya" value="<?= $pameran["nama_karya"] ?>" >
            <input type="hidden" name="foto_karya" value="<?= $pameran["foto_karya"] ?>" >
            <input type="hidden" name="harga" value="<?= $total ?>" >
            <button type="submit" name="buy" onclick="window.location = 'pameranPage.php'">Selesai</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
