<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("UserRepository.php");

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

    $repository = new UserRepository();

    $users = $repository->LoadAll();

    echo json_encode(array("success" => "true", "users" => $users));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>