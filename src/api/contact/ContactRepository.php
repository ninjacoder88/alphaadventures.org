<?php
require_once("../_library/AlphaAdventuresRepository.php");

class ContactRepository extends AlphaAdventuresRepository
{
    public function CreateFeedback($userId, $message)
    {
        $sql = "INSERT INTO Feedback (UserId, Message) VALUES (:userId, :message)";
        $bindings = array(":userId"=>$userId, ":message"=>$message);
        return parent::Insert($sql, $bindings);
    }
}
?>