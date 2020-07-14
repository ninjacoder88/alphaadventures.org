<?php

try
{
    $POST_username = $_POST["username"];
    $POST_emailAddrees = $_POST["emailAddress"];
    $POST_phoneNumber = $_POST["phoneNumber"];
    $POST_password = $_POST["password"];

    echo json_encode(array("success" => "true"));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
}

?>