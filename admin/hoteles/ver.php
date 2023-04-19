<?php
require "../../includes/app.php";
$id = $_GET["id"];
$consulta = "SELECT * FROM hoteles WHERE idhotel='${id}'";
$resultado = mysqli_query($db, $consulta);
$hotelb = mysqli_fetch_assoc($resultado);

$consulta = "SELECT * FROM ciudades";
$resultadoC = mysqli_query($db, $consulta);
$consulta = "SELECT * FROM habitaciones";
$resultadoH = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
$idhotel = $hotelb['idhotel'];
$hotel = $hotelb['hotel'];
$ciudad = $hotelb['ciudad'];
$habitacion = $hotelb['idhabitacion'];
$precio = $hotelb['precio'];
$descripcion = $hotelb['descripcion'];
$direccion = $hotelb['direccion'];
$email = $hotelb['email'];
$telefono = $hotelb['telefono'];
//Ejecuta el codigo despues que el usuario envia formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $idhotel = mysqli_real_escape_string($db, $_POST["idhotel"]);
  $hotel = mysqli_real_escape_string($db, $_POST["hotel"]);
  $ciudad = mysqli_real_escape_string($db, $_POST["ciudad"]);
  $habitacion = mysqli_real_escape_string($db, $_POST["habitacion"]);
  $precio = mysqli_real_escape_string($db, $_POST["precio"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
  $direccion = mysqli_real_escape_string($db, $_POST["direccion"]);
  $email = $_POST["email"];
  $telefono = mysqli_real_escape_string($db, $_POST["telefono"]);

  if (!$idhotel) {
    $errores[] = "Debes añadir un id";
  }
  if (!$hotel) {
    $errores[] = "Debes añadir el nombre del hotel";
  }
  if (!$ciudad) {
    $errores[] = "Debes elegir una ciudad";
  }
  if (!$habitacion) {
    $errores[] = "Debes elegir una habitacion";
  }
  if (!$precio) {
    $errores[] = "Debes añadir un precio";
  }
  if (!$descripcion) {
    $errores[] = "Debes añadir una descripcion";
  }
  if (!$direccion) {
    $errores[] = "Debes añadir una direccion";
  }
  if (!$email) {
    $errores[] = "Debes añadir un email";
  }
  if (!$telefono) {
    $errores[] = "Debes añadir un telefono";
  }

  //Revisar que el arreglo de errores este vacio
  if (empty($errores)) {
    //Insertar en la base de datos
    // Almacenar//Insertar
    $query = " UPDATE hoteles SET hotel = '${hotel}', idhotel='${idhotel}',ciudad='${ciudad}', idhabitacion='${habitacion}' ,precio=${precio}, descripcion='${descripcion}', direccion='${direccion}', email='${email}', telefono=${telefono} WHERE idhotel='${id}'";
    // Almacenar
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/hoteles/hoteles.php?resultado=2');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">
    <h1 style="font-size: 3rem;">Ver Hotel</h1>
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
            <label for="idhotel" class="form-label">Id del Hotel</label>
            <input readonly type="text" class="form-control" name="idhotel" id="idhotel" placeholder=""
              value="<?php echo $idhotel; ?>">
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="hotel" class="form-label">Nombre del Hotel</label>
            <input readonly onkeypress="return soloLetras(event)" type="text" class="form-control" id="hotel"
              name="hotel" placeholder="" value="<?php echo $hotel; ?>">
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <select name="ciudad" id="ciudad" class="form-control" value="<?php echo $ciudad; ?>">
              <option value="">SELECCIONE CIUDAD</option>
              <?php
              while ($ciudadQ = mysqli_fetch_assoc($resultadoC)) : ?>
              <option <?php echo $ciudad === $ciudadQ["idciudad"] ? "selected" : ""; ?>
                value="<?php echo $ciudadQ["idciudad"] ?>">
                <?php echo $ciudadQ["ciudad"] ?>
              </option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="habitacion" class="form-label">Habitacion</label>
            <select name="habitacion" id="habitacion" class="form-control" value="<?php echo $habitacion; ?>">
              <option value="">SELECCIONE HABITACION</option>
              <?php
              while ($habitacionQ = mysqli_fetch_assoc($resultadoH)) : ?>
              <option <?php echo $habitacion === $habitacionQ["idhabitacion"] ? "selected" : ""; ?>
                value="<?php echo $habitacionQ["idhabitacion"] ?>">
                <?php echo $habitacionQ["Tipohabiatcion"] ?>
              </option>
              <?php endwhile ?>
            </select>
          </div>
        </div>
        <div class="grupo">
          <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input readonly type="text" class="form-control" name="precio" id="precio" placeholder=""
              value="<?php echo $precio; ?>">
          </div>
          <div class="mb-3" id="grupo__nombre">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input readonly onkeypress="return soloLetras(event)" type="text" class="form-control" id="descripcion"
              name="descripcion" placeholder="" value="<?php echo $descripcion; ?>">
          </div>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Direccion</label>
          <input readonly type="text" class="form-control" name="direccion" id="direccion" placeholder=""
            value="<?php echo $direccion; ?>">
        </div>
        <div class="grupo">
          <div class="mb-3" id="grupo__nombre">
            <label for="email" class="form-label">Email</label>
            <input readonly type="email" class="form-control" id="email" name="email" placeholder=""
              value="<?php echo $email; ?>">
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input readonly type="number" class="form-control" name="telefono" id="telefono" placeholder=""
              value="<?php echo $telefono; ?>">
          </div>
        </div>

        <div class="contenedor-btn-admin">
          <a href="/admin/hoteles/hoteles.php" class="boton boton-verde">Volver</a>
        </div>
        <script>
        // Obtener el elemento select
        const ciudad = document.getElementById("ciudad");
        const habitacion = document.getElementById("habitacion");
        const clase = document.getElementById("clase");

        // Deshabilitar el elemento select
        ciudad.disabled = true;
        habitacion.disabled = true;
        </script>
      </form>
    </div>
  </div>
  <script src="/js/app.js"></script>
</body>

</html>