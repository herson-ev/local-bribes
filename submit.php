<?php
include_once("src/controllers/submitController.php");
include_once("src/classes/report.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Local-bribes generic instance</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="This is local-bribes instance!">
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
                <li><a href="<?php echo "/index.php"; ?>"><i class="fa fa-home fa-1x"></i>&nbsp;Home</a></li>
                <li><a href="<?php echo "/statistics.php"; ?>"><i class="fa fa-bar-chart fa-1x"></i>&nbsp;Statistics</a></li>
                <li><a href="<?php echo "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacy</a></li>
                <li><a href="<?php echo "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;About</a></li>
                <li><a href="<?php echo "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contact</a></li>
            </ul>
            <h3 class="muted">Local bribes</h3>
        </div>

        <hr>

        <div class="jumbotron" style="border: dashed">
            <h1>Thank you!</h1>
            <h3>Your report has been submited.</h3>
            <?php
            $txt_location = $_POST['txtLocation'];
            $txt_institution = $_POST['txtInstitution'];
            $event_code = $_POST['eventCode'];
            $details = $_POST['details'];
            $amount = $_POST['amount'];

            $report = new Report($txt_location, $txt_institution, $event_code, $details, $amount);
            $controller = new submitController();
            

            $errors_array = $controller->save_report_object($report);
            if(count($errors_array) > 0) {
                foreach ($errors_array as $error) {
                    echo $error . '\n';
                }
            }
            ?> 
        </div>

        <hr>
        <div class="footer">
            <p>Local bribes is Free Software <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a>.</p>
        </div>
    </div><!-- /container -->
</body>
</html>

