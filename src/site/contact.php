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
    <script type="text/javascript" src="js/app/ContactViewModel.js?v=0.1"></script>

    <div v-if="message !== ''">
        <div class="alert alert-info" role="alert">{{message}}</div>
    </div>
    
    <div class="container mt-5">
        <div class="form-group">
            <textarea rows="10" class="form-control" v-model="feedback" placeholder="Provide any feedback from past adventures or suggest an adventure and provide details for a future adventure"></textarea>
            <button type="button" class="btn btn-primary mt-3" v-on:click="sendFeedback">Submit</button>
        </div>
    </div>

<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>