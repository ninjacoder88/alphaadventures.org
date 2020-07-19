<?php
try
{
    require_once("../_library/EncryptionManager.php");
    require_once("../_library/SessionManager.php");
    require_once("UserRepository.php");
    
    $POST_username = $_POST["username"];
    $POST_password = $_POST["password"];

    $encryption = new EncryptionManager();
    $userRepository = new UserRepository();

    $user = $userRepository->LoadUserByUsername($POST_username);

    if($user == null)
    {
        echo json_encode(array("success" => "false", "message" => "invalid username or password - 1"));
        exit();
    }

    $userStatusId = $user["UserStatusId"];
    $salt = $user["Salt"];
    $databasePassword = $user["Password"];
    $userId = $user["UserId"];
    $username = $user["Username"];

    if($userStatusId == 1)
    {
        echo json_encode(array("success" => "false", "message" => "account has not been activated"));
        exit();
    }

    if($userStatusId == 3)
    {
        echo json_encode(array("success" => "false", "message" => "account has a pending username or password change"));
        exit();
    }

    $saltedPassword = $POST_password . $salt;
    $hashedSaltedPassword = $encryption->HashEncrypt($saltedPassword);

    if($databasePassword != $hashedSaltedPassword)
    {
        echo json_encode(array("success" => "false", "message" => "invalid username or password - 2", "dbpw" => $databasePassword, "cpw" => $hashedSaltedPassword));
        exit();
    }

    if($userStatusId != 2)
    {
        echo json_encode(array("success" => "false", "message" => "account is in an invalid state"));
        exit();
    }

    $sessionManager = new SessionManager();
    $sessionManager->SetWebsiteUserId($userId);
    $sessionManager->SetUsername($username);
    $sessionManager->StayAlive();
    echo json_encode(array("success" => "true"));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>