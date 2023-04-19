<?php
require "../../includes/app.php";
$consulta = "SELECT * FROM paises";
$paisesorigen = mysqli_query($db, $consulta);
$paisesdestino = mysqli_query($db, $consulta);

$consulta = "SELECT * FROM clasevuelos";
$clases = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$idvuelo = "";
$paisdestino = "";
$paisorigen = "";
$clase = "";
$precioclase = "";
$cantescala = "";
$preciovuelo = "";
$fecha = "";
$totalfinal = "";
//Ejecuta el codigo despues que el usuario envia formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $idvuelo = mysqli_real_escape_string($db, $_POST["idvuelo"]);
  $paisdestino = mysqli_real_escape_string($db, $_POST["paisdestino"]);
  $paisorigen = mysqli_real_escape_string($db, $_POST["paisorigen"]);
  $clase = mysqli_real_escape_string($db, $_POST["clase"]);
  $precioclase = mysqli_real_escape_string($db, $_POST["precioclase"]);
  $cantescala = mysqli_real_escape_string($db, $_POST["cantescala"]);
  $preciovuelo = mysqli_real_escape_string($db, $_POST["preciovuelo"]);
  $fecha = mysqli_real_escape_string($db, $_POST["fecha"]);
  $totalfinal = mysqli_real_escape_string($db, $_POST["totalfinal"]);

  if (!$idvuelo) {
    $errores[] = "Debes añadir un id";
  }
  if (!$paisdestino) {
    $errores[] = "Debes añadir el pais destino";
  }
  if (!$paisorigen) {
    $errores[] = "Debes elegir un pais de origen";
  }
  if (!$clase) {
    $errores[] = "Debes elegir una clase";
  }
  if (!$precioclase) {
    $errores[] = "Debes añadir el precio de la clase";
  }
  if (!$cantescala) {
    $errores[] = "Debes añadir cuantas escalas requiere el vuelo";
  }
  if (!$preciovuelo) {
    $errores[] = "Debes añadir el precio del vuelo";
  }
  if (!$fecha) {
    $errores[] = "Debes añadir la fecha del vuelo";
  }
  if (!$totalfinal) {
    $errores[] = "Falta el precio total";
  }

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {
    //Insertar en la base de datos
    // Almacenar//Insertar
    $query = " INSERT INTO vuelos (idvuelo,paisdestino,paisorigen,clase,precioclase,cantescala,preciovuelo,fecha,totalfinal) VALUES ('$idvuelo','$paisdestino', '$paisorigen','$clase', $precioclase,$cantescala,$preciovuelo,'$fecha',$totalfinal); ";
    // Almacenar
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/vuelos/vuelos.php?resultado=1');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>

  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Agregar Vuelo</h1>
    <div class="notificacion">
      <?php foreach ($errores as $error) : ?>
      <!-- Example Code -->
      <div class="toast align-items-center text-bg-primary border-0 fade show bg-danger" role="alert"
        aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
        <div class="d-flex">
          <div class="toast-body" style="font-size: 1.5rem;">
            <?php echo $error; ?>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    <div class="contenedor-form-admin">
      <form class="form-admin" method="POST">
        <div class="grupo">
          <div class="mb-3">
            <label for="idvuelo" class="form-label">Id del Vuelo</label>
            <input type="text" class="form-control" name="idvuelo" id="idvuelo" placeholder=""
              value="<?php echo $idvuelo; ?>">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="paisorigen" class="form-label">Pais Origen</label>
            <select name="paisorigen" id="paisorigen" class="form-control" value="<?php echo $paisorigen; ?>">
              <option value="">SELECCIONE PAIS</option>
              <?php
              while ($paisQ = mysqli_fetch_assoc($paisesorigen)) : ?>
              <option <?php echo $paisorigen === $paisQ["idpais"] ? "selected" : ""; ?>
                value="<?php echo $paisQ["idpais"] ?>">
                <?php echo $paisQ["pais"] ?>
              </option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="paisdestino" class="form-label">Pais Destino</label>
            <select name="paisdestino" id="paisdestino" class="form-control" value="<?php echo $paisdestino; ?>">
              <option value="">SELECCIONE PAIS</option>
              <?php
              while ($paisQ2 = mysqli_fetch_assoc($paisesdestino)) : ?>
              <option <?php echo $paisdestino === $paisQ2["idpais"] ? "selected" : ""; ?>
                value="<?php echo $paisQ2["idpais"] ?>">
                <?php echo $paisQ2["pais"] ?>
              </option>
              <?php endwhile ?>
            </select>
          </div>
          <!-- <script>
          function eliminarOpcion() {
            var selectOrigen = document.getElementById("paisorigen");
            var selectDestino = document.getElementById("paisdestino");
            var selectedOption = selectOrigen.options[selectOrigen.selectedIndex];

            for (var i = 0; i < selectDestino.options.length; i++) {
              if (selectDestino.options[i].value == selectedOption.value) {
                selectDestino.remove(i);
                break;
              }
            }
          }

          document.getElementById("paisorigen").addEventListener("change", eliminarOpcion);
          </script> -->
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="clase" class="form-label">Clase</label>
            <select name="clase" id="clase" class="form-control" value="<?php echo $clase; ?>">
              <option value="">SELECCIONE CLASE</option>
              <?php
              while ($claseQ = mysqli_fetch_assoc($clases)) : ?>
              <option <?php echo $clase === $claseQ["idclase"] ? "selected" : ""; ?>
                value="<?php echo $claseQ["idclase"] ?>" data-precio="<?php echo $claseQ["precio"] ?>">
                <?php echo $claseQ["clase"] ?></option>
              <?php endwhile ?>
            </select>
          </div>

          <div class="mb-3">
            <div class="mb-3">
              <label for="precioclase" class="form-label">Precio Clase</label>
              <input type="text" class="form-control" name="precioclase" id="precioclase" placeholder=""
                value="<?php echo $precioclase ?>" readonly>
            </div>
            <script>
            document.getElementById('clase').addEventListener('change', function() {
              var selectedOption = this.options[this.selectedIndex];
              var precio = selectedOption.dataset.precio;
              document.getElementById('precioclase').value = precio;
            });
            </script>
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="cantescala" class="form-label">Cantidad de Escalas</label>
            <input onkeypress="return soloNumeros(event)" type="text" class="form-control" name="cantescala"
              id="cantescala" placeholder="" value="<?php echo $cantescala; ?>">
          </div>
          <div class="mb-3">
            <label for="preciovuelo" class="form-label">Precio Vuelo</label>
            <input onkeypress="return soloNumeros(event)" type="text" class="form-control" name="preciovuelo"
              id="preciovuelo" placeholder="" value="<?php echo $preciovuelo; ?>" onchange="calcularTotal()">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" name=" fecha" id="fecha"
              placeholder="" value="<?php echo $fecha; ?>">
          </div>
          <div class="mb-3">
            <label for="totalfinal" class="form-label">Precio Total</label>
            <input onkeypress="return soloNumeros(event)" type="text" class="form-control" name="totalfinal"
              id="totalfinal" placeholder="" value="<?php echo $totalfinal; ?>" readonly>
          </div>
          <script>
          function calcularTotal() {
            var precioClase = parseFloat(document.getElementById('precioclase').value) || 0;
            var precioVuelo = parseFloat(document.getElementById('preciovuelo').value) || 0;
            var total = precioClase + precioVuelo;
            document.getElementById('totalfinal').value = total;
          }
          </script>
        </div>
        <div class="contenedor-btn-admin">
          <input type="submit" value="Agregar Vuelo" class="boton boton-verde" />
          <a href="/admin/vuelos/vuelos.php" class="boton boton-verde">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>