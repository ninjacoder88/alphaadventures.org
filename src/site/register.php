<?php
require_once("library/SessionManager.php");

$sessionManager = new SessionManager();
$loggedIn = $sessionManager->IsLoggedIn();

if($loggedIn)
{
    $isExpired = $sessionManager->IsExpired();
    if($isExpired)
    {
        $sessionManager->ExpireSession();
        $sessionManager->SetMessage("You have been logged out for security purposes");
        header("location:index.php");
        exit();
    }
    $sessionManager->StayAlive();
    header("location:home.php");
}
?>

<!doctype html>
<?php function RenderBody() { ?>
    <script type="text/javascript" src="js/app/RegisterViewModel.js"></script>

    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">{{error}}</div>
        <div class="alert alert-success" role="alert">{{message}}</div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" class="form-control" id="username" placeholder="Shawn Gene Allen" v-model="username"/>
                </div>
                <div class="form-group">
                    <label for="emailAddress">Email</label>
                    <input type="text" class="form-control" id="emailAddress" placeholder="sga@idtdna.com" v-model="emailAddress"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <small>Used for event updates</small></label>
                    <input type="text" class="form-control" id="phone" placeholder="319-555-1234" v-model="phoneNumber"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" v-model="password"/>
                </div>
                <button type="button" class="btn btn-primary" v-on:click="register">Register</button>
            </div>
        </div>
    </div>
<?php } ?>

<?php include("_layout.php"); ?>