<?php
try
{
    require_once("../_library/SessionManager.php");
    $sessionManager = new SessionManager();
    $sessionValidation = $sessionManager->ValidateSessionForAPI();
    if($sessionValidation["success"] == "exit")
    {
        echo json_encode($sessionValidation);
        exit();
    }

    $array = array(
        0 => array("AdventureId" => 1, "RsvpId" => 1, "RsvpTypeId" => 1, "Notes" => "", "Attendees" => 2, "Notes" => "Need special food")
    );
    
    echo json_encode(array("success" => "true", "rsvps" => $array));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
}
?>