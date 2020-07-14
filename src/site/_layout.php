<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="css/lib/bootstrap-4.5.0.min.css"/>
        <script type="text/javascript" src="js/lib/require-2.3.6.js"></script>
        <script type="text/javascript" src="js/requireConfig.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Alpha Adventures</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="suggest.php">Suggest</a>
                    <a class="nav-item nav-link" href="register.php">Register</a>
                </div>
            </div>
        </nav>

        <div class="container-fluid" id="app">
            <?php RenderBody(); ?>
        </div><!--/container-->
        <!-- <script type="text/javascript" href="js/lib/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" href="js/lib/bootstrap.bundle-4.5.0.min.js"></script> -->
    </body>
</html>