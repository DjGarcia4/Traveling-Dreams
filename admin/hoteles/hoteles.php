<?php
require "../../includes/app.php";
estaAutenticado();
//Escribir el query
$query = "SELECT * FROM hoteles";
//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar los resultados
// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST["id"];
  // $id = filter_var($id, FILTER_VALIDATE_INT);
  if ($id) {
    // Elimina la hotel
    $query = "DELETE FROM hoteles WHERE idhotel='${id}';";
    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      header('Location:/admin/hoteles/hoteles.php?resultado=3');
    }
  }
}
include '../../includes/plantillas/header-admin.php';
?>



<body>
  <div class="contenedor centrar">


    <h1 style="font-size: 3rem;">Hoteles</h1>

    <?php if (intval($resultado) === 1) : ?>
      <div class="notificacion">
        <div class="toast align-items-center text-bg-primary border-0 fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="margin: 2rem;">
          <div class="d-flex">
            <div class="toast-body" style="font-size: 1.5rem;">
              Hotel Agregado Correctamente
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
              Hotel Actualizado Correctamente
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
              Hotel Eliminado Correctamente
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
    <?php endif ?>
    <a class="boton boton-verde" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
      Menu
    </a>
    <a href="/admin/hoteles/crear.php" class="boton boton-verde">Agregar Hotel</a>
    <a href="/admin/index.php" class="boton boton-verde">Volver</a>
    <table class="hoteles">
      <thead>
        <tr>
          <th>ID Hotel</th>
          <th>Nombre</th>
          <th>Ciudad</th>
          <th>Habitacion</th>
          <th>Descripcion</th>
          <th>Direccion</th>
          <th>Email</th>
          <th>Telefono</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados -->
        <?php while ($hotel = mysqli_fetch_assoc($resultadoConsulta)) : ?>
          <tr>
            <td><?php echo $hotel["idhotel"] ?></td>
            <td><?php echo $hotel["hotel"] ?></td>
            <td><?php echo $hotel["ciudad"] ?></td>
            <td><?php echo $hotel["idhabitacion"] ?></td>
            <td><?php echo $hotel["descripcion"] ?></td>
            <td><?php echo $hotel["direccion"] ?></td>
            <td><?php echo $hotel["email"] ?></td>
            <td><?php echo $hotel["telefono"] ?></td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <!-- <button type="button" class="btn btn-danger">Left</button> -->
                <form method="POST" class="w-100">
                  <input type="hidden" name="id" value="<?php echo $hotel["idhotel"]; ?>">
                  <input type="submit" class="btn btn-danger" value="Eliminar">
                </form>
                <a type="button" class="btn btn-warning" href="/admin/hoteles/actualizar.php?id=<?php echo $hotel["idhotel"]; ?>">Actualizar</a>
                <a type="button" class="btn btn-success" href="/admin/hoteles/ver.php?id=<?php echo $hotel["idhotel"]; ?>">Ver</a>
              </div>
            </td>
          </tr>
        <?php endwhile ?>
      </tbody>
    </table>
</body>

</html>