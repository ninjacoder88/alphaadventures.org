<?php
require_once("library/SessionManager.php");

$sessionManager = new SessionManager();
$loggedIn = $sessionManager->IsLoggedIn();
$isAdmin = $sessionManager->IsAdmin();

if($isAdmin === false)
{
    header("location:index.php");
    exit();
}

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
    <script type="text/javascript" src="js/app/ManageViewModel.js"></script>

    <h3>Adventures</h3>
    <div class="row">
        <div class="col-md-4">
            <button type="button" v-on:click="loadAdventures" class="btn btn-primary btn-sm btn-block">Load</button>
            <ul class="list-group">
                <li class="list-group-item" v-for="(adventure, index) in adventures" v-on:click="select(index)">{{adventure.Title}}</li>
            </ul>
        </div>
        <div class="col-md-8">
            <edit-adventure v-bind:adventure="adventure"></edit-adventure>
        </div>
    </div>
    
    <hr/>
<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>