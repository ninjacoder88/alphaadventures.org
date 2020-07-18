<?php
require_once("../_library/AlphaAdventuresRepository.php");

class RegisterRepository extends AlphaAdventuresRepository
{
    public function CreateUser($username, $emailAddress, $phoneNumber, $password, $salt)
    {
        $sql = "INSERT INTO User (Username, EmailAddress, PhoneNumber, Password, Salt, UserStatusId) VALUES (:username, :emailAddress, :phoneNumber, :password, :salt, 1)";
        $bindings = array(":username"=>$username, ":emailAddress"=>$emailAddress, ":phoneNumber"=>$phoneNumber, ":password"=>$password, ":salt"=>$salt);
        return parent::Insert($sql, $bindings);
    }
}
?>