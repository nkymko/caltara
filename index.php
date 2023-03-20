<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CALTARA</title>
    <link rel="stylesheet" href="style/landingPage.css" />
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
  box-sizing: border-box;
  scroll-behavior: smooth;
  font-family: "Poppins";
}

body {
  background-image: url("img/landing/bg.png");
  height: 100vh;
  overflow-x: hidden;
  background-repeat: no-repeat;
}
/* 
.container {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container img {
  width: 100%;
  height: 100vh;
  position: absolute;
  top: 0;
  object-fit: cover;
} */

.container {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  flex-direction: column;
}

.container img {
  position: absolute;
  /* width: 100%; */
  /* height: 100%; */
  top: 0;
  left: 0;
  object-fit: contain;
}

.content {
  z-index: 1000;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 3rem;
  /* margin-top: 0px; */
  color: white;
}

.watermark {
  text-align: center;
}

.cta {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
}

h3 {
  font-size: 3rem;
  font-weight: 200;
}

p {
  font-size: 1rem;
  font-weight: 200;
}

h1 {
  font-size: 3rem;
  font-weight: 800;
  text-align: center;
  text-shadow: -4px 4px 4px rgba(0, 0, 0, 0.25);
  line-height: 3.875rem;
}

button {
  all: unset;
  padding: 0.75rem 3rem;
  font-size: 1.25rem;
  font-weight: 500;
  background-image: linear-gradient(to bottom right, #f6b529, #ed703b);
  border-radius: 15px 0 15px 0;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  width: fit-content;
}

button:hover {
  cursor: pointer;
  background-image: linear-gradient(to bottom right, #ebac26, #df6836);
}

    </style>
  </head>
  <body>
  <div class="container">
      <img src="img/landing/shadowAwan1.png" class="object" id="shdAwan1" data-value="8" />
      <img src="img/landing/awan1.png" class="object" id="awan1" data-value="-4" />
      <img src="img/landing/shadowAwan2.png" class="object" id="shdAwan2" data-value="8" />
      <img src="img/landing/awan2.png" class="object" id="awan2" data-value="-4" />
      <img src="img/landing/shadowWayang2.png" class="object" id="shdWayang" data-value="8" />
      <img src="img/landing/wayang2.png" class="object" id="wayang" data-value="-1" />
      <div class="content">
        <div class="watermark">
          <h3>Caltara</h3>
          <p>Local Nusantara</p>
        </div>
        <div class="cta">
          <h1>Mulai perjalananmu mengenal<br />Nusantara</h1>
          <button onclick="window.location.href='masukPage.php'">Mulai</button>
        </div>
      </div>
    </div>

    <!-- script -->
    <script>
      document.addEventListener("mousemove", parallax);
      function parallax(e) {
        document.querySelectorAll(".object").forEach(function (move) {
          var moving_value = move.getAttribute("data-value");
          var x = (e.clientX * moving_value) / 250;
          var y = (e.clientY * moving_value) / 250;

          move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
        });
      }
    </script>
  </body>
</html>
