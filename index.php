<?php
include_once("src/controllers/indexController.php");
$controller = new indexController();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mordidas.cr</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

        <script type="text/javascript">
            function paid() {
                hide_both();
                show_both();
                document.getElementById("eventField").value=1;
            }

            function not_paid() {
                hide_both();
                show_details();
                document.getElementById("eventField").value=2;
            }
            
            function honest() {
                hide_both();
                show_details();
                document.getElementById("eventField").value=3;
            }

            function hide_both() {
                document.getElementById("details").style.visibility = 'hidden';
                document.getElementById("details").style.height = '0px';
                document.getElementById("amount").style.visibility = 'hidden';
                document.getElementById("amount").style.height = '0px';
                document.getElementById("prependedInput").value = '0';
            }
            function show_details() {
                document.getElementById("details").style.visibility = 'visible';
                document.getElementById("details").style.height = '';
                document.getElementById("send_div").style.visibility = 'visible';
                document.getElementById("send_div").style.height = '';
            }
            function show_amount() {
                document.getElementById("amount").style.visibility = 'visible';
                document.getElementById("amount").style.height = '';
                document.getElementById("send_div").style.visibility = 'visible';
                document.getElementById("send_div").style.height = '';
            }
            function show_both() {
                show_details();
                show_amount();
            }
        </script>
    </head>
    <body>
        <div class="container-narrow">
            <div class="masthead">
                <ul class="nav nav-pills pull-right">
                    <li class="active"><a href="<?php echo "/index.php"; ?>"><i class="fa fa-home fa-1x"></i>&nbsp;Inicio</a></li>
                    <li><a href="<?php echo "/statistics.php"; ?>"><i class="fa fa-bar-chart fa-1x"></i>&nbsp;Estad&iacute;sticas</a></li>
                    <li><a href="<?php echo "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacidad</a></li>
                    <li><a href="<?php echo "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;Acerca de</a></li>
                    <li><a href="<?php echo "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contacto</a></li>
                </ul>
                <h3 class="muted">Mordidas.cr</h3>
            </div>

            <hr>

            <div class="jumbotron" style="border: dashed">
                <h1>&#xa1Reporte!</h1>
                <form id="report_form" action="submit.php" method="post" />
                
                <h3>Ubicaci&oacute;n</h3>        
                <input type="text" id="txtLocation" name="txtLocation" 
                       class="span4" list="locationsList" autocomplete="on"
                       form="report_form" required
                       title="Comience a escribir el nombre de la ciudad y luego seleccione una de la lista." />
                <datalist id="locationsList">
                    <?php
                    $locations = $controller->get_locations();
                    foreach ($locations as $location) {
                    ?>
                        <option><?php echo $location ?></option>
                    <?php
                    }
                    ?>
                </datalist>
                                
                <h3>Instituci&oacute;n</h3>
                <input type="text" id="txtInstitution" name="txtInstitution"
                       class="span4" list="institutionsList" autocomplete="on"
                       form="report_form" required
                       title="Comience a escribir el nombre de la instituci&oacute;n y luego seleccione una de la lista."/>
                <datalist id="institutionsList">
                    <?php
                    $institutions = $controller->get_institution_names();
                    foreach ($institutions as $institution) {
                    ?>
                        <option><?php echo $institution ?></option>
                    <?php
                    }
                    ?>
                </datalist>
                
                <h3>&#xbfQu&eacute; ocurri&oacute;?</h3>
                <a class="btn btn-large btn-danger" onclick="paid();" id="btn_bribe">Pagu&eacute; una mordida</a>
                <a class="btn btn-large btn-success" onclick="not_paid();" id="btn_not_bribe">Me negu&eacute; a pagar</a>
                <a class="btn btn-large btn-primary" onclick="honest();" id="btn_honest">Encontr&eacute; un funcionario honesto</a>
                <input type="hidden" form="report_form" name="eventCode" id="eventField">

                <div id="details" style="visibility: hidden; height: 0px">
                    <h3>Detalles</h3>
                    El reporte se puede mejorar describiendo los hechos<br/>
                    <textarea cols=110 rows=6 class="span5" form="report_form"
                              placeholder="Agregue aqu&iacute; una descripci&oacute;n..."
                              name="details"></textarea>
                </div>
                <div id="amount" style="visibility: hidden; height: 0px">
                    <label for="amount">Cantidad pagada: </label>
                    <div class="input-prepend">
                        <span class="add-on">CRC &#8353;</span>
                        <input id="prependedInput" name="amount"
                               type="number" min="0" autocomplete="off"
                               form="report_form" class="span2">
                    </div>
                </div>

                <div id="send_div" style="visibility: hidden; height: 0px">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" 
                                form="report_form" name="formSubmit">
                                ¡Enviar reporte!
                        </button>
                        <button type="reset" class="btn">Cancelar</button>
                    </div>
                </div>
            </div>
            <div class="row-fluid marketing">                
                <h2>&#218;ltimos reportes</h2>
                <?php
                $reports = $controller->get_latest_reports();
                ?>
                <div>
                    <?php
                    foreach($reports as $report) {
                        $paid=False;
                        $inst_id = $report["institution"];
                        ?>
                        <h4 class="<?php 
                            switch($report["event"]){
                                case 1: echo "btn-danger"; $paid=True; 
                                        break; //Paid
                                case 2: echo "btn-success"; break; //Did not pay
                                case 3: echo "btn-primary"; break; //Honest
                            }?>"
                        >
                        <?php
                        echo $controller->get_institution_by_id($inst_id);
                        ?>
                        </h4>
                    <div>
                            <i class="fa fa-calendar fa-1x"></i>
                            <?php echo explode(" ", $report["date"])[0]; ?>

                            <i class="fa fa-map-marker fa-1x" style="padding-left:20px"></i>
                            <?php echo $controller->get_full_location_by_id($report["location"]); ?>

                        <?php if($paid) { ?>
                            <i class="fa" style="padding-left:20px"><b>&#8353;</b></i>
                            <?php echo $report["amount"];
                        } ?>
                    </div>
                        <?php
                        echo "<p>" . $report["description"] . "</p>\n";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="footer">
                <p>Mordidas.cr es Software Libre <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a> disponible en <a href="https://github.com/herson-ev/local-bribes">GitHub</a>.</p>
            </div>
        </div><!-- /container -->
    </body>
</html>