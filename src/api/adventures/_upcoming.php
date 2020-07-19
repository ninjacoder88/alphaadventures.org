<?php
try
{
    require_once("../_library/SessionManager.php");
    require_once("AdventureRepository.php");

    $sessionManager = new SessionManager();
    $sessionValidation = $sessionManager->ValidateSessionForAPI();
    if($sessionValidation["success"] == "exit")
    {
        echo json_encode($sessionValidation);
        exit();
    }

    $repository = new AdventureRepository();
    $adventures = $repository->LoadUpcomingAdventures();

    // $d0 = "Enjoy a bike ride from <a href=\"https://goo.gl/maps/PPzQZQmdgCDcn9Vp8\">Solon Recreation and Nature Area</a> to <a href=\"https://goo.gl/maps/2hHWT6pcbByVdtyQ7\">Cedar Lake</a>. This ride is approximately 35 miles round trip. If you would like to join for something a bit shorter, feel free to start at <a href=\"https://g.page/ely-city-park?share\">Ely City Park</a> for a round trip of approximately 22 miles. If you would like to participate but not ride, we need some support drivers to assist in case of mechanical issues and to transport food and drink.<br/><br/>Lunch will be provided around 11:00am or you are free to stop at the <a href=\"http://www.thesagwagon.com/\">The Sag Wagon</a> or anywhere else in downtown Cedar Rapids. Please RSVP with any dietary restrictions.<br/><br/>Most likely several groups will form as not everyone rides at the same pace.<br/><br/>While helmets are encouraged, they are not required. You will need to provide your own bicycle or you can rent one from any number of bike shops throughout the area for a reasonable price<br/><br/>Additional items to consider: sunscreen, snack bars, spare tubes.";

    // $d1 = "Come take part in a relaxing day of fishing at Lake McBride. We will meet at the <a href=\"https://goo.gl/maps/qyJjTj13oKv1Ghf3A\">Hillbilly Shelter</a> and then disperse around the lake from that point. This will also be the area we meet for lunch.<br/><br/>Lunch will be provided around 11:30am. Please RSVP with any dietary restrictions.<br/><br/><strong>Fishing Licenses are required</strong> and can be purchased online or at a number or retailers in the area. Fishing polls can be provided upon prior request. There is not a lot of shade around the lake so plan on being in the sun.<br/><br/>Additional items to consider: sunscreen, bug spray, chair, hat, snacks, water.";

    // $d3 = "A scenic hike through the woods of Palisades-Kepler State Park. Meet at the lodge for a roughly 2 mile hike around the park.<br/><br/>Lunch will be provided around 11:30am. Please RSVP with any dietary restrictions.<br/><br/>The first and last part of this hike will be on pavement but roughly a mile will be on dirt trails so please wear appropriate shoes.<br/><br/>Additional items to consider: sunscreen, bug spray, hat, snacks, water.";
    
    // $array = array(
    //     0 => array("AdventureId" => 1, "Title" => "Bike Ride from Solon to Cedar Rapids", "StartDateTime" => "Saturday, August, 1, 2020 9:00am", "EndDateTime" => "", "Description" => $d0),
    //     1 => array("AdventureId" => 2, "Title" => "Fishing at Lake McBride", "StartDateTime" => "Friday, August 7, 2020 10:00am - 2:00pm", "EndDateTime" => "", "Description" => $d1),
    //     2 => array("AdventureId" => 3, "Title" => "Fishing at Lake McBride", "StartDateTime" => "Saturday, August 8, 2020 9:00am - 3:00pm", "EndDateTime" => "", "Description" => $d1),
    //     3 => array("AdventureId" => 4, "Title" => "Hiking at Palisades-Kepler State Park", "StartDateTime" => "Friday, August 28, 2020 9:00am - 12:00pm", "EndDateTime" => "", "Description" => $d3),
    //     4 => array("AdventureId" => 5, "Title" => "Hiking at Palisades-Kepler State Park", "StartDateTime" => "Saturday, August 29, 2020 9:00am - 12:00pm", "EndDateTime" => "", "Description" => $d3),
    // );
    
    echo json_encode(array("success" => "true", "adventures" => $adventures));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>