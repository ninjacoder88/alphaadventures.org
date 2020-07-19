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

    public function CreateUser($username, $emailAddress, $phoneNumber, $password, $salt)
    {
        $sql = "INSERT INTO User (Username, EmailAddress, PhoneNumber, Password, Salt, UserStatusId, UserKey) VALUES (:username, :emailAddress, :phoneNumber, :password, :salt, 1, NULL)";
        $bindings = array(":username"=>$username, ":emailAddress"=>$emailAddress, ":phoneNumber"=>$phoneNumber, ":password"=>$password, ":salt"=>$salt);
        return parent::Insert($sql, $bindings);
    }
}
?>