<?php
require "../../includes/app.php";
$id = $_GET["id"];
$consulta = "SELECT * FROM paquetes WHERE idpaquete='${id}'";
$resultado = mysqli_query($db, $consulta);
$paquetesb = mysqli_fetch_assoc($resultado);

$consulta = "SELECT * FROM ciudades";
$resultadoC = mysqli_query($db, $consulta);
$consulta = "SELECT * FROM vuelos";
$resultadoV = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$idpaquete = $paquetesb['idpaquete'];
$nombre = $paquetesb['nombre'];
$descripcion = $paquetesb['descripcion'];
$cantdias = $paquetesb['cantdias'];
$cantnoches = $paquetesb['cantnoches'];
$ciudad = $paquetesb['ciudad'];
$idciudad = $paquetesb['idciudad'];
$cantpersonas = $paquetesb['cantpersonas'];
$precio = $paquetesb['precio'];
$idvuelo = $paquetesb['idvuelo'];
//Ejecuta el codigo despues que el usuario envia formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $idpaquete = mysqli_real_escape_string($db, $_POST["idpaquete"]);
  $nombre = mysqli_real_escape_string($db, $_POST["nombre"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
  $cantdias = mysqli_real_escape_string($db, $_POST["cantdias"]);
  $cantnoches = mysqli_real_escape_string($db, $_POST["cantnoches"]);
  $ciudad = mysqli_real_escape_string($db, $_POST["ciudad"]);
  $idciudad = mysqli_real_escape_string($db, $_POST["idciudad"]);
  $cantpersonas = mysqli_real_escape_string($db, $_POST["cantpersonas"]);
  $precio = mysqli_real_escape_string($db, $_POST["precio"]);
  $idvuelo = mysqli_real_escape_string($db, $_POST["idvuelo"]);

  if (!$idpaquete) {
    $errores[] = "Debes añadir un id";
  }
  if (!$nombre) {
    $errores[] = "Debes añadir el nombre del paquete";
  }
  if (!$descripcion) {
    $errores[] = "Debes añadir una descripcion";
  }
  if (!$cantdias) {
    $errores[] = "Debes añadir una cantidad de dias";
  }
  if (!$cantnoches) {
    $errores[] = "Debes añadir una cantidad de noches";
  }
  if (!$ciudad) {
    $errores[] = "Debes elegir una ciudad";
  }
  if (!$idciudad) {
    $errores[] = "Debes añadir un id ciudad";
  }
  if (!$cantpersonas) {
    $errores[] = "Debes añadir una cantidad de personas";
  }
  if (!$precio) {
    $errores[] = "Debes añadir un precio";
  }
  if (!$idvuelo) {
    $errores[] = "Debes elegir un vuelo";
  }

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {
    //Insertar en la base de datos
    // Almacenar//Insertar
    $query = " UPDATE paquetes SET idpaquete = '${idpaquete}', nombre='${nombre}',descripcion='${descripcion}', cantdias=${cantdias} ,cantnoches=${cantnoches}, ciudad='${ciudad}', cantpersonas=${cantpersonas}, precio=${precio}, idvuelo='${idvuelo}' WHERE idpaquete='${id}'";
    // Almacenar
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/paquetes/paquetes.php?resultado=2');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Actualizar Paquete</h1>
    <div class="notificacion">
      <?php foreach ($errores as $error) : ?>
        <!-- Example Code -->
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              <?php echo $error; ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <div class="contenedor-form-admin">
      <form class="form-admin" method="POST">
        <div class="grupo">
          <div class="mb-3">
            <label for="idpaquete" class="form-label">Id del Paquete</label>
            <input type="text" class="form-control" name="idpaquete" id="idpaquete" placeholder="" value="<?php echo $idpaquete; ?>">
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="nombre" class="form-label">Nombre del Paquete</label>
            <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?php echo $nombre; ?>">
          </div>
        </div>
        <div class="mb-3" id="grupo__nombre">
          <label for="descripcion" class="form-label">Descripcion</label>
          <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="" value="<?php echo $descripcion; ?>">
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="cantdias" class="form-label">Cantidad de Dias</label>
            <input onkeypress="return soloNumeros(event)" type="number" class="form-control" name="cantdias" id="cantdias" placeholder="" value="<?php echo $cantdias; ?>">
          </div>
          <div class="mb-3">
            <label for="cantnoches" class="form-label">Cantidad de Noches</label>
            <input onkeypress="return soloNumeros(event)" type="number" class="form-control" name="cantnoches" id="cantnoches" placeholder="" value="<?php echo $cantnoches; ?>">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <select name="ciudad" id="ciudad" class="form-control" value="<?php echo $ciudad; ?>">
              <option value="">SELECCIONE CIUDAD</option>

              <?php while ($ciudadQ = mysqli_fetch_assoc($resultadoC)) : ?>
                <option <?php echo $ciudad === $ciudadQ["idciudad"] ? "selected" : ""; ?> value="<?php echo $ciudadQ["idciudad"] ?>" data-id="<?php echo $ciudadQ["idciudad"] ?>">
                  <?php echo $ciudadQ["ciudad"] ?></option>
              <?php endwhile ?>

            </select>
          </div>
          <div class="mb-3">
            <div class="mb-3">
              <label for="idciudad" class="form-label">Id Ciudad</label>
              <input type="text" class="form-control" name="idciudad" id="idciudad" placeholder="" value="<?php echo $idciudad ?>" readonly>
            </div>
            <script>
              document.getElementById('ciudad').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var id = selectedOption.dataset.id;
                document.getElementById('idciudad').value = id;
              });
            </script>
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="cantpersonas" class="form-label">Cantidad de Personas</label>
            <input onkeypress="return soloNumeros(event)" type="number" class="form-control" name="cantpersonas" id="cantpersonas" placeholder="" value="<?php echo $cantpersonas; ?>">
          </div>
          <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input onkeypress="return soloNumeros(event)" type="text" class="form-control" name="precio" id="precio" placeholder="" value="<?php echo $precio; ?>">
          </div>
        </div>
        <div class="mb-3">
          <label for="idvuelo" class="form-label">Id Vuelo</label>
          <select name="idvuelo" id="idvuelo" class="form-control" value="<?php echo $idvuelo; ?>">
            <option value="">SELECCIONE VUELO</option>

            <?php while ($vueloQ = mysqli_fetch_assoc($resultadoV)) : ?>
              <option <?php echo $idvuelo === $vueloQ["idvuelo"] ? "selected" : ""; ?> value="<?php echo $vueloQ["idvuelo"] ?>">
                <?php echo $vueloQ["idvuelo"] ?></option>
            <?php endwhile ?>

          </select>
        </div>

        <div class="contenedor-btn-admin">
          <input type="submit" value="Actualizar Paquete" class="boton boton-verde" />
          <a href="/admin/paquetes/paquetes.php" class="boton boton-verde">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>