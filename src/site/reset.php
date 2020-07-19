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
    <script type="text/javascript" src="js/app/ResetViewModel.js?v=0.1"></script>

    <div class="container mt-5">
        <div v-if="message !== ''">
            <div class="alert alert-info" role="alert">{{message}}</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Retrieve This</label>
                    <select class="form-control" v-model="retrieval">
                        <option value="">Choose...</option>
                        <option value="user">Username</option>
                        <option value="pass">Password</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="emailAddress">Email</label>
                    <input type="text" class="form-control" id="emailAddress" placeholder="sga@idtdna.com" v-model="emailAddress"/>
                </div>
                <button type="button" class="btn btn-primary" v-on:click="reset">Reset</button>
            </div>
        </div>
    </div>
<?php } ?>

<!doctype html>
<?php include("_layout.php"); ?>