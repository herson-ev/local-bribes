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
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/index.php"; ?>">Home</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/statistics.php"; ?>">Statistics</a></li>
                <li class="active"><a href="<?php echo $_SERVER['HTTP_HOST'] . "/privacy.php"; ?>">Privacy</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/about.php"; ?>">About</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/contact.php"; ?>">Contact</a></li>
            </ul>
            <h3 class="muted">Local bribes</h3>
        </div>

        <hr>

        <div class="jumbotron" >
            <h2>Privacy</h2>
            <div><p>Explain here the privacy policy you are going to apply in your instance.</p>
                <ul>
                    <li>Server logs?</li>
                    <li>Cookies?</li>
                    <li>Third-parties involved?</li>
                    <li>Changes to the policy itself?</li>
                    <li>...</li>
                </ul>
            </div>
        </div>

        <hr>
        <div class="footer">
            <p>Local bribes is Free Software <a href="http://www.gnu.org/licenses/gpl.html">GPL v3</a>.</p>
        </div>
    </div><!-- /container -->
</body>
</html>



