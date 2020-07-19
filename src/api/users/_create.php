<?php
try
{
    require_once("UserRepository.php");    
    require_once("../_library/EncryptionManager.php");
    require_once("../_library/MailManager.php");

    $POST_username = $_POST["username"];
    $POST_emailAddress = $_POST["emailAddress"];
    $POST_phoneNumber = $_POST["phoneNumber"];
    $POST_password = $_POST["password"];

    $repository = new UserRepository();
    $encryption = new EncryptionManager();
    $mail = new MailManager();

    $salt = $encryption->GenerateSalt();
    $saltedPassword = $POST_password . $salt;
    $hashedSaltedPassword = $encryption->HashEncrypt($saltedPassword);

    if($POST_username == "")
    {
        echo json_encode(array("success" => "false", "message" => "username must have a value", "un" => $POST_username));
        exit();
    }

    if($POST_emailAddress == "")
    {
        echo json_encode(array("success" => "false", "message" => "email address must have a value"));
        exit();
    }

    if($POST_password == "")
    {
        echo json_encode(array("success" => "false", "message" => "password must have a value"));
        exit();
    }

    $userByEmail = $repository->LoadUserByEmailAddress($POST_emailAddress);
    if($userByEmail != null)
    {
        echo json_encode(array("success" => "false", "message" => "an account is already associated with the email address"));
        exit();
    }

    $userByUsername = $repository->LoadUserByUsername($POST_username);
    if($userByUsername != null)
    {
        echo json_encode(array("success" => "false", "message" => "username is already taken"));
        exit();
    }

    $userKey = $encryption->GenerateUserKey();

    $userId = $repository->CreateUser($POST_username, $POST_emailAddress, $POST_phoneNumber, $hashedSaltedPassword, $salt, $userKey);
    if($userId == null)
    {
        echo json_encode(array("success" => "false"));
        exit();
    }

    $mail->SendRegistrionEmail($userKey, $POST_emailAddress);
    echo json_encode(array("success" => "true", "message" => $userId));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>