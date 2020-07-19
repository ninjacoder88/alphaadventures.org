<?php
try
{
    require_once("../_library/MailManager.php");
    $mail = new MailManager();

    $userKey = "ABC123";
    $POST_emailAddress = "thomasharris88@gmail.com";

    //$mail->SendRegistrionEmail($userKey, $POST_emailAddress);
    echo "success";
}
catch(Throwable $t)
{
    echo $t->getMessage();
}
?>