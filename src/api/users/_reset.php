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

    $username = $user["Username"];
    $emailAddress = $user["EmailAddress"];

    if($POST_retrieval === "user")
    {
        $mail->SendUsernameEmail($username, $emailAddress);
        echo json_encode(array("success" => "true"));
        exit();
    }

    if($POST_retrieval === "pass")
    {
        //send email with reset link
        //set user status
        //set user keys
        echo json_encode(array("success" => "true"));
        exit();
    }

    echo json_encode(array("success" => "false"));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>