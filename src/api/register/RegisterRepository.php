<?php
require_once("../_library/AlphaAdventuresRepository.php");

class RegisterRepository extends AlphaAdventuresRepository
{
    public function CreateUser($username, $emailAddress, $phoneNumber, $password, $salt)
    {
        $sql = "INSERT INTO User (Username, EmailAddress, PhoneNumber, Password, Salt) VALUES (:username, :emailAddress, :phoneNumber, :password, :salt)";
        $bindings = array(":username"=>$username, ":emailAddress"=>$emailAddress, ":phoneNumber"=>$phoneNumber, ":password"=>$password, ":salt"=>$salt);
        return parent::Insert($sql, $bindings);
    }
}
?>