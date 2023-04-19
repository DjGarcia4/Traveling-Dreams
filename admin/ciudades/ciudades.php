<?php
require "../../includes/app.php";
estaAutenticado();
//Escribir el query
$query = "SELECT * FROM ciudades";
//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar los resultados
// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  if ($id) {
    // Elimina la hotel
    $query = "DELETE FROM ciudades WHERE idciudad='${id}';";
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/ciudades/ciudades.php?resultado=3');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>

<body>
  <div class="contenedor centrar">


    <h1 style="font-size: 3rem;">Ciudades</h1>

    <?php if (intval($resultado) === 1) : ?>
      <div class="notificacion">
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              Ciudad Agregada Correctamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php elseif (intval($resultado) === 2) : ?>
      <div class="notificacion">
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-warning" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              Ciudad Actualizada Correctamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php elseif (intval($resultado) === 3) : ?>
      <div class="notificacion">
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              Ciudad Eliminada Correctamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php endif ?>
    <a class="boton boton-verde" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      Menu
    </a>
    <a href="crear.php" class="boton boton-verde">Agregar Ciudad</a>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    <table class="hoteles">
      <thead>
        <tr>
          <th>ID Ciudad</th>
          <th>Ciudad</th>
          <th>Pais</th>
          <th>Descripcion</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados -->
        <?php while ($ciudad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
          <tr>
            <td><?php echo $ciudad["idciudad"] ?></td>
            <td><?php echo $ciudad["ciudad"] ?></td>
            <td><?php echo $ciudad["pais"] ?></td>
            <td><?php echo $ciudad["descripcion"] ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form method="POST" class="w-100">
                  <input type="hidden" name="id" value="<?php echo $ciudad["idciudad"]; ?>">
                  <input type="submit" class="btn btn-danger" value="Eliminar">
                </form>
                <a type="button" class="btn btn-warning" href="actualizar.php?id=<?php echo $ciudad["idciudad"]; ?>">Actualizar</a>
                <a type="button" class="btn btn-success" href="ver.php?id=<?php echo $ciudad["idciudad"]; ?>">Ver</a>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
</body>

</html>