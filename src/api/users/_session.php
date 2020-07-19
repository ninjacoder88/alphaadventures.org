<?php
try
{
    require_once("../_library/SessionManager.php");

    $sessionManager = new SessionManager();
    $message = $sessionManager->GetMessage();

    return json_encode($message);
}
catch(Throwable $t)
{
    echo json_encode("");
}
?>