<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("../_library/MailManager.php");
    require_once("../_library/EncryptionManager.php");
    require_once("UserRepository.php");

    $POST_emailAddress = $_POST["emailAddress"];
    $POST_retrieval = $_POST["retrieval"];

    $sessionManager = new SessionManager();
    $userRepository = new UserRepository();
    $mail = new MailManager();
    $encryption = new EncryptionManager();

    $user = $userRepository->LoadUserByEmailAddress($POST_userKey);

    if($user == null)
    {
        echo json_encode(array("success" => "false", "message" => "invalid email address"));
        exit();
    }

    if($POST_retrieval === "user")
    {
        //send email with username
    }

    if($POST_retrieval === "pass")
    {
        //send email with reset link
        //set user status
        //set user key
    }

    $userId = $user["UserId"];

    $userRepository->UpdateUserStatus($userId, 2);//active
    $userRepository->ClearUserKey($userId);
    $sessionManager->SetMessage("your account has been successfully activated");
    header("location:../../site/index.php");
}
catch(Throwable $t)
{
    $sessionManager = new SessionManager();
    $sessionManager->SetMessage("account activiation failed");
    header("location:../../site/index.php");
}
?>