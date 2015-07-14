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
</head>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/index.php";  ?>">Home</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/statistics.php"; ?>">Statistics</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/privacy.php"; ?>">Privacy</a></li>
                <li class="active"><a href="<?php echo $_SERVER['HTTP_HOST'] . "/about.php"; ?>">About</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/contact.php"; ?>">Contact</a></li>
            </ul>
            <h3 class="muted">Local bribes</h3>
        </div>

        <hr>

        <div class="jumbotron" >
            <h2>About</h2>
            <div><p>Local-bribes is a simplistic platform to report bribes by geographical zone (country, state, ...).<br>
                    It is 100% inspired by a project called <a href="http://ipaidabribe.com/">I Paid a Bribe</a>.<br></p>
                <p>The goal of this <a href="https://github.com/herson-ev/local-bribes"><i>free software</i> implementation</a> 
                    is to provide a fast deployment tool to monitor corruption wherever needed.<br></p>
                <p>This application is self-contained. There are no links to external resources by default and we encourage future deployments to keep it like this.
                This is important to guarantee an acceptable level of privacy to the users.</p>
                <p>The software is still in development. If you want to support it, please consider donating (in bitcoins) to 
                    <b>1FmwWP4FeUMTHCvMtmxZCCsA4nfj3kfTmg</b></p>
            </div>
        </div>

        <hr>
        <div class="footer">
            <p>Local bribes is Free Software <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a>.</p>
        </div>
    </div><!-- /container -->
</body>
</html>



