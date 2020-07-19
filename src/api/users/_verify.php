<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("UserRepository.php");

    $POST_userKey = $_GET["code"];

    $sessionManager = new SessionManager();
    $userRepository = new UserRepository();

    $user = $userRepository->LoadByUserKey($POST_userKey);

    if($user == null)
    {
        $sessionManager->SetMessage("account activation failed - invalid url");
        header("location:../../site/index.php");
        exit();
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