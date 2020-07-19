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

    public function LoadAllForAdventure($adventureId)
    {
        $sql = "SELECT r.NotifyBySMS, r.NotifyByEmail, u.EmailAddress, u.PhoneNumber FROM Rsvp AS r JOIN User AS u ON r.UserId = u.UserId WHERE AdventureId = :adventureId";
        $bindings = array(":adventureId"=>$adventureId);
        return parent::FetchAll($sql, $bindings);
    }
}
?>