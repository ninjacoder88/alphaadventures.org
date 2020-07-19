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
    <script type="text/javascript" src="js/app/RegisterViewModel.js?v=0.1"></script>

    <div class="container mt-5">
        <div v-if="error !== ''">
            <div class="alert alert-danger"role="alert">{{error}}</div>
        </div>
        <div v-if="message !== ''">
            <div class="alert alert-success" role="alert">{{message}}</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="username">Username <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="The name others will know you by"></i></label>
                    <input type="text" class="form-control" id="username" placeholder="Shawn Gene Allen" v-model="username"/>
                </div>
                <div class="form-group">
                    <label for="emailAddress">Email</label>
                    <input type="text" class="form-control" id="emailAddress" placeholder="sga@idtdna.com" v-model="emailAddress"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="This will be used to send SMS update for adventures"></i></label>
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