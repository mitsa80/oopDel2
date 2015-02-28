<?php
include_once("../nodebite-swiss-army-oop.php");

	$ds = new DBObjectSaver(array(
	  "host" => "127.0.0.1",
	  "dbname" => "character_db",
	  "username" => "root",
	  "password" => "mysql",
	  "prefix" => "DBOB"
	));
	
	if (count($ds->current_challenge) > 0) {
		$oldChallenge = &$ds->current_challenge[0];
		while ($oldChallenge === $ds->current_challenge[0]) {
			$random_index = array_rand($ds->challenges);
			$ds->current_challenge[0] = &ds->challenges[$random_index];
		}
	} else {
		$ds->current_challenge = &$ds->challenges[0];
	}
	
	echo(json_encode($ds->current_challenge[0]));
	