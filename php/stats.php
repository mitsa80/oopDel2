<?php
//Nodebite black box
include_once("../nodebite-swiss-army-oop.php");

//create a new instance of the DBObjectSaver class 
//and store it in the $ds variable
	$ds = new DBObjectSaver(array(
	  "host" => "127.0.0.1",
	  "dbname" => "character_db",
	  "username" => "root",
	  "password" => "mysql",
	  "prefix" => "DBOB"
	));
	

for ($i=0; $i < count($ds->players); $i++) {
  //success >= 100 means win
  if ($ds->players[$i]->success >= 100) {
    //save new winner
    $ds->have_won[] = $ds->players[$i];

    //and remove from active players
    array_splice($ds->players, $i, 1);
  }
  //success <= 0 means lose
  elseif ($ds->players[$i]->success <= 0) {
    //save new loser
    $ds->have_lost[] = $ds->players[$i];

    //and remove from active players
    array_splice($ds->players, $i, 1);
  }
}


$stats = array(
  "player" => $ds->players,
  "winners" => $ds->have_won,
  "losers" => $ds->have_lost,
  "current_challenge" => $ds->current_challenge[0],
  "all_challenges" => $ds->challenges,
  "all_tools" => $ds->tools,
);

echo(json_encode($stats));
