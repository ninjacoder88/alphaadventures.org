<?php
require_once("../_library/AlphaAdventuresRepository.php");

class UserRepository extends AlphaAdventuresRepository
{
    public function LoadUserByEmailAddress($emailAddress)
    {
        $sql = "SELECT * FROM User WHERE EmailAddress = :emailAddress";
        $bindings = array(":emailAddress"=>$emailAddress);
        return parent::Fetch($sql, $bindings);
    }

    public function LoadUserByUsername($username)
    {
        $sql = "SELECT * FROM User WHERE Username = :username";
        $bindings = array(":username"=>$username);
        return parent::Fetch($sql, $bindings);
    }

    public function CreateUser($username, $emailAddress, $phoneNumber, $password, $salt, $userKey)
    {
        $sql = "INSERT INTO User (Username, EmailAddress, PhoneNumber, Password, Salt, UserStatusId, UserKey, IsAdmin) VALUES (:username, :emailAddress, :phoneNumber, :password, :salt, 1, :userKey, false)";
        $bindings = array(":username"=>$username, ":emailAddress"=>$emailAddress, ":phoneNumber"=>$phoneNumber, ":password"=>$password, ":salt"=>$salt, ":userKey"=>$userKey);
        return parent::Insert($sql, $bindings);
    }

    public function LoadByUserKey($userKey)
    {
        $sql = "SELECT UserId FROM User WHERE UserKey = :userKey";
        $bindings = array(":userKey"=>$userKey);
        return parent::Fetch($sql, $bindings);
    }

    public function UpdateUserStatus($userId, $userStatusId)
    {
        $sql = "UPDATE User SET UserStatusId = :userStatusId WHERE UserId = :userId";
        $bindings = array(":userId"=>$userId, ":userStatusId"=>$userStatusId);
        return parent::Update($sql, $bindings);
    }

    public function ClearUserKey($userId)
    {
        $sql = "UPDATE User SET UserKey = NULL WHERE UserId = :userId";
        $bindings = array(":userId"=>$userId);
        return parent::Update($sql, $bindings);
    }
}
?>