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

<?php function RenderBody() { ?>
    <script type="text/javascript" src="js/app/IndexViewModel.js?v=0.1"></script>

    <!-- <div class="jumbotron">
        <h1>Welcome to Alpha Adventures</h1>
    </div> -->
    <!--/jumbotron-->

    <img src="https://alphaadventures.org/cdn/hike.jpg" width="100%" />

    <br/>
    <br/>

    <div class="container">
        <div v-if="message !== ''">
            <div class="alert alert-info" role="alert">{{message}}</div>
        </div>

        <h3>Upcoming Adventures</h4>
        <br/>
        
        <ul class="list-group">
            <li class="list-group-item" v-for="adventure in adventures"><strong>{{adventure.Title}}</strong> - {{adventure.StartDateTime}}</li>
        </ul>

        <p>To view more details, view updates, or RSVP, login using the dropdown on the navigation bar</p>
    </div>
    
<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>