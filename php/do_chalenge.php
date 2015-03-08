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
	

$alone = isset($_REQUEST["alone"]) ? true : false;

for ($i = 0; $i < count($ds->players); $i++) {
	$ds->players[$i]->winTool($ds->tools);
}

$human_player = &$ds->players[0];

if(!$alone){
	$companion = &$ds->players[1];
	
    $opponent = &$ds->players[2];
	
	
	//teaming up has a cost..
    $human_player->success -= 5;
    $companion->success -= 5;
	
	//create a new team
  $players = array();
  $players[] = New Team("Team1", $human_player, $companion);
  //then add the opponent
  $players[] = $opponent;

  //and do the challenge 
  $result = $human_player->acceptChallenge($ds->current_challenge[0], $players);
//var_dump($result);
  //who first etc.
  $winner = $result[0];
  //var_dump($winner);
  //die();
  $last = $result[count($result)-1];
	//var_dump($winner);
	//var_dump($last);
	//die();
	
  //if the team won or not
  if (get_class($winner) == "Team") {
    //Team winners get 9 points
    $human_player->success += 9;
    $companion->success += 9;

    //loser loses 5 points and a random tool
    $opponent->success -= 5;
    $opponent->loseTool($ds->tools);
  } else {
    //Solo winners get 15 points
    $winner->success += 15;

    //losers lose 5 points and a random tool each
    $human_player->success -= 5;
    $human_player->loseTool($ds->tools);
    $companion->success -= 5;
    $companion->loseTool($ds->tools);
  }
  
} else {
  //PLAY CHALLENGE
  $result = $human_player->acceptChallenge($ds->current_challenge[0], $ds->players);

  //who first etc.
  $winner = $result[0];
  $last = $result[count($result)-1];

  //winner gets 15 points
  $winner->success += 15;

  //third lose 5 points and a random tool
  $last->success -= 5;
  $last->loseTool($ds->tools);
}


//data to echo back to frontend
$echo_data = array(
  "result" => $result,
  "playing" => $ds->players,
  "winner"=>$winner,
  "last"=>$last
);

echo(json_encode($echo_data));
