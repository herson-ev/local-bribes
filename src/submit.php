<?php
include_once("controllers/submitController.php");
include_once("classes/report.php");
?>

<html>  
    <head>
        <title>Local-bribes generic instance</title>
        <meta name="description" content="This is local-bribes instance!">
        <meta name="author" content="Herson Esquivel Vargas">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <script src="../js/bootstrap.min.js"></script>
        <!-- Custom -->
        <style type="text/css">
            body {
                padding-top: 20px;
                padding-bottom: 40px;
            }

            /* Custom container */
            .container-narrow {
                margin: 0 auto;
                max-width: 700px;
            }
            .container-narrow > hr {
                margin: 30px 0;
            }

            /* Main marketing message and sign up button */
            .jumbotron {
                margin: 60px 0;
                text-align: center;
            }
            .jumbotron h1 {
                font-size: 72px;
                line-height: 1;
            }
            .jumbotron .btn {
                font-size: 21px;
                padding: 14px 24px;
            }

            /* Supporting marketing content */
            .marketing {
                margin: 60px 0;
            }
            .marketing p + h4 {
                margin-top: 28px;
            }
        </style>
    </script>
</head>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li><a href="#">Home</a></li>
                <li><a href="#">Statistics</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
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

