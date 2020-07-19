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

    public function UpdateAdventure($adventureId, $title, $start, $end, $description)
    {
        $sql = "UPDATE Adventure SET Title = :title, StartDateTime = :start, EndDateTime = :end, Description = :description WHERE AdventureId = :adventureId";
        $bindings = array(":adventureId"=>$adventureId, ":title"=>$title, ":start"=>$start, ":end"=>$end, ":description"=>$description);
        return parent::Update($sql, $bindings);
    }
}
?>