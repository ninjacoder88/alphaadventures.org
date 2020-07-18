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
else
{
    header("location:index.php");
    exit();
}
?>

<?php function RenderBody() { ?>
    <script type="text/javascript" src="js/app/IndexViewModel.js"></script>

    <div class="jumbotron">
        <h1>Welcome to Alpha Adventures</h1>
    </div><!--/jumbotron-->

    <div class="container">
        <h3>Upcoming Adventures</h4>
        
        <ul class="list-group">
            <li class="list-group-item" v-for="adventure in adventures"><strong>{{adventure.Title}}</strong> - {{adventure.StartDateTime}}</li>
        </ul>

        <p>To view more details, view updates, or RSVP, login using the dropdown on the navigation bar</p>
    </div>
    
<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>