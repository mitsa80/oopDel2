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
//destroy old game data
	unset($ds->players);
	unset($ds->challenges);
	unset($ds->tools);
	unset($ds->current_challenge);
	
	
	
	if(!isset($_REQUEST["player_name"])) {
		exit();
} else {
	$player = $_REQUEST["player_name"];
	$class= $_REQUEST["player_class"];
	$playerChoice = array("name" =>$player , "class" =>$class );
}


// Create all three players
 
	$allPlayerClasses = array("Mitsa","Kian","Ali");
	$i = 0;
	$bots = array();
	foreach($allPlayerClasses as $class) {
		if ($class == $playerChoice["class"]) {
			$ds->players[] = New $class($playerChoice["name"]);
		} else {
			$bots[] = New $class("Bot".$i);
		}
		$i++;
	}
	foreach ($bots as $bot) {
		$ds->players[] = $bot;
	}
	
	
	//challenges
	$challenges_data = array(
		array(
			"description" =>"cheesecake with berry for desert ".
							" beef stew and rice",
			"skills" => array(
				"maindish" => 70,
				"starter" => 0,
				"sauce" => 0,
				"desert" => 95
			),
		),
		array(
			"description" => "Grill a pork roast in the oven. ".
							 "Boil potatoes to go with it. ".
							 "Serve some fine cheesecake for desert.",
			"skills" => array(
				"maindish" => 80,
				"starter" => 10,
				"sauce" => 0,
				"desert" => 90
			),
		),
		array(
			"description" => "Grill a chicken, with some roasted root crops. ".
							 "Make  a suberp sauce to go with it. ".
							 "Whip up an apple tart for desert.",
			"skills" => array(
				"maindish" => 70,
				"starter" => 10,
				"sauce" => 80,
				"desert" => 60
			),
		),
		array(
			"description" => "Make a Salad. ".
							 "Make a nice sauce to go with it. ".
							 "Make icecream for desert.",
			"skills" => array(
				"maindish" => 0,
				"starter" => 70,
				"sauce" => 50,
				"desert" => 80
			),
		),
		array(
			"description" => "Grill a turkey".
							 "Make  a white sauce to sallad. ".
							 "an apple pie for desert.",
			"skills" => array(
				"maindish" => 80,
				"starter" => 10,
				"sauce" => 80,
				"desert" => 70
			),
		),
		array(
			"description" => "Make a tomato soup as a started. ".
							 "pasta with alfredo sauce. ".
							 "Make banana ice cream for desert.",
			"skills" => array(
				"maindish" => 80,
				"starter" => 80,
				"sauce" => 90,
				"desert" => 90
			),
		),
		array(
			"description" => "make a garlic sauce and pizza kebab",
			"skills" => array(
				"maindish" => 80,
				"starter" => 0,
				"sauce" => 60,
				"desert" => 0
			),
		),
		array(
			"description" => "grill meats beer with garlic and ginger sauce".
							 "caesar salad and fruit pie",
			"skills" => array(
				"maindish" => 80,
				"starter" => 80,
				"sauce" => 50,
				"desert" => 0
			),
		),
		array(
			"description" => "Creamy Cajun Chicken Pasta with berry sauce".
							"vanilla cupcake for desert",
			"skills" => array(
				"maindish" => 50,
				"starter" => 10,
				"sauce" => 50,
				"desert" => 90
			),
		),
		array(
			"description" => "mashroom soup for starter".
							 "gril sausage potatoes".
							 "cake ice cream",
			"skills" => array(
				"maindish" => 20,
				"starter" => 90,
				"sauce" => 0,
				"desert" => 90
			),
		)
	);

	foreach ($challenges_data as $challenge_data) {
		$ds->challenges[] = New Challenge($challenge_data["description"], $challenge_data["skills"]);
	}
	  
	 //tools
	
	$tools_data = array(
		array(
			"description" => "mixer",
			"skills" => array(
				"maindish" => 10,
			),
		),
		array(
			"description" => "skimmer",
			"skills" => array(
				"starter" => 12,
			),
		),
		array(
			"description" => " ice cream maker",
			"skills" => array(
				"dessert" => 20,
			),
		),
		array(
			"description" => " graters",
			"skills" => array(
				"sauce" => 16,
			),
		),
		array(
			"description" => "noodel machine",
			"skills" => array(
				"maindish" => 20,
			),
		),
		array(
			"description" => "egg beater",
			"skills" => array(
				"starter" => 19,
			),
		),
		array(
			"description" => "pastry cutting wheels",
			"skills" => array(
				"dessert" => 15,
			),
		),
		array(
			"description" => "whisk",
			"skills" => array(
				"sauce" => 10,
			),
		),
		array(
			"description" => "colander",
			"skills" => array(
				"maindish" => 20,
			),
		)
	);

	foreach ($tools_data as $tool_data) {
		$ds->tools[] = New Tool($tool_data["description"], $tool_data["skills"]);
	}
	
//echo(json_encode($ds->players[0]));
	
$echo_arr = array(
  "players" => $ds->players,
  "tools" => $ds->tools,
  "challenges" => $ds->challenges,
);

echo(json_encode($echo_arr));


if(isset($_REQUEST["tool"])) {
	
	}
