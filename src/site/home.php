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
}
else
{
    header("location:index.php");
    exit();
}
?>

<?php function RenderBody() { ?>
    <script type="text/javascript" src="js/app/HomeViewModel.js?v=0.1"></script>
    <div class="jumbotron">
        <h1>Welcome to Alpha Adventures</h1>
    </div><!--/jumbotron-->

    <h4>Upcoming Adventures</h4>

    <div v-if="message !== ''">
        <div class="alert alert-info" role="alert">{{message}}</div>
    </div>

    <adventure v-for="adventure in adventures" v-bind:key="adventure.AdventureId" v-bind:adventure="adventure"></adventure>

<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>