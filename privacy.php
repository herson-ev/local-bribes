<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mordidas.cr</title>
        <meta name="description" content="Mordidas.cr es una aplicación de denuncia ciudadana.">
        <meta name="author" content="Herson Esquivel Vargas">
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
                <li class="active"><a href="<?php echo "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacidad</a></li>
                <li><a href="<?php echo "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;Acerca de</a></li>
                <li><a href="<?php echo "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contacto</a></li>
            </ul>
            <h3 class="muted">Mordidas.cr</h3>
        </div>

        <hr>

        <div class="jumbotrin" >
            <h2>Privacidad</h2>
            <div>
                <p>
                    Con el fin de evitar represalias contra los denunciantes, Mordidas.cr promueve la denuncia an&oacute;nima responsable.
                    Procuramos garantizar el anonimato de los denunciantes mediante:
                </p>
                <ul>
                    <li>Una conexi&oacute;n segura al sitio (HTTPS).</li>
                    <li>No hacemos uso de <a href="https://es.wikipedia.org/wiki/Cookie_%28inform%C3%A1tica%29"><i>cookies</i></a>.</li>
                    <li>No enlazamos a <i>scripts</i> fuera del dominio mordidas.cr</li>
                    <li>No guardamos bit&aacute;coras (<i>logs</i>) con la <a href="https://es.wikipedia.org/wiki/Direcci%C3%B3n_IP">direcci&oacute;n IP</a> de los usuarios.</li>
                </ul>
            </div>
            <p>
                Considere utilizar <a href="https://www.torproject.org/">Tor</a> como una medida m&aacute;s para garantizar un mayor nivel de anonimato.</p>
            <p>
                Los reportes ingresados al sistema por parte de los usuarios son 100% p&uacute;blicos. &#201;stos incluyen la ubicaci&oacute;n geogr&aacute;fica, instituci&oacute;n, descripci&oacute;n, cantidad de dinero, etc.
                M&aacute;s informaci&oacute;n en el <a href="/about.php">acerca de</a>.
            </p>
        </div>

        <hr>
        <div class="footer">
            <p>Mordidas.cr es Software Libre <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a> disponible en <a href="https://github.com/herson-ev/local-bribes">GitHub</a>.</p>
        </div>
    </div><!-- /container -->
</body>
</html>



