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

    $POST_adventureId = $_POST["adventureId"];
    $POST_rsvpTypeId = $_POST["rsvpTypeId"];
    $POST_attendees = $_POST["attendees"];
    $POST_notes = $_POST["notes"];

    echo json_encode(array("success" => "true"));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
}
?>