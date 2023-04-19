<?php
require "../../includes/app.php";
estaAutenticado();
//Escribir el query
$query = "SELECT * FROM paquetes";
//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar los resultados
// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  if ($id) {
    // Elimina la hotel
    $query = "DELETE FROM paquetes WHERE idpaquete='${id}';";
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/paquetes/paquetes.php?resultado=3');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>



<body>
  <div class="contenedor centrar">


    <h1 style="font-size: 3rem;">Paquetes</h1>

    <?php if (intval($resultado) === 1) : ?>
      <div class="notificacion">
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              Paquete Creado Correctamente
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
              Paquete Actualizado Correctamente
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
              Paquete Eliminado Correctamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php endif ?>
    <a class="boton boton-verde" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      Menu
    </a>
    <a href="/admin/paquetes/crear.php" class="boton boton-verde">Crear Paquete</a>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    <table class="hoteles">
      <thead>
        <tr>
          <th>ID Paquete</th>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Dias</th>
          <th>Noches</th>
          <th>Ciudad</th>
          <th>Personas</th>
          <th>Precio</th>
          <th>ID Vuelo</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados -->
        <?php while ($paquete = mysqli_fetch_assoc($resultadoConsulta)) : ?>
          <tr>
            <td><?php echo $paquete["idpaquete"] ?></td>
            <td><?php echo $paquete["nombre"] ?></td>
            <td><?php echo $paquete["descripcion"] ?></td>
            <td><?php echo $paquete["cantdias"] ?></td>
            <td><?php echo $paquete["cantnoches"] ?></td>
            <td><?php echo $paquete["ciudad"] ?></td>
            <td><?php echo $paquete["cantpersonas"] ?></td>
            <td><?php echo $paquete["precio"] ?></td>
            <td><?php echo $paquete["idvuelo"] ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- <button type="button" class="btn btn-danger">Left</button> -->
                <form method="POST" class="w-100">
                  <input type="hidden" name="id" value="<?php echo $paquete["idpaquete"]; ?>">
                  <input type="submit" class="btn btn-danger" value="Eliminar">
                </form>
                <a type="button" class="btn btn-warning" href="/admin/paquetes/actualizar.php?id=<?php echo $paquete["idpaquete"]; ?>">Actualizar</a>
                <a type="button" class="btn btn-success" href="/admin/paquetes/ver.php?id=<?php echo $paquete["idpaquete"]; ?>">Ver</a>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
</body>

</html>