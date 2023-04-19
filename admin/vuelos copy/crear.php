<?php
require "../../includes/app.php";
$consulta = "SELECT * FROM paises";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$idciudad = "";
$ciudad = "";
$pais = "";
$descripcion = "";
//Ejecuta el codigo despues que el usuario envia formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $idciudad = mysqli_real_escape_string($db, $_POST["idciudad"]);
  $ciudad = mysqli_real_escape_string($db, $_POST["ciudad"]);
  $pais = mysqli_real_escape_string($db, $_POST["pais"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);

  if (!$idciudad) {
    $errores[] = "Debes añadir un id";
  }
  if (!$ciudad) {
    $errores[] = "Debes añadir un nombre";
  }
  if (!$pais) {
    $errores[] = "Debes elegir una ciudad";
  }
  if (!$descripcion) {
    $errores[] = "Debes añadir una descripcion";
  }

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {
    //Insertar en la base de datos
    // Almacenar//Insertar
    $query = " INSERT INTO ciudades (ciudad,idciudad,pais,descripcion) VALUES ('$ciudad','$idciudad', '$pais','$descripcion'); ";
    // Almacenar
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/ciudades/ciudades.php?resultado=1');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Actualizar Ciudad</h1>
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
            <label for="idciudad" class="form-label">Id de la Ciudad</label>
            <input type="text" class="form-control" name="idciudad" id="idciudad" placeholder="" value="<?php echo $idciudad; ?>">
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="ciudad" class="form-label">Nombre de la Ciudad</label>
            <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="ciudad" name="ciudad" placeholder="" value="<?php echo $ciudad; ?>">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="pais" class="form-label">Pais</label>
            <select name="pais" id="pais" class="form-control" value="<?php echo $pais; ?>">
              <option value="">SELECCIONE PAIS</option>
              <?php
              while ($paisQ = mysqli_fetch_assoc($resultado)) : ?>
                <option <?php echo $pais === $paisQ["idpais"] ? "selected" : ""; ?> value="<?php echo $paisQ["idpais"] ?>">
                  <?php echo $paisQ["pais"] ?>
                </option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="descripcion" class="form-label">Descripcion de la Ciudad</label>
            <input onkeypress="return soloLetras(event)" id="descripcion" type="text" class="form-control" name="descripcion" placeholder="" value="<?php echo $descripcion; ?>">
          </div>
        </div>
        <div class="contenedor-btn-admin">
          <input type="submit" value="Agregar Ciudad" class="boton boton-verde" />
          <a href="/admin/ciudades/ciudades.php" class="boton boton-verde">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>