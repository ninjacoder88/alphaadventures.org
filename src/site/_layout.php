<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="css/lib/bootstrap-4.5.0.min.css"/>
        <script type="text/javascript" src="js/lib/require-2.3.6.js"></script>
        <script type="text/javascript" src="js/requireConfig.js"></script>
        <script type="text/javascript" src="js/app/NavigationViewModel.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav-bar">
            <a class="navbar-brand" href="index.php">Alpha Adventures</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <?php if($loggedIn) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="suggest.php">Suggest</a>
                    </li>
                    <?php } else  { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu" style="width: 250px">
                            <form class="px-4 py-3">
                                <div class="form-group">
                                    <label for="exampleDropdownFormEmail1">Name</label>
                                    <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="exampleDropdownFormPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                                </div>
                                <button type="button" class="btn btn-primary" v-on:click="login">Sign in</button>
                            </form>
                        </div>
                    </li>
                    <?php } ?>
                </div>
            </div>
        </nav>

        <div class="container-fluid" id="app">
            <?php RenderBody(); ?>
        </div><!--/container-->
        <!-- <script type="text/javascript" href="js/lib/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/lib/bootstrap.bundle-4.5.0.min.js"></script>-->
    </body>
</html>