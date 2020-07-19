<?php
require_once("../_library/AlphaAdventuresRepository.php");

class AdventureRepository extends AlphaAdventuresRepository
{
    public function LoadUpcomingAdventures()
    {
        $sql = "SELECT * FROM Adventure WHERE StartDateTime > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 DAY)";
        $bindings = array();
        return parent::FetchAll($sql, $bindings);
    }
}
?>