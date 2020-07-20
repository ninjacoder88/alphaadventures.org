<?php
try
{
    // require_once("../_library/MailManager.php");
    // $mail = new MailManager();

    // $userKey = "ABC123";
    // $POST_emailAddress = "thomasharris88@gmail.com";

    //$mail->SendRegistrionEmail($userKey, $POST_emailAddress);

    $title = "Event Name";
    $POST_message = "test";

    $messageObj = array("phoneNumber" => "+13198538459", "messageBody" => $title . " " . $POST_message);
    $url = "https://idtsybtwiliobridge.azurewebsites.net/api/TextMessage?code=Svosr99yYa05qnaA6boU0DZgxJXu9s1Z3E54gwIa3wJDBSK3svg00A==";
    $json = json_encode($messageObj);
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}
catch(Throwable $t)
{
    echo $t->getMessage();
}
?>