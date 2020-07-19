<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("RsvpRepository.php");

    $sessionManager = new SessionManager();
    $sessionValidation = $sessionManager->ValidateSessionForAPI();
    if($sessionValidation["success"] == "exit")
    {
        echo json_encode($sessionValidation);
        exit();
    }

    $userId = $sessionManager->GetWebsiteUserId();

    $repository = new RsvpRepository();
    $rsvps = $repository->LoadForUserId($userId);

    echo json_encode(array("success" => "true", "rsvps" => $rsvps));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>