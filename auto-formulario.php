<?php
include_once("config.php");
include_once("entidades/auto.php");
include_once("entidades/marca.php");
include_once("entidades/color.php");

$auto = new Auto();
$auto->cargarFormulario($_REQUEST);

$marca = new Marca(); 
$array_marcas = $marca->ObtenerTodos();

$color = new Color();
$array_colores = $color->ObtenerTodos();

$aMsg = ["mensaje" => "", "codigo" => ""];

if ($_POST) {

  if (isset($_POST["btnGuardar"])) {
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
      $autoAux = new Auto();
      $autoAux->idauto = $_GET["id"];
      $autoAux->obtenerPorId();
      $imagenAnterior = $autoAux ->imagen;
     //   print_r($_POST);
      //  print_r($_FILES);
      //  exit;
        if ($_FILES["txtImagen"]["error"] === UPLOAD_ERR_OK) {

          if ($_FILES["txtImagen"]["name"] !="") {

            $nombreAleatorio = date("Ymdhmsi");
            $archivo_tmp = $_FILES["txtImagen"]["tmp_name"];
            $nombreArchivo = $_FILES["txtImagen"]["name"];
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $nombreImagen = $nombreAleatorio . $extension;
            move_uploaded_file($archivo_tmp, "archivos/$nombreImagen");
            $auto->imagen = $nombreImagen;
                
            if ($imagenAnterior != ""){
              unlink("archivos/$imagenAnterior");
            } 
          } 
        } else {
          $auto->imagen = $imagenAnterior;
        }

 
      $auto->actualizar();

      $aMsg = ["mensaje" => "Auto modificado con éxito.", "codigo" => "success"];
    } else {
      //Es nuevo

      if ($_FILES["txtImagen"]["error"] === UPLOAD_ERR_OK) {
        $nombreAleatorio = date("Ymdhmsi");
        $archivo_tmp = $_FILES["txtImagen"]["tmp_name"];
        $nombreArchivo = $_FILES["txtImagen"]["name"];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $nombreImagen = $nombreAleatorio . $extension;
        move_uploaded_file($archivo_tmp, "archivos/$nombreImagen");
        $auto->imagen = $nombreImagen;
      }
      
      $auto->insertar();

      $aMsg = ["mensaje" => "Auto cargado con éxito.", "codigo" => "success"];
    }
  } else if (isset($_POST["btnBorrar"])) {
    $auto->eliminar();
    header("location: auto-formulario.php");
    $aMsg = ["mensaje" => "Auto eliminado con éxito.", "codigo" => "danger"];
  
  }
 
}

if (isset($_GET["id"]) && $_GET["id"] > 0) {
  $auto->obtenerPorId();
}


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
  <title>Nuevo Auto</title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logodw.ico">
</head>

<body>
  <header>
    <?php include_once("menu.php"); ?>
  </header>


  <!-- Begin Page Content -->
  <div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nuevo Auto</h1>
      </div>

      <?php if ($aMsg["mensaje"] != "") : ?>

        <div class="row">
          <div class="col-12">
            <div class="alert alert-<?php echo $aMsg["codigo"]; ?>" role="alert">
              <?php echo $aMsg["mensaje"]; ?>
            </div>
          </div>
        </div>

      <?php endif; ?>

      <!-- Content Row -->
      <div class="row">
        <div class="col-12 mb-3">
          <a href="autos.php" class="btn btn-primary mr-2">Listado</a>
          <a href="auto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
          <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
          <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
        </div>

      </div>
      <div class="row">
        <div class="col-6 form-group">
          <label for="txtNombre">Nombre de auto:</label>
          <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $auto->nombre; ?>">
        </div>
        <div class="col-6 form-group">
          <label for="txtFecha">Año:</label>
          <input type="date" required="" class="form-control" name="txtFecha" id="txtFecha" value="<?php echo $auto->anio ?>">
        </div>
        <div class="col-6 form-group">
          <label for="txtMarca">Marcas:</label>
          <select name="txtMarca" id="txtMarca" class="form-control">
            <option disabled selected> Seleccionar </option>
            <?php foreach ($array_marcas as $marca) : ?>
              <?php if ($auto->fk_idmarca == $marca->idmarca) : ?>
                <option selected value="<?php echo $marca->idmarca; ?>"><?php echo $marca->nombre; ?></option>
              <?php else : ?>
                <option value="<?php echo $marca->idmarca; ?>"><?php echo $marca->nombre; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-6 form-group">
          <label for="txtColor">Colores:</label>
          <select name="txtColor" id="txtColor" class="form-control">
            <option disabled selected> Seleccionar </option>
            <?php foreach ($array_colores as $color) : ?>
              <?php if ($auto->fk_idcolor == $color->idcolor) : ?>
                <option selected value="<?php echo $color->idcolor; ?>"><?php echo $color->nombre; ?></option>
              <?php else : ?>
                <option value="<?php echo $color->idcolor; ?>"><?php echo $color->nombre; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-6 form-group">
          <label for="txtCantidad">Cantidad:</label>
          <input type="number" required="" class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo $auto->cantidad ?>">
        </div>
        <div class="col-6 form-group">
          <label for="txtPrecio">Precio:</label>
          <input type="text" class="form-control" name="txtPrecio" id="txtPrecio" value="<?php echo $auto->precio ?>">
        </div>
      </div>
      <div class="col-6 form-group">
        <label for="txtImagen">Imagen del Auto:</label>
        <input type="file" class="form-control" name="txtImagen" id="txtImagen" value="<?php echo $auto->imagen; ?>">
      </div>
      <div class="row">
        <div class="col-12 form-group">
          <label for="txtDescripcion">Descripción:</label>
          <textarea type="text" name="txtDescripcion" id="txtDescripcion"> <?php echo $auto->descripcion; ?> </textarea>
        </div>
      </div>

    </form>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
  <script>
    ClassicEditor
      .create(document.querySelector('#txtDescripcion'))
      .catch(error => {
        console.error(error);
      });
  </script>
  <style>
    .ck.ck-editor {
      height: 600px;
    }
  </style>

  <?php include_once("footer.php"); ?>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>