<?php
require_once("../_library/AlphaAdventuresRepository.php");

class RsvpRepository extends AlphaAdventuresRepository
{
    public function CreateRsvp($userId, $adventureId, $rsvpTypeId, $notifyBySms, $notifyByEmail, $notes, $attendees)
    {
        $sql = "INSERT INTO Rsvp (UserId, AdventureId, RsvpTypeId, NotifyBySMS, NotifyByEmail, Notes, Attendees) VALUES (:userId, :adventureId, :rsvpTypeId, :notifyBySms, :notifyByEmail, :notes, :attendees)";
        $bindings = array(":userId"=>$userId, ":adventureId"=>$adventureId, ":rsvpTypeId"=>$rsvpTypeId, ":notifyBySms"=>$notifyBySms, ":notifyByEmail"=>$notifyByEmail, ":notes"=>$notes, ":attendees"=>$attendees);
        return parent::Insert($sql, $bindings);
    }

    public function UpdateRsvp($rsvpId, $rsvpTypeId, $attendees, $notes, $notifyBySms, $notifyByEmail)
    {
        $sql = "UPDATE Rsvp SET RsvpTypeId = :rsvpTypeId, Attendees = :attendees, Notes = :notes, NotifyBySMS = :notifyBySms, NotifyByEmail = :notifyByEmail WHERE RsvpId = :rsvpId";
        $bindings = array(":rsvpId"=>$rsvpId, ":rsvpTypeId"=>$rsvpTypeId, ":attendees"=>$attendees, ":notes"=>$notes, ":notifyBySms"=>$notifyBySms, ":notifyByEmail"=>$notifyByEmail);
        return parent::Update($sql, $bindings);
    }

    public function LoadForUserId($userId)
    {
        $sql = "SELECT * FROM Rsvp WHERE UserId = :userId";
        $bindings = array(":userId"=>$userId);
        return parent::FetchAll($sql, $bindings);
    }
}
?>