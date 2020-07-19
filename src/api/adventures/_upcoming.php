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

    $repository = new AdventureRepository();
    $adventures = $repository->LoadUpcomingAdventures();

    echo json_encode(array("success" => "true", "adventures" => $adventures));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>