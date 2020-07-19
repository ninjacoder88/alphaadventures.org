<?php
try
{
    require_once("AdventureRepository.php");

    $repository = new AdventureRepository();
    $adventures = $repository->LoadUpcomingAdventures();

    // $array = array(
    //     0 => array("AdventureId" => 1, "Title" => "Bike Ride from Solon to Cedar Rapids", "StartDateTime" => "Saturday, August, 1, 2020 9:00am"),
    //     1 => array("AdventureId" => 2, "Title" => "Fishing at Lake McBride", "StartDateTime" => "Friday, August 7, 2020 10:00am - 2:00pm"),
    //     2 => array("AdventureId" => 3, "Title" => "Fishing at Lake McBride", "StartDateTime" => "Saturday, August 8, 2020 9:00am - 3:00pm"),
    //     3 => array("AdventureId" => 4, "Title" => "Hiking at Palisades-Kepler State Park", "StartDateTime" => "Friday, August 28, 2020 9:00am - 12:00pm"),
    //     4 => array("AdventureId" => 5, "Title" => "Hiking at Palisades-Kepler State Park", "StartDateTime" => "Saturday, August 29, 2020 9:00am - 12:00pm"),
    // );
    
    echo json_encode(array("success" => "true", "adventures" => $adventures));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>