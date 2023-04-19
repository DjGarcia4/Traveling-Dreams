<?php
require "../includes/app.php";
include '../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Administrador Traveling Dreams</h1>
    <div class="menu-admin">
      <div class="m-admin">

        <a href="hoteles/hoteles.php" class="card2">
          <img src="../img/servicios/recurso.webp" alt="">
          <p>Hoteles</p>
        </a>
      </div>
      <div class="m-admin">

        <a href="paises/paises.php" class="card2">
          <img src="../img/servicios/paises.webp" alt="">
          <p>Paises</p>
        </a>
      </div>
      <div class="m-admin">

        <a href="ciudades/ciudades.php" class="card2">
          <img src="../img/servicios/ciudades.webp" alt="">
          <p>Ciudades</p>
        </a>
      </div>
      <div class="m-admin">

        <a href="vuelos/vuelos.php" class="card2">
          <img src="../img/servicios/billete-de-vuelo.webp" alt="">
          <p>Vuelos</p>
        </a>
      </div>
      <div class="m-admin">

        <a href="paquetes/paquetes.php" class="card2">
          <img src="../img/servicios/paquetes.webp" alt="">
          <p>Paquetes</p>
        </a>
      </div>
      <!-- <div class="m-admin">

        <a href="#" class="card2">
          <img src="../img/servicios/apoyo.webp" alt="">
          <p>Otros...</p>
        </a>
      </div> -->
    </div>
  </div>
</body>

</html>