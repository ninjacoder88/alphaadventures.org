<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("../_library/MailManager.php");
    require_once("RsvpRepository.php");

    $sessionManager = new SessionManager();
    $sessionValidation = $sessionManager->ValidateSessionForAPI();
    if($sessionValidation["success"] == "exit")
    {
        echo json_encode($sessionValidation);
        exit();
    }

    if($sessionManager->IsAdmin() === false)
    {
        echo json_encode(array("success" => "false", "message" => "access denied"));
        exit();
    }

    $POST_adventureId = $_POST["adventureId"];
    $POST_message = $_POST["message"];

    $repository = new RsvpRepository();
    $mail = new MailManager();

    $rsvps = $repository->LoadAllForAdventure($POST_adventureId);

    foreach($rsvps as $rsvp)
    {
        $notifySms = $rsvp["NotifyBySMS"];
        $notifyEmail = $rsvp["NotifyByEmail"];
        $phone = $rsvp["PhoneNumber"];
        $email = $rsvp["EmailAddress"];

        if($notifySms=== true || $notifySms === "1")
        {
            if(strlen($phone) === 10)
            {
                //call twilio
            }
        }
        if($notifyEmail === true || $notifyEmail === "1")
        {
            if(strlen($email) > 7) // a@aol.co
            {
                // send email
                $mail->SendAdventureUpdateEmail($POST_message, $email);
            }
        }
    }

    echo json_encode(array("success" => "true", "r" => $rsvps));
}
catch(Throwable $t)
{

}
?>