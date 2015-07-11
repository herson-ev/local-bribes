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
                text-align: left;
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
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/index.php";  ?>">Home</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/statistics.php"; ?>">Statistics</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/privacy.php"; ?>">Privacy</a></li>
                <li><a href="<?php echo $_SERVER['HTTP_HOST'] . "/about.php"; ?>">About</a></li>
                <li class="active"><a href="<?php echo $_SERVER['HTTP_HOST'] . "/contact.php"; ?>">Contact</a></li>
            </ul>
            <h3 class="muted">Local bribes</h3>
        </div>

        <hr>

        <div class="jumbotron" >
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



