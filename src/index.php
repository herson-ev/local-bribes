<?php
include_once("classes/db.php");
?>

<html>  
    <head>
        <script src="http://4aniversariomovistar.com/jquery/external/jquery/jquery.js"></script>
        <script src="http://4aniversariomovistar.com/jquery/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="http://4aniversariomovistar.com/jquery/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="http://4aniversariomovistar.com/jquery/jquery-ui.structure.min.css">
        <link rel="stylesheet" type="text/css" href="http://4aniversariomovistar.com/jquery/jquery-ui.theme.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">

        <?php
        $db = new Db();
        ?>

        <script type="text/javascript">
            function paid() {
                hide_both();
                show_both();
            }

            function not_paid() {
                hide_both();
                show_details();
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

        <script type="text/javascript">
            $(function () {
                var availableLocations = [
                <?php
                    echo $db->get_concatenated_city_names();
                ?>
                ];
                $("#txtLocation").autocomplete({
                    source: availableLocations
                });
            });
            $(function () {
                var availableInstitutions = [
                <?php
                    echo $db->get_concatenated_institution_names();
                ?>
                ];
                $("#txtInstitution").autocomplete({
                    source: availableInstitutions
                });
            });
        </script>

    </head>
    <body>

        <div><h1>Local bribes</h1></div>
        
        <div id="report">
            <div><h2>Report</h2></div>
            <div id="location">
                <h3>Location</h3>        
                <input type="text" id="txtLocation" name="txtLocation" size="50" title="Start typing in the name of your city and then choose it from the dropdown." />
            </div>
            <div>
                <h3>Institution</h3>
                <input type="text" id="txtInstitution" name="txtInstitution" size="50" title="Start typing in the name of the organization and then choose it from the dropdown."/>
            </div>
            <div>
                <h3>What happened?</h3>
                <table>
                    <tr><td><input type="button" value="I paid a bribe" onclick="paid();"/></td>
                        <td><input type="button" value="I did not pay a bribe" onclick="not_paid();"/></td>
                        <td><input type="button" value="I met an honest officer" onclick="not_paid();"/></td>
                    </tr>
                </table>
            </div>
            <div id="details" style="visibility: hidden">
                <h3>Details</h3>
                Your report can be improved by adding more details.<br/>
                <label for="description">Description: </label>
                <textarea cols="50" rows="6" name="description"></textarea>
            </div>
            <div id="amount" style="visibility: hidden">
                <label for="amount">Amount paid: </label>
                <input type="text" name="amount">
            </div>
            <div id="send_div" style="visibility: hidden">
                <input type="submit" name="btnSendForm" value="Send">
            </div>


            <div id="footer">
                <div id="about">
                    <h3>About this Page</h3>
                    <p>This is a Local-bribes generic instance.</p>
                </div>
                <div id="credits">
                    <h3>Credits</h3>
                    <dl>
                        <dt>Web Fonts: </dt>
                        <dd></dd>
                        <dt>Illustrations: </dt>
                        <dd></dd>
                    </dl>
                </div>
            </div>
        </div>
    </body>
</html>