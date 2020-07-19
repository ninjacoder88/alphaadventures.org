<?php
try
{
    require_once("AdventureRepository.php");

    $repository = new AdventureRepository();
    $adventures = $repository->LoadUpcomingAdventures();

    echo json_encode(array("success" => "true", "adventures" => $adventures));
}
catch(Throwable $t)
{
    echo json_encode(array("success" => "false"));
    //echo json_encode(array("success" => "false", "exception"=>$t, "message"=>$t->getMessage(), "trace"=>$t->getTraceAsString()));
}
?>