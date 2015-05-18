<html>  
    <head>
        <script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js"></script>
        <script type="text/javascript" src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            function init() {
                map = new OpenLayers.Map("basicMap");
                var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
                var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
                var position = new OpenLayers.LonLat(-84, 9.9).transform(fromProjection, toProjection);
                var zoom = 7.6;

                var mapnik = new OpenLayers.Layer.OSM();
                map.addLayer(mapnik);

                map.setCenter(position, zoom);
            }
            
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
            // ]]>
        </script>

    </head>
    <body onload="init()">
        <div><h1>Local bribes</h1></div>
        <div><h2>Report</h2></div>
        <div id="location"><h3>Location</h3></div>
        <div id="basicMap" style="width: 50%; height: 50%;"></div>
        <div>
            <h3>Institution</h3>
            <input type="text" name="txtName" />
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
            Description: <textarea cols="50" rows="6"></textarea>
        </div>
        <div id="amount" style="visibility: hidden">
            Amount paid: <input type="text" name="amount">
        </div>
        <div id="send_div" style="visibility: hidden">
            <input type="submit" name="btnSendForm" value="Send">
        </div>
        
        

    </body>
</html>