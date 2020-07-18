<?php
try
{
    require_once("RegisterRepository.php");    
    require_once("EncryptionManager.php");

    $POST_username = $_POST["username"];
    $POST_emailAddress = $_POST["emailAddress"];
    $POST_phoneNumber = $_POST["phoneNumber"];
    $POST_password = $_POST["password"];

    $repository = new RegisterRepository();
    $encryption = new EncryptionManager();

    $salt = $encryption->GenerateSalt();
    $saltedPassword = $POST_password + $salt;
    $hashedSaltedPassword = $encryption->HashEncrypt($saltedPassword);

    $userId = $repository->CreateUser($POST_username, $POST_emailAddress, $POST_phoneNumber, $hashedSaltedPassword, $salt);
    if($userId == null)
    {
        echo json_encode(array("success" => "false"));
    }

    echo json_encode(array("success" => "true", "message" => $userId));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false", "message" => $t));
}
?>