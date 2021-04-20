<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('error_reporting', E_ALL);

include_once "PHPMailer/src/Exception.php";
include_once "PHPMailer/src/PHPMailer.php";
include_once "PHPMailer/src/SMTP.php";

function guardarcontacto($correo)
{
    $archivo = fopen("mail.txt", "a+");
    fwrite($archivo, $correo . ";\n");
    fclose($archivo);
}
if ($_POST) { /* es postback */
    $nombre = $_POST["txtNombre"];
    $correo = $_POST["txtCorreo"];
    $asunto = $_POST["txtAsunto"];
    $mensaje = $_POST["txtMensaje"];

    if ($nombre != "" && $correo != "") {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.dileoweb.com"; // SMTP a utilizar
        $mail->Username = "info@dileoweb.com"; // Correo completo a utilizar
        $mail->Password = "1719Anadi";
        $mail->Port = 25;
        $mail->SMTPAutoTLS = false;
        $mail->From = "info@dileoweb.com"; //Desde la cuenta donde enviamos
        $mail->FromName = "Cesar Acacio Di Leonardo";
        $mail->IsHTML(true);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Destinatarios
        $mail->addAddress($correo);
        $mail->addBCC("cesardileo18@gmail.com"); //Copia oculta
        $mail->Subject = utf8_decode("Contacto página Web");
        $mail->Body = "Recibimos tu consulta, te responderemos a la brevedad.";
        if (!$mail->Send()) {
            $msg = "Error al enviar el correo, intente nuevamente mas tarde.";
        }
        $mail->ClearAllRecipients(); //Borra los destinatarios

        //Envía ahora un correo a nosotros con los datos de la persona
        $mail->addAddress("info@dileoweb.com");
        $mail->Subject = utf8_decode("Recibiste un mensaje desde tu página Web");
        $mail->Body = "Te escribio $nombre cuyo correo es $correo, con el asunto $asunto y el siguiente mensaje:<br><br>$mensaje";

        if ($mail->Send()) { /* Si fue enviado correctamente redirecciona */

            $msg = "Mensaje enviado correctamente";
        } else {
            $msg = "falta completar";
        }
    }
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
	<title>Contacto</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/logodw.ico">
</head>

<body>
    <header>
        <?php include_once("menu.php"); ?>
    </header>
    <section class="contacto" id="contacto">
    <div class="container">
      <h1 class=" text-center">Contacto</h1>
      <form class="formulario" action="" method="POST">
        <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre" required value="<?php echo isset($_POST["txtNombre"]) ? $_POST["txtNombre"] : ""; ?>">
        <input type="email" name="txtCorreo" id="txtCorreo" placeholder="Correo" required value="<?php echo isset($_POST["txtCorreo"]) ? $_POST["txtCorreo"] : ""; ?>">
        <input type="text" id="txtAsunto" name="txtAsunto" placeholder="Asunto" class="asunto" required value="<?php echo isset($_POST["txtAsunto"]) ? $_POST["txtAsunto"] : ""; ?>">
        <textarea name="txtMensaje" id="txtMensaje" placeholder="Mensaje" value="<?php echo isset($_POST["txtMensaje"]) ? $_POST["txtMensaje"] : ""; ?>"></textarea>
        <input type="submit" name="btnEnviar" class="boton" value="Enviar">
      </form>
      <?php if (isset($msg) && $msg != "") : ?>
        <div class="row">
          <div class="col-12 mt-3">
            <div class="alert alert-success" role="alert">
              <?php echo $msg; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
    

    <?php include_once("footer.php"); ?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>