<?php
include_once("controllers/indexController.php");
$controller = new indexController();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Local-bribes generic instance</title>
        <meta name="description" content="This is local-bribes instance!">
        <meta name="author" content="Herson Esquivel Vargas">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <script src="../js/bootstrap.min.js"></script>
        <!-- Custom -->
        <link href="../css/style.css" rel="stylesheet" media="screen">

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
                    <li class="active"><a href="<?php echo $_SERVER['HTTP_HOST'] . "/index.php"; ?>">Home</a></li>
                    <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/statistics.php"; ?>">Statistics</a></li>
                    <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/privacy.php"; ?>">Privacy</a></li>
                    <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/about.php"; ?>">About</a></li>
                    <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/contact.php"; ?>">Contact</a></li>
                </ul>
                <h3 class="muted">Local bribes</h3>
            </div>

            <hr>

            <div class="jumbotron" style="border: dashed">
                <h1>Report!</h1>
                <form id="report_form" action="submit.php" method="post" />
                
                <h3>Location</h3>        
                <input type="text" id="txtLocation" name="txtLocation" 
                       class="span4" list="locationsList" autocomplete="on"
                       form="report_form"
                       title="Start typing in the name of your city and then choose it from the dropdown." />
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
                                
                <h3>Institution</h3>
                <input type="text" id="txtInstitution" name="txtInstitution"
                       class="span4" list="institutionsList" autocomplete="on"
                       form="report_form"
                       title="Start typing in the name of the organization and then choose it from the dropdown."/>
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
                
                <h3>What happened?</h3>
                <a class="btn btn-large btn-danger" onclick="paid();">I paid a bribe</a>
                <a class="btn btn-large btn-success" onclick="not_paid();">I did not pay a bribe</a>
                <a class="btn btn-large btn-primary" onclick="honest();">I met an honest officer</a>
                <input type="hidden" form="report_form" name="eventCode" id="eventField">

                <div id="details" style="visibility: hidden; height: 0px">
                    <h3>Details</h3>
                    Improve your report adding more details.<br/>
                    <textarea cols=110 rows=6 class="span5" form="report_form"
                              placeholder="Add here a description..."
                              name="details"></textarea>
                </div>
                <div id="amount" style="visibility: hidden; height: 0px">
                    <label for="amount">Amount paid: </label>
                    <div class="input-prepend">
                        <span class="add-on">USD $</span>
                        <input id="prependedInput" name="amount"
                               type="number" min="0" autocomplete="off"
                               form="report_form" class="span2">
                    </div>
                </div>

                <div id="send_div" style="visibility: hidden; height: 0px">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" 
                                form="report_form" name="formSubmit">
                                Send report!
                        </button>
                        <button type="button" class="btn">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="row-fluid marketing">                
                <h2>Latest reports</h2>
                <?php
                $reports = $controller->get_latest_reports();
                ?>
                <div>
                    <?php
                    foreach($reports as $report) {
                        $inst_id = $report["institution"];
                        ?>
                        <h4 class="<?php 
                            switch($report["event"]){
                                case 1: echo "btn-danger"; break; //Paid
                                case 2: echo "btn-success"; break; //Did not pay
                                case 3: echo "btn-primary"; break; //Honest
                            }?>"
                        >
                        <?php
                        echo $controller->get_institution_by_id($inst_id);
                        ?>
                        </h4>
                    <div>&#x24; <?php echo $report["amount"] ?> &#x1f4c5; <?php echo $report["date"] ?> &#x2316; <?php echo $controller->get_full_location_by_id($report["location"]); ?></div>
                        <?php
                        echo "<p>" . $report["description"] . "</p>\n";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="footer">
                <p>Local bribes is Free Software <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a>.</p>
            </div>
        </div><!-- /container -->
    </body>
</html>