<?php
include_once("src/controllers/submitController.php");
include_once("src/classes/report.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mordidas.cr</title>
        <meta name="description" content="Mordidas.cr es una aplicación de denuncia ciudadana.">
        <meta name="author" content="Herson Esquivel Vargas">
        <meta http-equiv="refresh" content="3; URL=<?php echo "/index.php"; ?>">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <script src="js/bootstrap.min.js"></script>
        <!-- Custom -->
        <link href="css/style.css" rel="stylesheet" media="screen">
        <!-- Fontawesome -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    </head>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li><a href="<?php echo "/index.php"; ?>"><i class="fa fa-home fa-1x"></i>&nbsp;Inicio</a></li>
                <li><a href="<?php echo "/statistics.php"; ?>"><i class="fa fa-bar-chart fa-1x"></i>&nbsp;Estad&iacute;sticas</a></li>
                <li><a href="<?php echo "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacidad</a></li>
                <li><a href="<?php echo "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;Acerca de</a></li>
                <li><a href="<?php echo "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contacto</a></li>
            </ul>
            <h3 class="muted">Mordidas.cr</h3>
        </div>

        <hr>

        <div class="jumbotron" style="border: dashed">            
            <?php
            $txt_location = $_POST['txtLocation'];
            $txt_institution = $_POST['txtInstitution'];
            $event_code = $_POST['eventCode'];
            $details = $_POST['details'];
            $amount = $_POST['amount'];

            $report = new Report($txt_location, $txt_institution, $event_code, $details, $amount);
            $controller = new submitController();
            

            $errors_array = $controller->save_report_object($report);
            if(count($errors_array) > 0) {?>
                <h1>&#9785; Error al enviar el reporte.</h1>
                <?php
                foreach ($errors_array as $error) {
                    echo $error . '<br>';
                }
            } else {?>
                <h1>Gracias.</h1>
                <h3>Su reporte ha sido enviado.</h3>
            <?php
            }
            ?> 
        </div>

        <hr>
        <div class="footer">
            <p>Mordidas.cr es Software Libre <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a> disponible en <a href="https://github.com/herson-ev/local-bribes">GitHub</a>.</p>
        </div>
    </div><!-- /container -->
</body>
</html>

