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

    $POST_adventureId = $_POST["adventureId"];
    $POST_rsvpTypeId = $_POST["rsvpTypeId"];
    $POST_attendees = $_POST["attendees"];
    $POST_notes = $_POST["notes"];
    $POST_sms = $_POST["notifySms"];
    $POST_email = $_POST["notifyEmail"];
    $SESSION_userId = $sessionManager->GetWebsiteUserId();

    $smsNotify = false;
    if($POST_sms === "1" || $POST_sms === 1 || $POST_sms === true || $POST_sms === "true")
    {
        $smsNotify = true;
    }

    $emailNotify = false;
    if($POST_email === "1" || $POST_email === 1 || $POST_email === true || $POST_email === "true")
    {
        $emailNotify = true;
    }

    $repository = new RsvpRepository();
    $rsvpId = $repository->CreateRsvp($SESSION_userId, $POST_adventureId, $POST_rsvpTypeId, $smsNotify, $emailNotify, $POST_notes, $POST_attendees);

    echo json_encode(array("success" => "true", "rsvpId"=>$rsvpId));
}
catch(Throwable $t)
{
    //echo json_encode(array("success" => "false"));
    echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>