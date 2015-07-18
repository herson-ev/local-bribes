<?php
include_once("src/controllers/statisticsController.php");
$controller = new statisticsController();

//Getting data here to display it later on this page.
$total_reports = $controller->get_total_reports();
$total_cities = $controller->get_total_cities();
$total_institutions = $controller->get_total_institutions();
$total_amount = $controller->get_total_amount();

$total_bribes = $controller->get_total_bribes();
$total_bribes_porcentage = round(($total_bribes / $total_reports), 4) * 100;
$total_not_bribes = $controller->get_total_not_bribes();
$total_not_bribes_porcentage = round(($total_not_bribes / $total_reports), 4) * 100;
$total_honest = $controller->get_total_honest();
$total_honest_porcentage = round(($total_honest / $total_reports), 4) * 100;

$top_bribes_by_institution = $controller->get_top_bribes_by_institution();
$top_not_bribes_by_institution = $controller->get_top_not_bribes_by_institution();
$top_honest_by_institution = $controller->get_top_honest_by_institution();
?>
<!DOCTYPE html>
<html lang="en">  
    <head>
        <title>Local-bribes generic instance</title>
        <meta name="description" content="This is local-bribes instance!">
        <meta name="author" content="Herson Esquivel Vargas">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <script src="js/bootstrap.min.js"></script>
        <!-- Fontawesome -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <!-- D3 -->
        <script src="js/d3.v3.min.js"></script>
        <script src="js/Donut3D.js"></script>
        <script src="js/d3.tip.v0.6.3.js"></script>
        <script lang="javascrip">
        var margin = {top: 40, right: 20, bottom: 30, left: 40},
        width = 600 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;

        var formatPercent = d3.format(".0%");

        var x = d3.scale.ordinal()
        .rangeRoundBands([0, width], .1);

        var y = d3.scale.linear()
        .range([height, 0]);

        var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

        var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .tickFormat(formatPercent);

        var tip = d3.tip()
        .attr('class', 'd3-tip')
        .offset([-10, 0])
        .html(function(d) {
        return "<strong>Percentage:</strong> <span style='color:red'>" + d.frequency + "</span>";
        })
        </script>
        <!-- Custom -->
        <link href="css/style.css" rel="stylesheet" media="screen">
        <link href="css/stats-style.css" rel="stylesheet" media="screen">
        <script lang="javascript">
            function hide_inst_all() {
                document.getElementById("inst_bribes_content").style.visibility = 'hidden';
                document.getElementById("inst_bribes_content").style.height = '0px';
                document.getElementById("inst_bribes_content_li").className = '';
                document.getElementById("inst_not_bribes_content").style.visibility = 'hidden';
                document.getElementById("inst_not_bribes_content").style.height = '0px';
                document.getElementById("inst_not_bribes_content_li").className = '';
                document.getElementById("inst_honest_content").style.visibility = 'hidden';
                document.getElementById("inst_honest_content").style.height = '0px';
                document.getElementById("inst_honest_content_li").className = '';
            }
            function show_inst(divId) {
                hide_inst_all();
                document.getElementById(divId).style.visibility = 'visible';
                document.getElementById(divId).style.height = '';
                document.getElementById(divId+"_li").className='active';
            }
        </script>
    </head>
    <body onload="javascript:show_inst('inst_bribes_content');">
        <div class="container-narrow">
            <div class="masthead">
                <ul class="nav nav-pills pull-right">
                    <li><a href="<?php echo "/index.php"; ?>"><i class="fa fa-home fa-1x"></i>&nbsp;Home</a></li>
                    <li class="active"><a href="<?php echo "/statistics.php"; ?>"><i class="fa fa-bar-chart fa-1x"></i>&nbsp;Statistics</a></li>
                    <li><a href="<?php echo "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacy</a></li>
                    <li><a href="<?php echo "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;About</a></li>
                    <li><a href="<?php echo "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contact</a></li>
                </ul>
                <h3 class="muted">Local bribes</h3>
            </div>

            <hr>

            <div class="jumbotrin" >
                <h2>Statistics</h2>
                <h3>Overview</h3>
                <div>
                    <table class="table table-bordered">
                        <tr>  
                            <th>Reports</th>
                            <th>Cities</th>
                            <th>Institutions</th>
                            <th>US Dollars</th>
                        </tr>
                        <tr>
                            <td><?php echo $total_reports; ?></td>
                            <td><?php echo $total_cities; ?></td>
                            <td><?php echo $total_institutions; ?></td>
                            <td><?php echo $total_amount; ?></td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <tr>  
                            <th class="alert-danger">Bribes paid</th>
                            <th class="alert-success">Bribes not paid</th>
                            <th class="alert-info">Honest officers</th>
                        </tr>
                        <tr>
                            <td><?php echo $total_bribes; ?></td>
                            <td><?php echo $total_not_bribes; ?></td>
                            <td><?php echo $total_honest; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div style="text-align:center" id="pie_basic">
                                <script>
var data = [
    {label: "Bribe", color: "#DC3912", value: "<?php echo $total_bribes_porcentage ?>"}, //Red
    {label: "Not_bribe", color: "#109618", value: "<?php echo $total_not_bribes_porcentage ?>"},//Green
    {label: "Honest", color: "#3366CC", value: "<?php echo $total_honest_porcentage ?>"} //Blue
];

var svg = d3.select("#pie_basic").append("svg").attr("width",300).attr("height",300);

svg.append("g").attr("id","svg_pie");

Donut3D.draw("svg_pie", getData(), 150, 150, 130, 100, 30, 0.4);

function getData(){
        return data.map(function(d){ 
                return {label:d.label, value:d.value, color:d.color};});
}
                                </script>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <h3>Institutions</h3>
                    <div class="row">
                    <div class="span6">
                    <ul class="nav nav-tabs">
                    <li id='inst_bribes_content_li'><a href="javascript:show_inst('inst_bribes_content');">Bribes paid</a></li>
                    <li id='inst_not_bribes_content_li'><a href="javascript:show_inst('inst_not_bribes_content');">Bribes not paid</a></li>
                    <li id='inst_honest_content_li'><a href="javascript:show_inst('inst_honest_content');">Honest officers</a></li>
                    </ul>
                    </div>
                    </div>

                    
                    <div id="inst_bribes_content">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Institution</th>
                                <th>Reports</th>
                            </tr>
                            <?php
                            $counter = 1;
                            foreach($top_bribes_by_institution as $inst) {?>
                                <tr><td><?php echo $counter ;?></td>
                                    <td><?php echo $controller->get_institution_by_id($inst["institution"]); ?></td>
                                    <td><?php echo $inst["times"]; ?></td></tr>
                                <?php
                                $counter++;
                            }?>
                        </table>
                        <div style="text-align:center" id="inst_bribes_graph">
                            <script>
var svg = d3.select("#inst_bribes_graph").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

var inst_bribes_data = [
<?php
$counter = 1;
foreach ($top_bribes_by_institution as $inst) {
    ?>
        {letter:"<?php echo $counter ?>",
            frequency:"<?php echo round($inst["times"] / $total_bribes, 4); ?>"},
    <?php
    $counter++;
}
?>
    ];
x.domain(inst_bribes_data.map(function(d) { return d.letter; }));
y.domain([0, d3.max(inst_bribes_data, function(d) { return d.frequency; })]);

svg.append("g")
  .attr("class", "x axis")
  .attr("transform", "translate(0," + height + ")")
  .call(xAxis);

svg.append("g")
  .attr("class", "y axis")
  .call(yAxis)
.append("text")
  .attr("transform", "rotate(-90)");

svg.selectAll(".bar")
  .data(inst_bribes_data)
.enter().append("rect")
  .attr("class", "bar")
  .attr("x", function(d) { return x(d.letter); })
  .attr("width", x.rangeBand())
  .attr("y", function(d) { return y(d.frequency); })
  .attr("height", function(d) { return height - y(d.frequency); })
  .on('mouseover', tip.show)
  .on('mouseout', tip.hide)
                            </script>
                        </div><!-- ends inst_bribes_graph -->
                    </div><!-- ends inst_bribes_content -->
                    
                    
                    
                    
                    <div id="inst_not_bribes_content">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Institution</th>
                                <th>Reports</th>
                            </tr>
                            <?php
                            $counter = 1;
                            foreach($top_not_bribes_by_institution as $inst) {?>
                                <tr><td><?php echo $counter ;?></td>
                                    <td><?php echo $controller->get_institution_by_id($inst["institution"]); ?></td>
                                    <td><?php echo $inst["times"]; ?></td></tr>
                                <?php
                                $counter++;
                            }?>
                        </table>
                            <div style="text-align:center" id="inst_not_bribes_graph">
                            <script>
var svg = d3.select("#inst_not_bribes_graph").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

var inst_not_bribes_data = [
<?php
$counter = 1;
foreach ($top_not_bribes_by_institution as $inst) {
    ?>
        {letter:"<?php echo $counter ?>",
            frequency:"<?php echo round($inst["times"] / $total_not_bribes, 4); ?>"},
    <?php
    $counter++;
}
?>
    ];
x.domain(inst_not_bribes_data.map(function(d) { return d.letter; }));
y.domain([0, d3.max(inst_not_bribes_data, function(d) { return d.frequency; })]);

svg.append("g")
  .attr("class", "x axis")
  .attr("transform", "translate(0," + height + ")")
  .call(xAxis);

svg.append("g")
  .attr("class", "y axis")
  .call(yAxis)
.append("text")
  .attr("transform", "rotate(-90)");

svg.selectAll(".bar")
  .data(inst_not_bribes_data)
.enter().append("rect")
  .attr("class", "bar")
  .attr("x", function(d) { return x(d.letter); })
  .attr("width", x.rangeBand())
  .attr("y", function(d) { return y(d.frequency); })
  .attr("height", function(d) { return height - y(d.frequency); })
  .on('mouseover', tip.show)
  .on('mouseout', tip.hide)
                            </script>
                        </div><!-- ends inst_bribes_graph -->                        
                    </div><!-- ends div inst_not_bribes_content -->
                    
                    
                    
                    <div id="inst_honest_content">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Institution</th>
                                <th>Reports</th>
                            </tr>
                            <?php
                            $counter = 1;
                            foreach($top_honest_by_institution as $inst) {?>
                                <tr><td><?php echo $counter ;?></td>
                                    <td><?php echo $controller->get_institution_by_id($inst["institution"]); ?></td>
                                    <td><?php echo $inst["times"]; ?></td></tr>
                                <?php
                                $counter++;
                            }?>
                        </table>
                        <div style="text-align:center" id="inst_honest_graph">
                            <script>
var svg = d3.select("#inst_honest_graph").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

var inst_honest_data = [
<?php
$counter = 1;
foreach ($top_honest_by_institution as $inst) {
    ?>
        {letter:"<?php echo $counter ?>",
            frequency:"<?php echo round($inst["times"] / $total_honest, 4); ?>"},
    <?php
    $counter++;
}
?>
    ];
x.domain(inst_honest_data.map(function(d) { return d.letter; }));
y.domain([0, d3.max(inst_honest_data, function(d) { return d.frequency; })]);

svg.append("g")
  .attr("class", "x axis")
  .attr("transform", "translate(0," + height + ")")
  .call(xAxis);

svg.append("g")
  .attr("class", "y axis")
  .call(yAxis)
.append("text")
  .attr("transform", "rotate(-90)");

svg.selectAll(".bar")
  .data(inst_honest_data)
.enter().append("rect")
  .attr("class", "bar")
  .attr("x", function(d) { return x(d.letter); })
  .attr("width", x.rangeBand())
  .attr("y", function(d) { return y(d.frequency); })
  .attr("height", function(d) { return height - y(d.frequency); })
  .on('mouseover', tip.show)
  .on('mouseout', tip.hide)
                            </script>
                        </div><!-- ends inst_bribes_graph -->         
                    </div> <!-- ends div inst_honest_content -->
                  
                </div><!-- ends div overview -->
            </div>

            <hr>
            <div class="footer">
                <p>Local bribes is Free Software <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a>.</p>
            </div>
        </div><!-- /container -->
    </body>
</html>



