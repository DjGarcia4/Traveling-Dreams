<?php
require "../../includes/app.php";
$id = $_GET["id"];
$consulta = "SELECT * FROM ciudades WHERE idciudad='${id}'";
$resultado = mysqli_query($db, $consulta);
$ciudadb = mysqli_fetch_assoc($resultado);
$consulta = "SELECT * FROM paises";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$idciudad = $ciudadb['idciudad'];
$ciudad = $ciudadb['ciudad'];
$pais = $ciudadb['pais'];
$descripcion = $ciudadb['descripcion'];
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
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Ver Ciudad</h1>
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
            <input type="text" class="form-control" name="idciudad" id="idciudad" placeholder="" value="<?php echo $idciudad; ?>" readonly>
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="ciudad" class="form-label">Nombre de la Ciudad</label>
            <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="ciudad" name="ciudad" placeholder="" value="<?php echo $ciudad; ?>" readonly>
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
            <script>
              // Obtener el elemento select
              const miSelect = document.getElementById("pais");

              // Deshabilitar el elemento select
              miSelect.disabled = true;
            </script>
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="descripcion" class="form-label">Descripcion de la Ciudad</label>
            <input onkeypress="return soloLetras(event)" id="descripcion" type="text" class="form-control" name="descripcion" placeholder="" value="<?php echo $descripcion; ?>" readonly>
          </div>
        </div>
        <div class="contenedor-btn-admin">
          <a href="/admin/ciudades/ciudades.php" class="boton boton-verde">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>