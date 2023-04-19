<?php
require "../../includes/app.php";
estaAutenticado();
//Escribir el query
$query = "SELECT * FROM paises";
//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar los resultados
// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  if ($id) {
    // Elimina la hotel
    $query = "DELETE FROM paises WHERE idpais='${id}';";
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/paises/paises.php?resultado=3');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>



<body>
  <div class="contenedor centrar">


    <h1 style="font-size: 3rem;">Paises</h1>

    <?php if (intval($resultado) === 1) : ?>
    <div class="notificacion">
      <div class="toast align-items-center text-bg-primary border-0 fade show bg-success" role="alert"
        aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
        <div class="d-flex">
          <div class="toast-body" style="font-size: 1.5rem;">
            Pais Agregado Correctamente
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    </div>
    <?php elseif (intval($resultado) === 2) : ?>
    <div class="notificacion">
      <div class="toast align-items-center text-bg-primary border-0 fade show bg-warning" role="alert"
        aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
        <div class="d-flex">
          <div class="toast-body" style="font-size: 1.5rem;">
            Pais Actualizazdo Correctamente
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    </div>
    <?php elseif (intval($resultado) === 3) : ?>
    <div class="notificacion">
      <div class="toast align-items-center text-bg-primary border-0 fade show bg-danger" role="alert"
        aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
        <div class="d-flex">
          <div class="toast-body" style="font-size: 1.5rem;">
            Pais Eliminado Correctamente
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    </div>
    <?php endif ?>
    <a class="boton boton-verde" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
      aria-controls="offcanvasExample">
      Menu
    </a>
    <a href="/admin/paises/crear.php" class="boton boton-verde">Agregar Pais</a>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    <table class="hoteles">
      <thead>
        <tr>
          <th>ID Pais</th>
          <th>Pais</th>
          <th>Continente</th>
          <th>Descripcion</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados -->
        <?php while ($pais = mysqli_fetch_assoc($resultadoConsulta)) : ?>
        <tr>
          <td><?php echo $pais["idpais"] ?></td>
          <td><?php echo $pais["pais"] ?></td>
          <td><?php echo $pais["continente"] ?></td>
          <td><?php echo $pais["descripcion"] ?></td>
          <td>
            <!-- <form method="POST" class="w-100">
                <input type="hidden" name="id" value="<?php echo $hotel["id_hotel"]; ?>">
                <input type="submit" class="boton-rojo-block" value="Eliminar">
              </form>
              <a class="boton-amarillo-block" href="/admin/hoteles/actualizar.php?id=<?php echo $hotel["id_hotel"]; ?>">Actualizar</a> -->
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
              <!-- <button type="button" class="btn btn-danger">Left</button> -->
              <form method="POST" class="w-100">
                <input type="hidden" name="id" value="<?php echo $pais["idpais"]; ?>">
                <input type="submit" class="btn btn-danger" value="Eliminar">
              </form>
              <a type="button" class="btn btn-warning"
                href="/admin/paises/actualizar.php?id=<?php echo $pais["idpais"]; ?>">Actualizar</a>
              <a type="button" class="btn btn-success" href="ver.php?id=<?php echo $pais["idpais"]; ?>">Ver</a>
            </div>
          </td>
        </tr>
        <?php endwhile ?>
      </tbody>
    </table>
</body>

</html>