<?php
require_once("../_library/AlphaAdventuresRepository.php");

class RegisterRepository extends AlphaAdventuresRepository
{
    public function LoadUserByEmailAddress($username)
    {
        $sql = "SELECT * FROM User WHERE Username = :username";
        $bindings = array(":username"=>$username);
        return parent::Fetch($sql, $bindings);
    }
}
?>