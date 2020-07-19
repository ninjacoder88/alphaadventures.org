<?php
class MailManager
{
    public function SendRegistrionEmail($userKey, $userEmailAddress)
    {
        $message = "<html>";
        $message .= "<head>";
        $message .= "<title>Alpha Adventures Registration</title>";
        $message .= "</head>";
        $message .= "<body>";
        $message .= "<h2>Welcome to Alpha Adventures</h2>";
        $message .= "<p>Please use the link below to activate your account and complete the registration process.</p>";
        $message .= "<p>https://alphaadventures.org/api/users/_verify.php?code=".$userKey."</p>";
        $message .= "<p>If you believe your received this email in error, please reply to this email stating so.</p>";
        $message .= "</body>";
        $message .= "</html>";

        $this->SendMail("Alpha Adventures", "registration@alphaadventures.org", $userEmailAddress, "Complete Your Registration", $message);
    }

    public function SendAdventureUpdateEmail($updateText, $userEmailAddress)
    {
        $message = "<html>";
        $message .= "<head>";
        $message .= "<title>Alpha Adventures Notification</title>";
        $message .= "</head>";
        $message .= "<body>";
        $message .= "<h2>Adventure Notification</h2>";
        $message .= "<p>An adventure that you have subscribed to has a notification</p>";
        $message .= "<p>". $updateText ."</p>";
        $message .= "<p>If you would like to stop receiving notifications for this adventure, login to your account and uncheck notifications in the RSVP form for this adventure. If you believe your received this email in error, please reply to this email stating so.</p>";
        $message .= "</body>";
        $message .= "</html>";

        $this->SendMail("Alpha Adventures", "notification@alphaadventures.org", $userEmailAddress, "Complete Your Registration", $message);
    }

    private function SendMail($fromAccountName, $fromAddress, $toAddress, $subject, $message)
    {
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: " . $fromAccountName . "<" . $fromAddress . "> \r\n";
        mail($toAddress, $subject, $message, $headers);
    }
}
?>