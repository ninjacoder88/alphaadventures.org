<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("ContactRepository.php");

    $sessionManager = new SessionManager();
    $sessionValidation = $sessionManager->ValidateSessionForAPI();
    if($sessionValidation["success"] == "exit")
    {
        echo json_encode($sessionValidation);
        exit();
    }

    $POST_feedback = $_POST["feedback"];
    $SESSION_userId = $sessionManager->GetWebsiteUserId();

    $repository = new ContactRepository();

    $repository->CreateFeedback($SESSION_userId, $POST_feedback);

    echo json_encode(array("success" => "true"));
}
catch(Throwable $t)
{
    //echo json_encode(array("success" => "false"));
    echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>