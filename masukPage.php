<?php 

session_start();

require 'include/login.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://unpkg.com/phosphor-icons"></script>
    <link rel="stylesheet" href="style/masukPage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="section-login">
        <div class="wrapper-login">
          <div class="image">
            <img src="img/login-img.png" alt="" />
          </div>
          <form action="" method="post">
          <div class="input">
            <h1>Masuk ke Caltara</h1>
            <div class="username">
              <img src="img/icon-username.png" alt="" />
              <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="password">
              <img src="img/icon-password.png" alt="" />
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="button">
              <button type="submit" name="login">Masuk</button>

              <?php if ( isset($error) ) : ?>
                <p style="color:red;">username atau password salah*</p>
              <?php endif; ?>

            </form>
              <p>Belum punya akun? <a href="daftarPage.php">Daftar</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
