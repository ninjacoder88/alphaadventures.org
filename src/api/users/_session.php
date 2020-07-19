<?php
try
{
    require_once("../_library/SessionManager.php");

    $sessionManager = new SessionManager();
    $message = $sessionManager->GetMessage();
    $isAdmin = $sessionManager->IsAdmin();

    echo json_encode(array("success" => "true", "session" => array("message" => $message, "isAdmin" => $isAdmin)));
}
catch(Throwable $t)
{
    echo json_encode(array("success"=>"false", "ex" => $t->getMessage()));
}
?>