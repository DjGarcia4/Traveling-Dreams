<?php
require "../../includes/app.php";
estaAutenticado();
//Escribir el query
$query = "SELECT * FROM vuelos";
//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar los resultados
// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  if ($id) {
    // Elimina la hotel
    $query = "DELETE FROM vuelos WHERE idvuelo='${id}';";
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/vuelos/vuelos.php?resultado=3');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">


    <h1 style="font-size: 3rem;">Vuelos</h1>

    <?php if (intval($resultado) === 1) : ?>
    <div class="notificacion">
      <div class="toast align-items-center text-bg-primary border-0 fade show bg-success" role="alert"
        aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
        <div class="d-flex">
          <div class="toast-body" style="font-size: 1.5rem;">
            Vuelo Agregado Correctamente
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
            Vuelo Actualizado Correctamente
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
            Vuelo Eliminado Correctamente
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
    <a href="crear.php" class="boton boton-verde">Agregar Vuelo</a>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    <table class="hoteles">
      <thead>
        <tr>
          <th>ID Vuelo</th>
          <th>Pais Origen</th>
          <th>Pais Destino</th>
          <th>Clase</th>
          <th>Precio Clase</th>
          <th>Escalas</th>
          <th>Precio Vuelo</th>
          <th>Fecha</th>
          <th>Precio Final</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados -->
        <?php while ($vuelo = mysqli_fetch_assoc($resultadoConsulta)) : ?>
        <tr>
          <td><?php echo $vuelo["idvuelo"] ?></td>
          <td><?php echo $vuelo["paisorigen"] ?></td>
          <td><?php echo $vuelo["paisdestino"] ?></td>
          <td><?php echo $vuelo["clase"] ?></td>
          <td><?php echo $vuelo["precioclase"] ?></td>
          <td><?php echo $vuelo["cantescala"] ?></td>
          <td><?php echo $vuelo["preciovuelo"] ?></td>
          <td><?php echo $vuelo["fecha"] ?></td>
          <td><?php echo $vuelo["totalfinal"] ?></td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
              <form method="POST" class="w-100">
                <input type="hidden" name="id" value="<?php echo $vuelo["idvuelo"]; ?>">
                <input type="submit" class="btn btn-danger" value="Eliminar">
              </form>
              <a type="button" class="btn btn-warning"
                href="actualizar.php?id=<?php echo $vuelo["idvuelo"]; ?>">Actualizar</a>
              <a type="button" class="btn btn-success" href="ver.php?id=<?php echo $vuelo["idvuelo"]; ?>">Ver</a>
            </div>
          </td>
        </tr>
        <?php endwhile ?>
      </tbody>
    </table>
</body>

</html>