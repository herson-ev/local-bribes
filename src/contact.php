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
        <!-- Fontawesome -->
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
</head>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/index.php";  ?>"><i class="fa fa-home fa-1x"></i>&nbsp;Home</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/statistics.php"; ?>"><i class="fa fa-bar-chart fa-1x"></i>&nbsp;Statistics</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/privacy.php"; ?>"><i class="fa fa-user-secret fa-1x"></i>&nbsp;Privacy</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/about.php"; ?>"><i class="fa fa-info fa-1x"></i>&nbsp;About</a></li>
                <li class="active"><a href="<?php echo $_SERVER['HTTP_HOST'] . "/contact.php"; ?>"><i class="fa fa-pencil fa-1x"></i>&nbsp;Contact</a></li>
            </ul>
            <h3 class="muted">Local bribes</h3>
        </div>

        <hr>

        <div class="jumbotrin" >
            <h2>Contact</h2>
            <div><p>Define some ways to communicate securely with you. As an instance administrator, someone might be interested to reach you.</p>
                <ul>
                    <li>Web form (with HTTPS)</li>
                    <li>Email (provide your <a href="https://emailselfdefense.fsf.org/en/">PGP key</a>)</li>
                    <li>Encrypted chat?</li>
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



