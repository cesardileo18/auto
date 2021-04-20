<?php
include_once "config.php";
include_once "entidades/auto.php";
include_once "entidades/color.php";
include_once "entidades/marca.php";


$auto = new auto();
$aAutos = $auto->cargarGrilla();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <title>Contacto</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logodw.ico">
</head>

<body>
  <header>
    <?php include_once("menu.php"); ?>
  </header>


  <!-- Begin Page Content -->
  <div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Listado de Autos</h1>
    <div class="row">
      <div class="col-12 mb-3">
        <a href="auto-formulario.php" class="btn btn-primary col-mr-2 col-mb-3">Nuevo</a>
      </div>
    </div>
    <table class="table table-hover border">
      <tr>
        <th>Imagen</th>
        <th>Año</th>
        <th>Auto</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
      <?php foreach ($aAutos as $auto) : ?>
        <tr>
          <td class="w-25"><img src="archivos/<?php echo $auto->imagen ?>" class="img-fluid" height="40"></td>
          <td><?php echo date_format(date_create($auto->anio), "d/m/Y"); ?></td>
          <td><?php echo $auto->nombre; ?></td>
          <td>$<?php echo number_format($auto->precio, 2, ",", "."); ?></td>
          <td style="width: 110px">
            <a href="auto-formulario.php?id=<?php echo $auto->idauto; ?>"><i class="fas fa-search"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <?php include_once("footer.php"); ?>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>