<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("AdventureRepository.php");

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

    $POST_adventureId = $_POST["AdventureId"];
    $POST_title = $_POST["Title"];
    $POST_start = $_POST["StartDateTime"];
    $POST_end = $_POST["EndDateTime"];
    $POST_description = $_POST["Description"];

    $repository = new AdventureRepository();
    $adventures = $repository->UpdateAdventure($POST_adventureId, $POST_title, $POST_start, $POST_end, $POST_description);

    echo json_encode(array("success" => "true"));
}
catch(Throwable $t)
{
    //echo json_encode(array("success" => "false"));
    echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>