<?php
require "../../includes/app.php";
$consulta = "SELECT * FROM continentes";
$resultado = mysqli_query($db, $consulta);
//Arreglo con mensajes de errores
$errores = [];
$idpais = "";
$pais = "";
$continente = "";
$descripcion = "";
//Ejecuta el codigo despues que el usuario envia formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $idpais = mysqli_real_escape_string($db, $_POST["idpais"]);
  $pais = mysqli_real_escape_string($db, $_POST["pais"]);
  $continente = mysqli_real_escape_string($db, $_POST["continente"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);

  if (!$idpais) {
    $errores[] = "Debes añadir un id";
  }
  if (!$pais) {
    $errores[] = "Debes añadir un nombre";
  }
  if (!$continente) {
    $errores[] = "Debes elegir un continente";
  }
  if (!$descripcion) {
    $errores[] = "Debes añadir una descripcion";
  }

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {
    //Insertar
    $query = " INSERT INTO paises (pais,idpais,continente,descripcion) VALUES ('$pais','$idpais', '$continente','$descripcion'); ";
    // Almacenar
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/paises/paises.php?resultado=1');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Agregar Pais</h1>
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
      <form class="form-admin" method="POST" action="/admin/paises/crear.php">
        <div class="grupo">
          <div class="mb-3">
            <label for="idpais" class="form-label">Id del Pais</label>
            <input type="text" class="form-control" name="idpais" id="idpais" placeholder=""
              value="<?php echo $idpais; ?>">
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="pais" class="form-label">Nombre del Pais</label>
            <input onkeypress="return soloLetras(event)" type="text" class="form-control" id="pais" name="pais"
              placeholder="" value="<?php echo $pais; ?>">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="continente" class="form-label">Continente</label>
            <select name="continente" id="continente" class="form-control" value="<?php echo $continente; ?>">
              <option value="">SELECCIONE CONTINENTE</option>
              <?php
              while ($continenteQ = mysqli_fetch_assoc($resultado)) : ?>
              <option <?php echo $continente === $continenteQ["idcont"] ? "selected" : ""; ?>
                value="<?php echo $continenteQ["idcont"] ?>">
                <?php echo $continenteQ["continentes"] ?>
              </option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="descripcion" class="form-label">Descripcion del Pais</label>
            <input onkeypress="return soloLetras(event)" id="descripcion" type="text" class="form-control"
              name="descripcion" placeholder="" value="<?php echo $descripcion; ?>">
          </div>
        </div>
        <div class="contenedor-btn-admin">
          <input type="submit" value="Agregar Pais" class="boton boton-verde" />
          <a href="/admin/paises/paises.php" class="boton boton-verde">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>