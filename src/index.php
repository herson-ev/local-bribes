<?php
include_once("controllers/indexController.php");
$controller = new indexController();
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
                document.getElementById("amount").style.visibility = 'hidden';
            }
            function show_details() {
                document.getElementById("details").style.visibility = 'visible';
                document.getElementById("send_div").style.visibility = 'visible';
            }
            function show_amount() {
                document.getElementById("amount").style.visibility = 'visible';
                document.getElementById("send_div").style.visibility = 'visible';
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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Statistics</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Disclaimer</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <h3 class="muted">Local bribes</h3>
            </div>

            <hr>

            <div class="jumbotron" style="border: dashed">
                <h1>Report!</h1>
                
                <form id="report_form" action="submit.php" method="post" />
                
                <h3>Location</h3>        
                <input type="text" id="txtLocation" name="txtLocation" 
                       class="span4" list="locationsList" autocomplete="off"
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
                       class="span4" list="institutionsList" autocomplete="off"
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

                <div id="details" style="visibility: hidden">
                    <h3>Details</h3>
                    Improve your report adding more details.<br/>
                    <textarea cols=110 rows=6 class="span5" form="report_form"
                              placeholder="Add here a description..."
                              name="details"></textarea>
                </div>
                <div id="amount" style="visibility: hidden">
                    <label for="amount">Amount paid: </label>
                    <div class="input-prepend">
                        <span class="add-on">USD $</span>
                        <input class="span2" id="prependedInput" name="amount"
                               type="text" form="report_form" autocomplete="off">
                    </div>
                </div>

                <div id="send_div" style="visibility: hidden">
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
                <div class="span6">
                    <h4>Subheading</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

                    <h4>Subheading</h4>
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

                    <h4>Subheading</h4>
                    <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                </div>
            </div>
            <hr>
            <div class="footer">
                <p>Local bribes is Free Software <a href="#">GPL v3</a>.</p>
            </div>
        </div><!-- /container -->
    </body>
</html>