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
        echo json_encode(array("success" => "false", "message" => "invalid username or password"));
        exit();
    }

    $userStatusId = $user["UserStatusId"];
    $salt = $user["Salt"];
    $databasePassword = $user["Password"];
    $userId = $user["UserId"];
    $username = $user["Username"];
    $isAdmin = $user["IsAdmin"];

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
        echo json_encode(array("success" => "false", "message" => "invalid username or password"));
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
    if($isAdmin === "1" || $isAdmin === 1)
    {
        $sessionManager->SetAdmin();
    }
    echo json_encode(array("success" => "true", "isAdmin" => $user["IsAdmin"]));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>